<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Excel;
use Image;
use ZipArchive;
use DOMDocument;
use App\Models\Qa;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Slide;
use App\Models\Category;
use App\Models\UserAnswer;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use App\Models\SlideContent;

use FFMpeg\Format\Audio\Mp3;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Models\SlideProgress;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpWord\Element\TextRun;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::all();
        // foreach($users as $user){
        //     $user->fname = base64_encode($user->fname);
        //     $user->lname = base64_encode($user->lname);
        //     $user->email = base64_encode($user->email);
        //     $user->save();
        // }
        // dd('done');
        $users                      = User::where('role', '=', "U")->paginate(10);
        $categories                 = Category::with('users')->get();
        $categoryPurchaseCount      = [];
        $categoryNames              = [];
        $otherPurchaseCount         = 0;
        $otherName                  = false;
        foreach ($categories as $cat) {
            if (count($categoryPurchaseCount) < 8) {
                array_push($categoryPurchaseCount, $cat->users->count());
            } else {
                $otherPurchaseCount += $cat->users->count();
            }
        }
        if ($otherPurchaseCount > 0) {
            array_push($categoryPurchaseCount, $otherPurchaseCount);
        }
        foreach ($categories as $cat) {
            if (count($categoryNames) < 8) {
                array_push($categoryNames, $cat->title);
            } else {
                $otherName          = true;
            }
        }
        if ($otherName) {
            array_push($categoryNames, 'Other Classes');
        }
        // dd($categoryPurchaseCount, $categoryNames);
        return view('admin.adminDash', compact(['users', 'categoryPurchaseCount', 'categoryNames']));
    }

    function excel_index()
    {
        $users = DB::table('user')->where('role', '=', 'U')->get();
        return view('admin.exportExcel')->with('users', $users);
    }

    function excel()
    {
        $users = DB::table('user')->where('role', '=', 'U')->get()->toArray();
        $user_array[] = array('First Name', 'Last Name', 'Email');
        foreach ($users as $user) {
            $user_array[] = array(
                'First Name'    => $user->fname,
                'Last Name'     => $user->lname,
                'Email'         => $user->email
            );
        }
        Excel::create('Client Data', function ($excel) use ($user_array) {
            $excel->setTitle('Client Data');
            $excel->sheet('Client Data', function ($sheet) use ($user_array) {
                $sheet->fromArray($user_array, null, 'A1', false, false);
            });
        })->download('xlsx');
    }

    // Add User Page
    public function createNewClient()
    {
        $categories = Category::orderBy('title')->get();
        return view('admin.newClient')->with('categories', $categories);
    }

    // Add User Page
    public function createNewAdmin()
    {
        return view('admin.newAdmin');
    }

    //Store Admin to database
    public function createAdmin(Request $request)
    {
        $input      = $request->all();
        Validator::make($input, [
            'fname'    => ['required', 'max:20'],
            'lname'    => ['required', 'max:20'],
            'email' => [
                'required',
                'email',
                Rule::unique(User::class),
            ],
            'password' => ['min:6', 'required_with:password_confirmation', 'same:password_confirmation',]
        ])->validate();
        $input['email'] = strtolower($input['email']);
        $user       = User::create([
            'fname'    => $input['fname'],
            'lname'    => $input['lname'],
            'email'    => $input['email'],
            'password' => Hash::make($input['password']),
            'role'     => 'A',
        ]);

        if ($user) {
            return view('admin.newAdmin')->with('success', 'Admin account created successfully');
        } else {
            return view('admin.newAdmin')->with('errors', 'Unable to create account!');
        }
    }

    // Store User to database
    public function storeNewClient(Request $request)
    {
        $input = $request->all();

        $emailAlreadyExist = User::whereBaseEnc('email', '=', $request->email)->count();
        if ($emailAlreadyExist) {
            return back()->withErrors(['email' => 'Email already exist!']);
        }
        Validator::make($input, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
        ])->validate();
        $input['email'] = strtolower($input['email']);
        $user = User::create([
            'fname'     => $input['fname'],
            'lname'     => $input['lname'],
            'email'     => $input['email'],
            'password'  => Hash::make(base64_encode(random_bytes(10))),
        ]);
        $user->categories()->attach($request->categories, ['created_at' => now(), 'updated_at' => now()]);
        if ($user) {
            $request->session()->flash('email', $user->email);
            return view('auth.forgot-password');
        } else {
            return back()->with('message', 'Error Adding User');
        }
    }

    //user search
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $userData = "";
            $users = User::whereBaseEnc('fname', 'LIKE', "%{$request->value}%")
                ->orwhereBaseEnc('lname', 'LIKE', "%{$request->value}%")
                ->orwhereBaseEnc('email', 'LIKE', "%{$request->value}%")
                ->orwhere('org_code', 'LIKE', "%{$request->value}%")
                ->paginate(10);

            if (count($users) !== 0) {

                foreach ($users as $key => $usr) {
                    $user = User::find($usr->id);
                    $cat = "";

                    foreach ($user->categories as $category) {
                        $cat .= '"' . $category->title . '", ';
                    }
                    if ($request->page == "M") {
                        $userData .= '<tr>' .
                            '<td>' . $user->fname . '</td>' .
                            '<td>' . $user->lname . '</td>' .
                            '<td style="width: 20%;">' . $cat . '</td>' .
                            '<td><a href="mailto:' . $user->email . '">' . $user->email . '</a></td>' .
                            '<td>' . $user->org_code . '</td>' .
                            '<td><a href=" "' . $user->id_image . '</a></td>' .
                            '<td>' . $user->status . '</td>' .
                            '<td style="width: 30%;">
							<form action="/admin/changeStatus/' . $user->id . '/Active" method="post" class="d-inline-block">
                                <input type="hidden" name="_token" value="' . csrf_token() . '" />
								<button type="submit" class="btn btn-success">
								Unlock
							</button>
							</form>

							 <form action="/admin/changeStatus/' . $user->id . '/Disabled" method="post" class="d-inline-block">
                                <input type="hidden" name="_token" value="' . csrf_token() . '" />
								 <button type="submit" class="btn btn-warning">
									Disable
								</button>
							</form>


                            <form id="delete-client-' . $user->id . '" action="/admin/removeClient/' . $user->id . '" method="post" class="d-inline-block">
                                <input type="hidden" name="_token" value="' . csrf_token() . '" />
							</form>
                            <button onclick="confirmDelete(' . $user->id . ')" type="submit" class="btn btn-danger">
								Delete
							</button>
                            <button onClick="editClient(' . $user->id . ')" type="button"  class="btn btn-secondary">
								Edit
							</button>
                        </td>
						</tr>';
                    } elseif ($request->page == "C") {
                        $userData .= '<tr>' .
                            '<td>' . $user->fname . '</td>' .
                            '<td>' . $user->lname . '</td>' .
                            '<td>' . $cat . '</td>' .
                            '<td><a href="mailto:' . $user->email . '">' . $user->email . '</a></td>' .
                            '<td>' . $user->org_code . '</td>' .
                            '</tr>';
                    } else {
                        $userData .= '<tr>' .
                            '<td>' . $user->fname . '</td>' .
                            '<td>' . $user->lname . '</td>' .
                            '<td>' . $cat . '</td>' .
                            '</tr>';
                    }
                }

                return response()->json(['user' => $userData]);
            } else {
                $userData = '<tr>
							  <td colspan="3" ><p class="text-center text-muted"> No Client Found </p> </td>
							</tr>';
                return response()->json(['user' => $userData]);
            }
        }
    }

    // Clients
    public function clients()
    {
        $users = User::where('role', '=', "U")->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.clients')->with('users', $users);
    }

    // Manage Client Accounts
    public function manageClientAcc()
    {
        $users = User::where('role', '=', "U")->orderBy('created_at', 'DESC')->paginate(10);
        $categories = Category::orderBy('title')->get();
        return view('admin.manageClients')->with('users', $users)->with('categories', $categories);
    }

    // Edit Client Accounts
    public function editClient(Request $request)
    {
        if ($request->ajax()) {

            $user = User::find($request->id);
            foreach ($user->categories as $category) {
                $cat = $category;
            }
            if ($user) {
                return response()->json(['user' => $user, 'categories' => $user->categories]);
            } else {
                return response()->json(['error' => "User Not Found!"]);
            }
        }
    }

    // Update Client Accounts
    public function updateClient(Request $request)
    {
        //Check if email belongs to someother user
        $emailAlreadyExist = User::where([['id', '!=', $request->id], ['email', '=', $request->email]])->get();

        if (count($emailAlreadyExist) == 0) {
            $user            = User::find($request->id);
            $user->fname     = trim($request->fname);
            $user->lname     = trim($request->lname);
            $user->email     = strtolower(trim($request->email));
            $user->fname     = trim($request->fname);

            if ($user->save()) {
                $user->categories()->detach();
                $user->categories()->attach($request->categories, ['created_at' => now(), 'updated_at' => now()]);
                return back()->with('success', 'Client Profile Updated Succesfully');
            } else {
                return back()->with('error', "Error Updating Client Profile");
            }
        } else {
            return back()->with('error', "The email provided belongs to a different client!");
        }
    }

    //Change Status
    public function changeStatus($id, $status)
    {
        $user             = User::find($id);
        $user->status     = $status;
        $msg              = ($status == "Active") ? 'Activated' : $status;

        if ($user->save()) {
            return back()->with('success', 'Client Profile ' . $msg . ' Succesfully');
        } else {
            return back()->with('error', "Error Updating Client Profile");
        }
    }


    // Send Activate Account Email
    public function sendPasswordResetToken(Request $request)
    {
        return 1;
        $user = User::whereBaseEnc('email', '=', $request->email)->first();
        if (!$user) return redirect()->back()->withErrors(['error' => '404']);

        $key = config('app.key');


        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }

        $token = hash_hmac('sha256', Str::random(40), $key);

        //create a new token to be sent to the user.
        DB::table('password_resets')->insert([
            'email'         => $request->email,
            'token'         => $token,
            'created_at'    => Carbon::now()
        ]);

        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

        $email = $request->email;
        $data = [
            'name'      => $user->fname . ' ' . $user->lname,
            'subject'   => 'Activate Account',
            'title'     => 'Activate Account',
            'body'      => 'Click on the link below to activate your account',
            'link'      => url('/') . '/password-reset/' . $token,
            'email'     => $request->email,
        ];

        $mailSend = Mail::send('email.ActivateAccount', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject('Activate Account');
            $message->from('support@kdetechnology.com', 'Safety First Consulting');
        });
        $categories = Category::orderBy('title')->get();
        return view('admin.newClient')
            ->with('categories', $categories)
            ->with('success', 'Account activation email has been send to "' . $request->email . '"');
    }

    //Show Password Reset Form
    public function showPasswordResetForm($token)
    {
        $tokenData = DB::table('password_resets')
            ->where('token', $token)->first();

        if (!$tokenData) return redirect()->to('home'); //redirect them anywhere you want if the token does not exist.
        return view('auth.reset-password')->with('token', $token)->with('email', $tokenData->email);
    }

    //Add client id image and activate account
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'                 => 'required',
            'id_image'              => 'required|image|mimes:jpeg,png,jpg|max:6000',
            'password'              => 'required',
            'password_confirmation' => 'required',
            'email'                 => 'required|email',
        ]);
        $emailExist = User::whereBaseEnc('email', '=', $request->email)->count();

        if (!$emailExist) {
            return back()->withErrors(['email' => 'Email not found!']);
        }

        $password = $request->password;

        if ($password !== $request->password_confirmation) {
            return back()->withErrors(["password" => "Password didn't match!"]);
        }
        $tokenData = DB::table('password_resets')->where('token', $request->token)->first();

        if ($tokenData->email !== $request->email) {
            return back()->withErrors(["email" => "Wrong Email!"]);
        }

        $user = User::whereBaseEnc('email', '=', $tokenData->email)->first();
        if (!$user) return back()->withErrors(["email" => "Email Not Found!"]);

        if ($request->hasFile('id_image') && $request->file('id_image')->isValid()) {
            $filenameWithExt    = $request->file('id_image')->getClientOriginalName();
            $file_name          = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename           = preg_replace('/\s+/', '_', $file_name);
            $extension          = $request->file('id_image')->getClientOriginalExtension();
            $image              = $filename . '_' . time() . '.' .  $extension;
            $imagefile          = $request->file('id_image');
            $img                = Image::make($imagefile->path());
            $destinationPath    = storage_path('app/public/ID_Images');
            $img->resize(1920, 1080, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image);
        } else {
            return back()->withErrors(["id_image" => "Please check the image before uploading!"]);
        }

        $user->password         = Hash::make($password);
        $user->id_image         = $image;
        $user->update();

        //do we log the user directly or let them login and try their password for the first time ? if yes
        Auth::login($user);

        // If the user shouldn't reuse the token later, delete the token
        DB::table('password_resets')->where('email', $user->email)->delete();

        return redirect('/Dashboard');
    }

    //Delete Client
    public function removeClient($id)
    {
        $user = User::find($id);
        if ($user->slides) {
            $user->slides()->detach();
        }
        if ($user->categories) {
            $user->categories()->detach();
        }
        if (SlideProgress::where("user_id", $user->id)) {
            SlideProgress::where("user_id", $user->id)->delete();
        }
        if ($user->id_image && file_exists(public_path('/storage/ID_Images/' . $user->id_image))) {
            unlink(public_path('/storage/ID_Images/' . $user->id_image));
        }
        if ($user->delete()) {
            return back()->with('message', 'Client Successfully Deleted!');
        } else {
            return back()->with('error', 'Error Deleting Client');
        }
    }

    //Category Controller Starts
    public function category()
    {
        $categories = Category::orderBy('title')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }
    public function categoryCreate()
    {
        return view('admin.categories.add');
    }
    public function categoryStore(Request $request)
    {
        $input =  $request->all();
        Validator::make($input, [
            'title'     => ['required', 'string', 'max:255'],
            'price'     => ['required', 'integer'],
            'active'    => ['required', 'in:Y,N'],
        ])->validate();

        Category::create([
            'title'     => $request['title'],
            'price'     => $request['price'],
            'active'    => $request['active'],
        ]);

        return redirect('/admin/category')->with('message', 'Category Added Successfully');
    }
    public function categoryEdit($id)
    {
        $category = Category::find($id);
        return view("admin.categories.edit", compact('category'));
    }
    public function categoryUpdate(Request $request, $id)
    {
        $input =  $request->all();
        Validator::make($input, [
            'title'     => ['required', 'string', 'max:255'],
            'price'     => ['required', 'integer'],
            'active'    => ['required', 'in:Y,N'],
        ])->validate();

        $category = Category::find($id);
        $category->title    = $request['title'];
        $category->price    = $request['price'];
        $category->active   = $request['active'];
        $category->save();

        return redirect('/admin/category')->with('message', 'Category Updated Successfully');
    }
    public function categoryDestroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('/admin/category')
            ->with('message', 'Category Deleted!');
    }
    //Category Controller Ends


    //Subcategory Controller Starts
    public function subcategoryCat()
    {
        $categories = Category::orderBy('title')->paginate(100);
        return view('admin.subcategories.index', compact('categories'));
    }
    public function subcategory($id)
    {
        $subcategories = Subcategory::orderBy('title')->where('category_id', $id)->with('category')->paginate(100);
        $showSubcat = true;
        return view('admin.subcategories.index', compact(['subcategories', 'showSubcat']));
    }
    public function subcategoryCreate()
    {
        $categories = Category::orderBy('title')->get();
        return view('admin.subcategories.add', compact('categories'));
    }
    public function subcategoryStore(Request $request)
    {
        $input =  $request->all();
        Validator::make($input, [
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer'],
            'active' => ['required', 'in:Y,N'],
        ])->validate();

        $subcategory = Subcategory::create([
            'title'         => $request['title'],
            'category_id'   =>  $request['category_id'],
            'active'        => $request['active'],
        ]);

        return redirect('/admin/subcategory/index/' . $subcategory->category_id)->with('message', 'Subcategory Added Successfully');
    }
    public function subcategoryEdit($id)
    {
        $categories = Category::orderBy('title')->get();
        $subcategory = Subcategory::find($id);

        return view("admin.subcategories.edit")
            ->with('subcategory', $subcategory)
            ->with('categories', $categories);
    }
    public function subcategoryUpdate(Request $request, $id)
    {
        $input =  $request->all();
        Validator::make($input, [
            'title'         => ['required', 'string', 'max:255'],
            'category_id'   => ['required', 'integer'],
            'active'        => ['required', 'in:Y,N'],
        ])->validate();

        $subcategory = Subcategory::find($id);
        $subcategory->title = $request['title'];
        $subcategory->category_id = $request['category_id'];
        $subcategory->active = $request['active'];
        $subcategory->save();

        return redirect('/admin/subcategory/index/' . $subcategory->category_id)->with('message', 'Subcategory Updated Successfully');
    }
    public function subcategoryDestroy($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();

        return redirect('/admin/subcategory/cat')
            ->with('message', 'Subcategory Deleted!');
    }
    //Subcategory Controller Ends

    //Ques & Ans Controller Starts
    public function qaCat()
    {
        $categories = Category::orderBy('title')->paginate(100);
        $showCat = true;
        return view('admin.qas.index', compact(['categories', 'showCat']));
    }
    public function qaSubcat($id)
    {
        $subcategories = Subcategory::orderBy('title')->where('category_id', $id)->with('category')->paginate(100);
        $showSubcat = true;
        return view('admin.qas.index', compact(['subcategories', 'showSubcat']));
    }
    public function qa($id)
    {
        $qas = Qa::where('subcategory_id', $id)->with('category', 'subcategory')->paginate(100);
        return view('admin.qas.index', compact('qas'));
    }
    public function qaCreate()
    {
        $categories = Category::orderBy('title')->get();
        $subcategories = Subcategory::orderBy('title')->get();
        return view('admin.qas.add')
            ->with('categories', $categories)
            ->with('subcategories', $subcategories);
    }
    public function qaStore(Request $request)
    {
        $input =  $request->all();
        Validator::make($input, [
            'category_id'   => ['required', 'integer'],
            'subcategory_id' => ['required', 'integer'],
            'multi_choice'  => ['required', 'in:Y,N'],
            'question'      => ['required', 'string', 'max:1000'],
            'option1'       => ['required', 'max:1000'],
            'option2'       => ['required', 'max:1000'],
            'option3'       => ['max:1000'],
            'option4'       => ['max:1000'],
            'option5'       => ['max:1000'],
            'option6'       => ['max:1000'],
            'option7'       => ['max:1000'],
            'option8'       => ['max:1000'],
            'answer'        => ['required'],
            'active'        => ['required', 'in:Y,N']
        ], [
            'answer.required' => 'Please choose an answer!'
        ])->validate();

        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                $this->validate($request, [
                    'image' => ['mimes:png,jpeg,jpg|max:10000']
                ]);

                $filenameWithExt    = $request->file('image')->getClientOriginalName();
                $file_name          = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $filename           = preg_replace('/\s+/', '_', $file_name);
                $extension          = $request->file('image')->getClientOriginalExtension();
                $image              = $filename . '_' . time() . '.' .  $extension;
                $imagefile          = $request->file('image');
                $img                = Image::make($imagefile->path());
                $destinationPath    = storage_path('app/public/qa');
                $img->resize(1920, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $image);
            }
        } else {
            $image = 'no_image.png';
        }

        $qa = Qa::create([
            'category_id'   => $request['category_id'],
            'subcategory_id' => $request['subcategory_id'],
            'multi_choice'  => $request['multi_choice'],
            'question'      => $request['question'],
            'image'         => $image,
            'option1'       => $request['option1'],
            'option2'       => $request['option2'],
            'option3'       => $request['option3'],
            'option4'       => $request['option4'],
            'option5'       => $request['option5'],
            'option6'       => $request['option6'],
            'option7'       => $request['option7'],
            'option8'       => $request['option8'],
            'answer'        => implode(",", $request['answer']),
            'active'        => $request['active']
        ]);

        return redirect('/admin/qas/index/' . $qa->subcategory_id)->with('message', 'Ques&Ans Added Successfully');
    }
    public function qaEdit($id)
    {
        $categories = Category::orderBy('title')->get();
        $subcategories = Subcategory::orderBy('title')->get();
        $qa = Qa::find($id);
        return view("admin.qas.edit", compact(['qa', 'categories', 'subcategories']));
    }
    public function qaUpdate(Request $request, $id)
    {
        $input =  $request->all();
        Validator::make($input, [
            'category_id'   => ['required', 'integer'],
            'subcategory_id' => ['required', 'integer'],
            'multi_choice'  => ['required', 'in:Y,N'],
            'question'      => ['required', 'string', 'max:1000'],
            'option1'       => ['required', 'max:1000'],
            'option2'       => ['required', 'max:1000'],
            'option3'       => ['max:1000'],
            'option5'       => ['max:1000'],
            'option6'       => ['max:1000'],
            'option7'       => ['max:1000'],
            'option8'       => ['max:1000'],
            'answer'        => ['required'],
            'active'        => ['required', 'in:Y,N']
        ], [
            'answer.required' => 'You have to choose an answer!'
        ])->validate();



        $qa = Qa::find($id);

        if ($request['default_slide_content']) {
            $image      = $request['default_slide_content'];
        } elseif ($request->hasFile('image')) {
            //  Let's do everything here
            if (@$qa->image && file_exists(public_path('/storage/qa/' . @$qa->image))) {
                unlink(public_path('/storage/qa/' . @$qa->image));
            }
            if ($request->file('image')->isValid()) {
                $this->validate($request, [
                    'image' => ['mimes:png,jpeg,jpg|max:10000']
                ]);

                $filenameWithExt    = $request->file('image')->getClientOriginalName();
                $file_name          = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $filename           = preg_replace('/\s+/', '_', $file_name);
                $extension          = $request->file('image')->getClientOriginalExtension();
                $image              = $filename . '_' . time() . '.' .  $extension;
                $imagefile          = $request->file('image');
                $img                = Image::make($imagefile->path());
                $destinationPath    = storage_path('app/public/qa');
                $img->resize(1920, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $image);
                Storage::delete('public/qa/' . @$_POST['default_slide_content']);
            }
        } else {
            if (@$qa->image && file_exists(public_path('/storage/qa/' . @$qa->image))) {
                unlink(public_path('/storage/qa/' . @$qa->image));
            }
            $image = '';
        }
        $qa->category_id    = $request['category_id'];
        $qa->subcategory_id = $request['subcategory_id'];
        $qa->multi_choice   = $request['multi_choice'];
        $qa->image          = $image;
        $qa->question       = $request['question'];
        $qa->option1        = $request['option1'];
        $qa->option2        = $request['option2'];
        $qa->option3        = $request['option3'];
        $qa->option4        = $request['option4'];
        $qa->option5        = $request['option5'];
        $qa->option6        = $request['option6'];
        $qa->option7        = $request['option7'];
        $qa->option8        = $request['option8'];
        $qa->answer         = implode(",", $request['answer']);
        $qa->active         = $request['active'];
        $qa->save();
        return redirect('/admin/qas/index/' . $qa->subcategory_id)->with('message', 'Ques&Ans Updated Successfully');
    }
    public function qaDestroy($id)
    {

        $qa                    = Qa::find($id);
        $slideContent          = $qa->slideContent;
        if ($slideContent) {
            $slideContent->qa_id   = implode(',', array_diff(explode(',', $slideContent->qa_id), [$qa->id]));
            $slideContent->save();
        }
        if (@$qa->image && file_exists(public_path('/storage/qa/' . @$qa->image))) {
            unlink(public_path('/storage/qa/' . @$qa->image));
        }
        $qa->delete();

        return back()
            ->with('message', 'Ques&Ans Deleted!');
    }
    //Ques & AnsController Ends

    //Slides  Controller Starts
    public function slideCat()
    {
        $categories = Category::orderBy('title')->paginate(10);
        $showCat = true;
        return view('admin.slides.index', compact(['categories', 'showCat']));
    }
    public function slideSubcat($id)
    {
        $subcategories = Subcategory::orderBy('title')->where('category_id', $id)->with('category')->paginate(100);
        $showSubcat = true;
        return view('admin.slides.index', compact(['subcategories', 'showSubcat']));
    }
    public function slide($id)
    {
        $slides = Slide::where('subcategory_id', $id)->with('category', 'subcategory')->paginate(10);
        return view('admin.slides.index', compact('slides'));
    }
    public function slideCreate()
    {
        $categories = Category::orderBy('title')->get();
        $subcategories = Subcategory::orderBy('title')->get();
        $qas = Qa::all();
        return view('admin.slides.add')
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('qas', $qas);
    }
    public function slideStore(Request $request)
    {
        ini_set('upload_max_filesize', '500M');
        ini_set('max_file_uploads', '250');
        ini_set('max_execution_time', '300');

        //Validation Start
        $input =  $request->all();
        Validator::make($input, [
            'category_id' => ['required', 'integer'],
            'subcategory_id' => ['required', 'integer'],
            'audio' => ['mimes:mp3,wav,ogg|max:10000'],
            'slide_content1' => ['required'],
            // 'active' => ['required', 'in:Y,N']
        ], [
            'slide_content1' => 'Please add at least 1 slide!'
        ])->validate();
        //Validation End

        $slide = Slide::create([
            'category_id'       => $request['category_id'],
            'subcategory_id'    => $request['subcategory_id'],
            'total_slide'       => 0,
            'active' => "Y"
            // 'active' => $request['active']
        ]);

        for ($i = 1; $i <= 1000; $i++) {
            if ($request['slide_content' . $i]) {
                $slideContent = new SlideContent();
                $slideContent->slide_id = $slide->id;
                $slideContent->slide_index = $i;
                $slideContent->cool_down = $request['cool_down' . $i];
                // save audio file, if exist
                if (@$request->file('slide_audio' . $i)) {
                    $filename        = 'audio' . '_' . rand(1, 5) . time() . rand(1, 5);
                    $audiofile       = $request->file('slide_audio' . $i)->path();
                    $destinationPath = public_path('storage/slides/audio');
                    $mp3_file        = $filename . '.mp3';
                    $request->file('slide_audio' . $i)->move($destinationPath, $mp3_file);
                    $audio = $mp3_file;
                } else {
                    $audio = '';
                }
                $slideContent->audio = $audio;

                if ($request->file('slide_content' . $i) != null) {
                    $filenameWithExt    = $request->file('slide_content' . $i)->getClientOriginalName();
                    $filename           = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $filename           = str_replace(' ', '_', $filename);
                    $extension          = $request->file('slide_content' . $i)->getClientOriginalExtension();
                    $image              = $filename . '_' . time() . '.' .  $extension;
                    $imagefile          = $request->file('slide_content' . $i);
                    $img                = Image::make($imagefile->path());
                    $destinationPath    = storage_path('app/public/slideImages');
                    $img->resize(1920, 1080, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $image);
                    $slideContent->image = $image;
                } else if (!is_array($request['slide_content' . $i]) && str_contains($request['slide_content' . $i], 'youtube')) {
                    $slideContent->video = $request['slide_content' . $i];
                } else {
                    $qa_ids = array_filter($request['slide_content' . $i], function ($id) {
                        return ($id != "");
                    });
                    $slideContent->qa_id = implode(',', $qa_ids);
                }
                $slideContent->save();
            } else {
                $slide->total_slide = $i - 1;
                $slide->save();
                break;
            }
        }
        return redirect("/admin/slides/edit/" . $slide->id);
    }
    public function slideEdit($id)
    {
        $categories       = Category::orderBy('title')->get();
        $subcategories    = Subcategory::orderBy('title')->get();
        $slide            = Slide::find($id);
        $qas              = Qa::all();
        return view("admin.slides.edit", compact(['slide', 'categories', 'subcategories', 'qas']));
    }
    public function slideOrder($id)
    {
        $categories = Category::orderBy('title')->get();
        $subcategories = Subcategory::orderBy('title')->get();
        $slide = Slide::find($id);
        $qas = Qa::all();
        return view("admin.slides.slideOrder", compact(['slide', 'categories', 'subcategories', 'qas']));
    }
    public function slideUpdate(Request $request, $id)
    {
        //Validation Start
        $input =  $request->all();
        Validator::make($input, [
            'category_id'       => ['required', 'integer'],
            'subcategory_id'    => ['required', 'integer'],
            'audio'             => ['mimes:mp3,wav,ogg|max:10000'],
            // 'active'            => ['required', 'in:Y,N']
        ])->validate();
        //Validation End

        $slide          = Slide::find($id);
        $total_slide    = 0;
        $slidImages     = [];
        $slideAudio     = [];
        for ($i = 1; $i <= 1000; $i++) {
            $slideContent = SlideContent::where('slide_id', $slide->id)
                ->where('slide_index', $i)->first();
            // Save audio
            if ($request['default_slide_content' . $i] || $request['slide_content' . $i]) {
                if (!@$slideContent) {
                    $slideContent = new SlideContent();
                }
                $slideContent->slide_id    = $slide->id;
                $slideContent->slide_index = $i;
                $slideContent->image       = null;
                $slideContent->video       = null;
                $slideContent->qa_id       = null;
                $slideContent->cool_down   = $request['cool_down' . $i];
                // save audio file, if exist
                if (@$request->file('slide_audio' . $i)) {
                    $filename        = 'audio' . '_' . rand(1, 5) . time() . rand(1, 5);
                    $destinationPath = storage_path('app/public/slides/audio');
                    $mp3_file        =  $filename . '.mp3';
                    $request->file('slide_audio' . $i)->move($destinationPath, $mp3_file);
                    array_push($slideAudio, $mp3_file);
                    if (
                        @$slideContent->audio &&
                        !in_array($slideContent->audio, $slideAudio) &&
                        file_exists(public_path('/storage/slides/audio/' . @$slideContent->audio))
                    ) {
                        unlink(public_path('/storage/slides/audio/' . @$slideContent->audio));
                    }
                    $audio = $mp3_file;
                } elseif ($request['slide_audio_old' . $i]) {
                    $audio = $request['slide_audio_old' . $i];
                } else {
                    $audio = null;
                }
                $slideContent->audio = $audio;
            }

            if ($request['slide_content' . $i]) {
                if ($request->file('slide_content' . $i) != null) {
                    //if image
                    $filenameWithExt    = $request->file('slide_content' . $i)->getClientOriginalName();
                    $filename           = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $filename           = str_replace(' ', '_', $filename);
                    $extension          = $request->file('slide_content' . $i)->getClientOriginalExtension();
                    $image              = $filename . '_' . time() . '.' .  $extension;
                    $imagefile          = $request->file('slide_content' . $i);
                    $img                = Image::make($imagefile->path());
                    $destinationPath    = storage_path('app/public/slideImages');
                    $img->resize(1920, 1080, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $image);
                    array_push($slidImages, $image);
                    if (
                        @$slideContent->image &&
                        !in_array($slideContent->image, $slidImages) &&
                        file_exists(public_path('/storage/slideImages/' . @$slideContent->image))
                    ) {
                        unlink(public_path('/storage/slideImages/' . @$slideContent->image));
                    }

                    if ($slideContent) {
                        //if slide exit
                        $slideContent->image         = $image;
                        $slideContent->save();
                    } else {
                        SlideContent::create([
                            'slide_id'      => $slide->id,
                            'slide_index'   => $i,
                            'image'         => $image,
                            'cool_down'     => $request['cool_down' . $i]
                        ]);
                    }
                } else if (
                    !is_array($request['slide_content' . $i]) &&
                    (str_contains($request['slide_content' . $i], 'youtube') ||
                        str_contains($request['slide_content' . $i], 'youtu.be'))
                ) {
                    //if video
                    if (
                        @$slideContent->image &&
                        !in_array($slideContent->image, $slidImages) &&
                        file_exists(public_path('/storage/slideImages/' . @$slideContent->image))
                    ) {
                        unlink(public_path('/storage/slideImages/' . @$slideContent->image));
                    }
                    if ($slideContent) {
                        //if slide exit
                        $slideContent->video        = $request['slide_content' . $i];
                        $slideContent->save();
                    } else {
                        SlideContent::create([
                            'slide_id'      => $slide->id,
                            'slide_index'   => $i,
                            'video'         => $request['slide_content' . $i],
                            'cool_down'     => $request['cool_down' . $i]
                        ]);
                    }
                } else {
                    //if q&a
                    if (
                        @$slideContent->image &&
                        !in_array($slideContent->image, $slidImages) &&
                        file_exists(public_path('/storage/slideImages/' . @$slideContent->image))
                    ) {
                        unlink(public_path('/storage/slideImages/' . @$slideContent->image));
                    }
                    if ($slideContent) {
                        //if slide exit
                        $qa_ids = array_filter($request['slide_content' . $i], function ($id) {
                            return ($id != "");
                        });
                        $slideContent->qa_id        = implode(',', $qa_ids);
                        $slideContent->save();
                    } else {
                        SlideContent::create([
                            'slide_id'      => $slide->id,
                            'slide_index'   => $i,
                            'qa_id'         => implode(',', $request['slide_content' . $i]),
                            'cool_down'     => $request['cool_down' . $i]
                        ]);
                    }
                }
                $total_slide = $i;
            } else if ($request['default_slide_content' . $i]) {
                // if default image
                array_push($slidImages, $request['default_slide_content' . $i]);
                $total_slide = $i;
                $slideContent->image         = $request['default_slide_content' . $i];
                $slideContent->video         = null;
                $slideContent->qa_id         = null;
                $slideContent->cool_down     = $request['cool_down' . $i];
                $slideContent->save();
            } else {
                // if no slide data
                if (
                    @$slideContent->image &&
                    !in_array($slideContent->image, $slidImages) &&
                    file_exists(public_path('/storage/slideImages/' . @$slideContent->image))
                ) {
                    unlink(public_path('/storage/slideImages/' . @$slideContent->image));
                }
                if (
                    @$slideContent->audio &&
                    !in_array($slideContent->audio, $slideAudio) &&
                    file_exists(public_path('/storage/slides/audio/' . @$slideContent->audio))
                ) {
                    unlink(public_path('/storage/slides/audio/' . @$slideContent->audio));
                }
                if ($slideContent) {
                    //if slide exit but request doesn't
                    $slideContent->delete();
                } else {
                    break;
                }
            }
        }

        $slide->category_id       = $request['category_id'];
        $slide->subcategory_id    = $request['subcategory_id'];
        $slide->total_slide       = $total_slide;
        $slide->active            = "Y";
        // $slide->active            = $request['active'];
        $slide->save();

        if ($request['addNewSlide']) {
            return redirect('/admin/slides/edit/' . $id);
        } elseif ($request['slideOrder']) {
            return redirect('/admin/slides/slideOrder/' . $id);
        }

        return redirect('/admin/slides/index/' . $slide->subcategory_id)->with('message', 'Slide Added Successfully');
    }

    public function slideContentUpdate(Request $request, $slideID, $contentIndex)
    {
        //Validation Start
        $input =  $request->all();
        Validator::make($input, [
            'audio'             => ['mimes:mp3,wav,ogg|max:10000'],
        ])->validate();
        //Validation End

        $slide          = Slide::findOrFail($slideID);
        if (!$slide) {
            return response()->json(['error' => 'Lesson not found'], 404);
        }
        $slideContent   = SlideContent::where('slide_id', $slideID)->where('slide_index', $contentIndex)->first();

        $slidImages     = [];
        $slideAudio     = [];
        $reload         = false;
        // Save audio
        if ($request['default_slide_content' . $contentIndex] || $request['slide_content' . $contentIndex]) {
            if (!@$slideContent && ($slide->total_slide + 1) == $contentIndex) {
                // create new slide content
                $slideContent = new SlideContent();
                $slide->total_slide += 1;
            }
            $slideContent->slide_id    = $slide->id;
            $slideContent->slide_index = $contentIndex;
            $slideContent->image       = null;
            $slideContent->video       = null;
            $slideContent->qa_id       = null;
            $slideContent->cool_down   = $request['cool_down' . $contentIndex];
            // Save audio file, if exist
            if (@$request->file('slide_audio' . $contentIndex)) {
                $filename        = 'audio' . '_' . rand(1, 5) . time() . rand(1, 5);
                $destinationPath = storage_path('app/public/slides/audio');
                $mp3_file        =  $filename . '.mp3';
                $request->file('slide_audio' . $contentIndex)->move($destinationPath, $mp3_file);
                array_push($slideAudio, $mp3_file);
                if (
                    @$slideContent->audio &&
                    !in_array($slideContent->audio, $slideAudio) &&
                    file_exists(public_path('/storage/slides/audio/' . @$slideContent->audio))
                ) {
                    unlink(public_path('/storage/slides/audio/' . @$slideContent->audio));
                }
                $audio = $mp3_file;
            } elseif ($request['slide_audio_old' . $contentIndex]) {
                $audio = $request['slide_audio_old' . $contentIndex];
            } else {
                $audio = null;
            }
            $slideContent->audio = $audio;
        }

        // Save/Update/Delete Slide Content
        if ($request['slide_content' . $contentIndex]) {
            if ($request->file('slide_content' . $contentIndex) != null) {
                //if image
                $filenameWithExt    = $request->file('slide_content' . $contentIndex)->getClientOriginalName();
                $filename           = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $filename           = str_replace(' ', '_', $filename);
                $extension          = $request->file('slide_content' . $contentIndex)->getClientOriginalExtension();
                $slideIDmage              = $filename . '_' . time() . '.' .  $extension;
                $slideIDmagefile          = $request->file('slide_content' . $contentIndex);
                $slideIDmg                = Image::make($slideIDmagefile->path());
                $destinationPath    = storage_path('app/public/slideImages');
                $slideIDmg->resize(1920, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $slideIDmage);
                array_push($slidImages, $slideIDmage);
                if (
                    @$slideContent->image &&
                    !in_array($slideContent->image, $slidImages) &&
                    file_exists(public_path('/storage/slideImages/' . @$slideContent->image))
                ) {
                    unlink(public_path('/storage/slideImages/' . @$slideContent->image));
                }

                $slideContent->image         = $slideIDmage;
            } else {
                // IF not image delete old image
                if (
                    @$slideContent->image &&
                    !in_array($slideContent->image, $slidImages) &&
                    file_exists(public_path('/storage/slideImages/' . @$slideContent->image))
                ) {
                    unlink(public_path('/storage/slideImages/' . @$slideContent->image));
                }

                if (
                    !is_array($request['slide_content' . $contentIndex]) &&
                    (str_contains($request['slide_content' . $contentIndex], 'youtube') ||
                        str_contains($request['slide_content' . $contentIndex], 'youtu.be'))
                ) {
                    //if video
                    $slideContent->video        = $request['slide_content' . $contentIndex];
                } else {
                    //if q&a
                    $qa_ids = array_filter($request['slide_content' . $contentIndex], function ($contentIndex) {
                        return ($contentIndex != "");
                    });
                    $slideContent->qa_id        = implode(',', $qa_ids);
                }
            }
        } else if ($request['default_slide_content' . $contentIndex]) {
            // if default image
            array_push($slidImages, $request['default_slide_content' . $contentIndex]);
            $slideContent->image         = $request['default_slide_content' . $contentIndex];
        } else {
            if (@$slideContent && $slideContent->count() > 0) {
                if (SlideContent::find($slideContent->id)->delete()) {
                    // Change index of slide content after this slide
                    if ($scAfter = SlideContent::where('slide_id', $slideID)->where('slide_index', '>', $contentIndex)->get()) {
                        foreach ($scAfter as $sc) {
                            $sc->slide_index -= 1;
                            $sc->save();
                        }
                    }
                    // Delete Slide Content
                    if (
                        @$slideContent->image &&
                        !in_array($slideContent->image, $slidImages) &&
                        file_exists(public_path('/storage/slideImages/' . @$slideContent->image))
                    ) {
                        unlink(public_path('/storage/slideImages/' . @$slideContent->image));
                    }
                    if (
                        @$slideContent->audio &&
                        !in_array($slideContent->audio, $slideAudio) &&
                        file_exists(public_path('/storage/slides/audio/' . @$slideContent->audio))
                    ) {
                        unlink(public_path('/storage/slides/audio/' . @$slideContent->audio));
                    }
                    $slide->total_slide -= 1;
                } else {
                    return response()->json(['success' => false, 'message' => 'Error deleting slide content!']);
                }
            }
            $reload = true;
        }
        if (@$slide) {
            $slide->save();
        }
        if (@$slideContent) {
            $slideContent->save();
        }
        return response()->json([
            'success' => true,
            'reload' => $reload,
        ]);
    }
    public function slideUpdateDetails(Request $request, $slideID)
    {
        //Validation Start
        $input =  $request->all();
        Validator::make($input, [
            'category_id'    => ['required'],
            'subcategory_id' => ['required'],
            // 'active'         => ['in:Y,N'],
        ])->validate();
        //Validation End

        $slide                  = Slide::findOrFail($slideID);
        $slide->subcategory_id  = $request['subcategory_id'];
        $slide->category_id     = $request['category_id'];
        $slide->active          = "Y";
        // $slide->active       = $request['active'];
        $slide->save();

        // $slideContent->save();
        return back()->with('success', 'Slide Updated Successfully');
    }
    public function slideOrderUpdate(Request $request, $id)
    {
        $slide                            = Slide::find($id);
        $slideContents                    = SlideContent::where('slide_id', $slide->id)->get();
        for ($i = 1; $i <= $slide->total_slide; $i++) {
            $slideContent                 = SlideContent::find($slideContents->where('slide_index', $i)->first()->id);
            $slideContent->slide_index    = $request['slide_content' . $i];
            $slideContent->save();
        }
        return redirect('/admin/slides/edit/' . $slide->id);
    }
    public function slideDestroy($id)
    {
        $slide      = Slide::find($id);
        foreach ($slide->slideContents as $slideContent) {
            if (@$slideContent->image && file_exists(public_path('/storage/slideImages/' . @$slideContent->image))) {
                unlink(public_path('/storage/slideImages/' . @$slideContent->image));
            }
            $slideContent->delete();
        }
        $slide->delete();

        return back()
            ->with('message', 'Slide Deleted!');
    }
    public function getqas(Request $request)
    {
        if ($request->ajax()) {
            $output     = "";
            $qas        = Qa::where('subcategory_id', $request->subcat_id)->get();

            if ($qas) {
                foreach ($qas as $key => $qa) {
                    $output .= "<option value='" . $qa->id . "'>" . $qa->question . " </option> ";
                }
            }
            return Response($output);
        }
    }
    //Slides Controller Ends

    //Reset Progress Starts
    public function resetProgressIndex()
    {
        $categories       = Category::all();
        $subcategories    = Subcategory::all();
        $users            = User::has('slideprogress')->get();

        return view("admin.resetProgress", compact(['categories', 'subcategories', 'users']));
    }

    public function resetProgress(Request $request)
    {
        // dd($request);
        if (!($user_id = $request->user_id)) {
            return redirect("/admin/reset_progress")->withErrors(['Please select a user!']);
        }
        if ($request->subcategory_id || $request->category_id) {
            $slide = Slide::whereNotNull('subcategory_id');
            if ($request->subcategory_id) {
                $slide->where('subcategory_id', $request->subcategory_id);
            }
            if ($slide && $request->category_id) {
                $slide->where('category_id', $request->category_id);
            }
            $slide_ids = $slide->get()->pluck('id');
            if (count($slide_ids)) {
                //Delete previously saved user answer for this slide
                foreach ($slide_ids as $s_id) {
                    if (
                        $qa_ids = SlideContent::where('slide_id', $s_id)
                        ->whereNotNull('qa_id')
                        ->get()
                        ->pluck('qa_id')
                    ) {
                        foreach ($qa_ids as $qa_id) {
                            foreach (explode(',', $qa_id) as $id) {
                                UserAnswer::where('user_id', $user_id)->where('qa_id', $id)->delete();
                            }
                        }
                    }
                }
                SlideProgress::where('user_id',  $request->user_id)
                    ->whereIn('slide_id',  $slide_ids)
                    ->delete();
            } else {
                return back()->withErrors(['Progress not found!']);
            }
        } else {
            SlideProgress::where('user_id',  $request->user_id)->delete();
            UserAnswer::where('user_id', $user_id)->delete();
        }
        return redirect()->back()->with([
            'message' => 'Progress Reset'
        ]);
    }
    //Reset Progress Ends

    //User Answers Starts
    public function user_answers_show()
    {
        $categories       = Category::all();
        $subcategories    = Subcategory::all();
        $users            = User::has('slideprogress')->get();

        return view("admin.userAnswers", compact(['categories', 'subcategories', 'users']));
    }

    public function user_answers(Request $request)
    {
        $user_id            = $request->user_id;
        $user               = User::find($user_id);
        if (!$user_id) {
            return redirect("/admin/user_answers")->withErrors(['Please select a user!']);
        }
        $qas                = QA::where('active', 'Y');
        if ($request->subcategory_id || $request->category_id) {
            if ($request->subcategory_id) {
                $qas->where('subcategory_id', $request->subcategory_id);
            }
            if ($qas && $request->category_id) {
                $qas->where('category_id', $request->category_id);
            }
            $user_answers   = UserAnswer::where('user_id', $user_id);
            if ($qas = $qas->with('category', 'subcategory')->get()) {
                $user_answers->whereIn('qa_id', $qas->pluck('id'));
            }
            $user_answers   = $user_answers->get();
        } else {
            $qas            = $qas->with('category', 'subcategory')->get();
            $user_answers   = UserAnswer::where('user_id', $user_id)->get();
        }

        $categories       = Category::all();
        $subcategories    = Subcategory::all();
        $users            = User::has('slideprogress')->get();

        return view("admin.userAnswers", compact(['categories', 'subcategories', 'users', 'user_answers', 'user', 'qas']))->with('cat_id', $request->category_id)
            ->with('subcat_id', $request->subcategory_id);
    }
    //User answers ends

    //User Agreements Starts
    public function allAgreements()
    {
        $categories       = Category::all();
        $subcategories    = Subcategory::all();
        $users            = User::has('slideprogress')->get();

        return view("admin.users.agreements", compact(['categories', 'subcategories', 'users']));
    }
    public function userAgreements(Request $request)
    {
        $users            = User::all();
        $categories       = Category::all();
        $subcategories    = Subcategory::all();
        return view("admin.users.agreements", compact(['users', 'request', 'categories', 'subcategories']));
    }
    //User Agreements Ends

    public function slidesCopy($id)
    {

        try {
            $task = Slide::find($id);
            // $task1 = $task->category_id;
            // return $task1;

            if (null !== $task) {
                $newTask = $task->replicate();
                return $newTask;
                if (null !== $newTask) {
                    $newTask->save();
                }
            }
            return back()->with('success', 'Client Profile Succesfully');
        } catch (Exception $e) {
            return back()->with('success', 'Client Profile Succesfully');
        }
    }

    public function categoryCopy($id)
    {


        try {
            $category = Category::find($id);
            if (null !== $category) {
                $newCategory = $category->replicate();
                $newCategory->title = $category->title . "-(Copy)";
                if (null !== $newCategory) {
                    $newCategory->save();

                    $newId = $newCategory->id;

                    $subCategories = Subcategory::where('category_id', '=', $id)->get();

                    if (null !== $subCategories) {
                        foreach ($subCategories as $subcategory) {
                            $newSubCategory = $subcategory->replicate();
                            $newSubCategory->category_id = $newId;
                            $newSubCategory->title = $subcategory->title . "-(Copy)";
                            $newSubCategory->save();
                            $newSubId = $newSubCategory->id;

                            // $newItem = Subcategory::find($item->id)->replicate();
                            // if (null !== $newItem) {
                            //     $newItem->save();
                            // }
                            $qas = Qa::where('subcategory_id', '=', $subcategory->id)->get();
                            if (null !== $qas) {
                                foreach ($qas as $qa) {
                                    $newQa = $qa->replicate();
                                    $newQa->category_id = $newId;
                                    $newQa->subcategory_id = $newSubId;
                                    $newQa->save();
                                    $newQaId = $newQa->id;

                                    $slides = Slide::where('subcategory_id', '=', $subcategory->id)->get();
                                    if (null !== $slides) {
                                        foreach ($slides as $slide) {
                                            $newSlide = $slide->replicate();
                                            $newSlide->category_id = $newId;
                                            $newSlide->subcategory_id = $newSubId;
                                            $newSlide->save();
                                            $newSlideId = $newSlide->id;
                                        }
                                    }
                                    $slideContents = SlideContent::where('slide_id', '=', $slide->id)->get();
                                    if (null !== $slideContents) {
                                        foreach ($slideContents as $slideContent) {
                                            $newSlideContent = $slideContent->replicate();
                                            $newSlideContent->slide_id = $newSlideId;
                                            $newSlideContent->qa_id = $newQaId;
                                            $newSlideContent->save();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            return back()->with('success', 'Client Profile Succesfully');
        } catch (Exception $e) {
            return back()->with('success', 'Client Profile Succesfully');
        }
    }
}