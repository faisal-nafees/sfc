<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // public function authenticate(Request $request)
    // {
    //     $user   = User::whereBaseEnc('email', '=', $request->email)->first();

    //     if ($user) {
    //         if (Hash::check($request->password, $user->password)) {
    //             Auth::login($user);
    //             return redirect()->intended('/Dashboard');
    //         }
    //     }
    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }
}
