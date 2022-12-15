<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mail;

class ForgetController extends Controller
{


    public function forgetpass(Request $request)
    {

        $user = User::whereBaseEnc('email', '=',$request->email)->first();

        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found!']);
		
		if($user->face_verification == "N"){
			
			$token = DB::table('password_resets')->where('email',$request->email )->value('token');
			
			$data = [
				'name'      => $user->fname . ' ' . $user->lname,
				'subject'   => 'Activate Account',
				'title'     => 'Activate Account',
				'body'      => 'Click on the link below to activate your account',
				'link'      => url('/') . '/password-reset/' . $token,
				'email'     => $user->email,
			];
		
			$mailSend = Mail::send('email.ActivateAccount', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject('Activate Account');
            $message->from('support@kdetechnology.com', 'Safety First Consulting');
			});
        	return redirect('passwordreset')->with('success', 'Password reset link has been send to "' . $request->email . '"');
		
		}

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
            'subject'   => 'Password Rest Link ',
            'title'     => 'Reset Account Password',
            'body'      => 'Click on the link below to activate your account',
            'link'      => url('/') . '/forgetpass/' . $token,
            'email'     => $request->email,
        ];

        $mailSend = Mail::send('email.ActivateAccount', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject('Activate Account');
            $message->from('support@kdetechnology.com', 'Safety First Consulting');
        });

        return redirect('passwordreset')->with('success', 'Password reset link has been send to "' . $request->email . '"');
    }

    public function resetpass(Request $request)
    {
        $request->validate([
            'token'                 => 'required',
            'password'              => 'required',
            'password_confirmation' => 'required',
            Fortify::email()        => 'required|email',
        ]);

        $password = $request->password;

        if ($password !== $request->password_confirmation) {
            return back()->withErrors(["password" => "Password didn't match!"]);
        }
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();

        if ($tokenData->email !== $request->email) {
            return back()->withErrors(["email" => "Wrong Email!"]);
        }

        $user = User::whereBaseEnc('email', '=',$tokenData->email)->first();
        if (!$user) return back()->withErrors(["email" => "Email Not Found!"]); //or wherever you want

        $user->password             = Hash::make($password);
        $user->update(); //or $user->save();

        //do we log the user directly or let them login and try their password for the first time ? if yes
        //Auth::login($user);

        // If the user shouldn't reuse the token later, delete the token
        DB::table('password_resets')->where('email', $user->email)->delete();

        return redirect('/login')->with('success', 'Password Successfully Updated');
    }

    public function showforgetPass($token)
    {
        $tokenData = DB::table('password_resets')
            ->where('token', $token)->first();

        if (!$tokenData) return redirect()->to('home'); //redirect them anywhere you want if the token does not exist.
        return view('auth.resetpass')->with('token', $token);
    }
}
