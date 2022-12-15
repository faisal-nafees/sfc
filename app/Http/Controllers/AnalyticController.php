<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Analytic;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class AnalyticController extends Controller
{

    public function index($user_id = null)
    {
        $user = null;
        if (@$user_id) {
            $user = User::find($user_id);
        }
        return view('admin.analytics.index', compact('user'));
    }

    public function groupBy($type, $user_id = null)
    {
        $data = [];
        if ($type == 'classes') {
            $category = Category::where('active', 'Y');
            if ($user_id) {
                $category = $category->with(['analytics'=> function ( $query) use ($user_id) {
                    $query->where('user_id', $user_id);
                }]);
            }else{
                $category = $category->with('analytics');
            }
            $category = $category->get();

            foreach ($category as $cat) {
                $data[] = [
                    'name' => $cat->title,
                    'duration' => $cat->analytics->sum('duration')
                ];
            }
        } elseif ($type == 'lessons') {
            $subcategories = Subcategory::where('active', 'Y');
            if ($user_id) {
                $subcategories = $subcategories->with(['analytics'=> function ( $query) use ($user_id) {
                    $query->where('user_id', $user_id);
                }]);
            }else{
                $subcategories = $subcategories->with('analytics');
            }
            $subcategories = $subcategories->get();
            foreach ($subcategories as $subcat) {
                $data[] = [
                    'name' => $subcat->title,
                    'duration' => $subcat->analytics->sum('duration')
                ];
            }
        } elseif ($type == 'users') {
            $users = User::where('role', 'U');
            if ($user_id) {
                $users = $users->where('id', $user_id);
            }
            $users = $users->with('analytics')->get();;
            foreach ($users as $user) {
                $data[] = [
                    'name' => $user->fname . ' ' . $user->lname,
                    'email' => $user->email,
                    'duration' => $user->analytics->sum('duration'),
                    'user_id' => $user->id
                ];
            }
        } else {
            $data = Analytic::whereNull('subcategory_id')->whereNotNull('route');
            if ($user_id) {
                $data = $data->where('user_id', $user_id);
            }
            $data =  $data->groupBy('route')->selectRaw('route, sum(duration) as duration')->get();
        }

        return view('admin.analytics.groupBy', compact('data', 'type'));
    }

    public function analyticLivePing(Request $request)
    {
        // $url = $_SERVER['HTTP_REFERER'];
        $route = parse_url(
            $_SERVER['HTTP_REFERER'],
            PHP_URL_PATH
        );
        $last_analytic = Analytic::where('user_id', auth()->user()->id)->latest()->first();
        if ($last_analytic->route == $route) {
            // Update idle time
            $last_analytic->duration = time() - $last_analytic->created_at->timestamp;
            $last_analytic->save();
            return response()->json(['status' => 'success']);
        }
    }

    // public function analyticStop(Request $request)
    // {
    //     $route = parse_url(
    //         $_SERVER['HTTP_REFERER'],
    //         PHP_URL_PATH
    //     );
    //     $last_analytic = Analytic::where('user_id', auth()->user()->id)->latest()->first();
    //     if ($last_analytic->route == $route) {
    //         // Update idle time
    //         $last_analytic->duration = time() - $last_analytic->created_at->timestamp;
    //         $last_analytic->save();

    //         // Create new analytic
    //         Analytic::create([
    //             'user_id' => auth()->user()->id,
    //             'route' => '',
    //             'duration' => 0,
    //         ]);
    //     }
    //     return response()->json(['status' => 'success']);
    // }
}
