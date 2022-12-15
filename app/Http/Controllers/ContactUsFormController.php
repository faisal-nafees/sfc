<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;

class ContactUsFormController extends Controller
{

    // Create Contact Form
    public function createForm(Request $request)
    {
        return view('contact');
    }

    // Store Contact Form data
    public function ContactUsForm(Request $request)
    {

        // Form validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject' => 'required',
            'message' => 'required',
            'h-captcha-response' => 'required'
        ]);

        $token = $request['h-captcha-response'];

        $data = array(
            'secret' => "37df5f3f-3448-40cf-b20a-abc38b1bbf25",
            'response' => $token
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
			
        $response = curl_exec($verify);
        curl_close($verify);
        $data = json_decode($response, true);

        if ($data['success'] !== 1) {
            return back()->withErrors(['h-captcha-response' => 'Wrong captcha.']);
        }
		


        //  Store data in database
        // Contact::create($request->all());

        //  Send mail to admin
        Mail::send('email.contactus', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'subject' => $request->get('subject'),
            'user_query' => $request->get('message'),
        ), function ($message) use ($request) {
            $message->from($request->email);
            $message->to('SFC@contactform.page', '')->subject($request->get('subject'));
        });

        return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
    }
}
