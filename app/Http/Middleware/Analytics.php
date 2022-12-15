<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Analytic;

class Analytics
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (auth()->check()) {
            $url_array = explode('/', $_SERVER['REQUEST_URI']);
            $last_analytic = Analytic::where('user_id', @auth()->user()->id)->latest()->first();

            if (
                @$last_analytic &&
                $last_analytic->count() > 0
            ) {
                $duration = time() - $last_analytic->updated_at->timestamp;
                if ($duration <= 300) {
                    $last_analytic->duration = time() - $last_analytic->created_at->timestamp;
                    $last_analytic->save();
                }
            }

            if (auth()->user()->role != 'A') {
                if (
                    @$last_analytic->route != $_SERVER['REQUEST_URI'] ||
                    @$duration > 300 ||
                    !@$last_analytic && $last_analytic->count() <= 0
                ) {
                    if ($url_array[1] == 'slideShow') {
                    }
                    Analytic::create([
                        'user_id' =>  auth()->user()->id,
                        'subcategory_id' => @$url_array[1] === "slideShow" ? @$url_array[3] : null,
                        'route' => $_SERVER['REQUEST_URI'],
                        'duration' => 10,
                    ]);
                }
            }
        }

        return $next($request);
    }
}
