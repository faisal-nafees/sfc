<?php

namespace App\Http\Controllers\Auth;

use Auth;
use File;
use Image;
use App\Face;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Classes\Helper;
use App\Models\Category;
use App\Models\GeneralData;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Classes\MSFace\MSFace;
use Illuminate\Validation\Rule;
use App\Classes\FaceVerification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
  public function register(Request $request)
  {
    $request->validate([
      'fname'     => 'required|string|max:20|min:1',
      'lname'     => 'required|string|max:20|min:1',
      'email'     => ['required', 'email'],
      // 'org_code'  => 'max:6',
      'captcha'   => 'required|captcha'
    ], [
      'captcha'  => 'Captcha Verification Failed'
    ]);
    $emailExist     = User::whereBaseEnc('email', '=',$request->email)->first();
    if ($emailExist) {
      return back()->withErrors(['email' => 'The provided email belongs to a different account!']);
    }
    $input = $request->all();
    $input['email'] = strtolower($input['email']);
    $user = User::create([
      'fname'     => $input['fname'],
      'lname'     => $input['lname'],
      'email'     => $input['email'],
      // 'org_code'  => $request['org_code'],
      'password'  => Hash::make(base64_encode(random_bytes(10))),
    ]);


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
    return redirect("/login")->with('success', '*Check Spam/Junk Mail for Confirmation Email. Click on "Activate Account" in the email (' . $data['email'] . ')  to activate your account.')->with('email', $data['email']);
  }

  public function resendActivationEmail(Request $request)
  {
    $request->validate([
      'email'     => ['required', 'email'],
      // 'org_code'  => 'max:6',
      'captcha'   => 'required|captcha'
    ], [
      'captcha'  => 'Captcha Verification Failed'
    ]);

    $emailExist     = User::whereBaseEnc('email', '=',$request->email)->first();
    if ($emailExist) {
      $token = DB::table('password_resets')->where('email', $request->email)->value('token');

      $data = [
        'name'      => $emailExist->fname . ' ' . $emailExist->lname,
        'subject'   => 'Activate Account',
        'title'     => 'Activate Account',
        'body'      => 'Click on the link below to activate your account',
        'link'      => url('/') . '/password-reset/' . $token,
        'email'     => $emailExist->email,
      ];

      $mailSend = Mail::send('email.ActivateAccount', $data, function ($message) use ($data) {
        $message->to($data['email'], $data['name'])->subject('Activate Account');
        $message->from('support@kdetechnology.com', 'Safety First Consulting');
      });
      return redirect("/login")->with('success', '*Check Spam/Junk Mail for Confirmation Email. Click on "Activate Account" in 			the email (' . $data['email'] . ')  to activate your account.')->with('email', $data['email']);
    } else {
      return back()->withErrors(['email' => 'The provided email does not exist!']);
    }
  }

  public function reloadCaptcha()
  {
    return response()->json(['captcha' => captcha_img()]);
  }

  public function activateAccount(Request $request)
  {
    $validator = $request->validate([
      'token'                      => 'required',
      'id_image'                   => 'required|image|mimes:jpeg,png,jpg|max:6000',
      'password'                   => 'required|confirmed',
      'password_confirmation'      => 'required',
      'email'                      => 'required|email',
      'verified_face_uuid_forward' => 'required',
      'verified_face_uuid_right'   => 'required',
      'verified_face_uuid_left'    => 'required',
      'verified_face_uuid_up'      => 'required',
      'verified_face_uuid_down'    => 'required',
    ], 
    [
      'id_image.required'                   => 'Please upload a clear image of your ID Card!',
      'verified_face_uuid_forward.required' => 'Forward face pose is required for face verificaiton!',
      'verified_face_uuid_right.required'   => 'Right face pose is required for face verificaiton!',
      'verified_face_uuid_left.required'    => 'Left face pose is required for face verificaiton!',
      'verified_face_uuid_up.required'      => 'Up face pose is required for face verificaiton!',
      'verified_face_uuid_down.required'    => 'Down face pose is required for face verificaiton!',
    ]);
      
    try {
      
      $emailExist     = User::whereBaseEnc('email', '=',$request->email)->first();
      $tokenData = DB::table('password_resets')->where('token', $request->token)->first();

      if ($tokenData->email !== $request->email) {
        return Helper::handleErrors($request->ajax(), ["email" => "Wrong Email!"]);
      }

      $user = User::whereBaseEnc('email', '=',$tokenData->email)->first();
      if (!$user) return Helper::handleErrors($request->ajax(),["email" => "Email Not Found!"]);

      if (!$request->hasFile('id_image') && !$request->file('id_image')->isValid()) {
        return Helper::handleErrors($request->ajax(), ["id_image" => "ID Card image is not valid!"]);
      }

    
      // Int Microsoft Face API
      $msFace          = new MSFace();
      // Verify if large person group data exist, else create one
      $getLatestLPG = FaceVerification::getLatestLPG();
      $lpg = $getLatestLPG['lpg'];
      // Verify if person id exist, else create one
      if (!@$user->uuid) {
        $createLPGP = $msFace->createLPGP($lpg->largePersonGroupId,  $user->id, $user->fname . ' ' . $user->lname);

        if (!$createLPGP['success']) {
          return Helper::handleErrors($request->ajax(),  [json_decode(@$createLPGP['error']), 'webcam_image' => "Failed to verify face!"]);
        }
        $personUUID = $createLPGP['data']['personId'];
      } else {
        $personUUID = $user->uuid;
      }

      if ($emailExist) {
        if ($emailExist->face_verification == "N") {
          /* --------------------------- Webcam images --------------------------- */
          $poseDirections = ['forward', 'right', 'left', 'up', 'down'];
          // WEBCAM IMAGEs
          foreach ($poseDirections as $direction) {
            $webcamImageUrl = request()->getSchemeAndHttpHost() . '/' . $request['verified_face_uuid_' . $direction];
            // SAVE FACE UUID IN PERSON
            $addFaceToLPGP = $msFace->addFaceToLPGP($lpg->largePersonGroupId, $personUUID, $webcamImageUrl);
            if (!@$addFaceToLPGP['success']) {
              return Helper::handleErrors($request->ajax(), ['webcam' => 'Please capture a clear image of your face looking <b>' . $direction . '</b>']);
            }
            // DELETE TEMP IMAGE
            if (file_exists(public_path($request['verified_face_uuid_' . $direction]))) {
              unlink(public_path($request['verified_face_uuid_' . $direction]));
            }
          }
        }
      }
        /* --------------------------- ID CARD IMAGE --------------------------- */
      // Create a separate folder for user data
      $userDocPath            = public_path() . '/storage/users/' . $user->id;
      // path does not exist
      if (!file_exists($userDocPath)) {
        File::makeDirectory($userDocPath);
      }

      // Then save the id card image
      $IDCardImageName = 'id_card.jpg';
      $imgFile         = $request->file('id_image');
      $img             = Image::make($imgFile->path());
      $img->resize(1920, 1080, function ($constraint) {
        $constraint->aspectRatio();
      })->encode('jpg', 90)->save($userDocPath . '/' . $IDCardImageName);

      $user->uuid      = $personUUID;
      $user->password  = Hash::make($request->password);
      $user->status    = 'Active';
      $user->face_verification = 'Y';
      $user->update();

      Auth::login($user);

      // If the user shouldn't reuse the token later, delete the token
      DB::table('password_resets')->where('email', $user->email)->delete();
    } catch (\Exception $e) {
      return Helper::handleErrors($request->ajax(), ['Sorry, something went wrong!!']);
    }
    if ($request->ajax()) {
      return response()->json([
        'success' => true,
        'message' => 'Verification Complete',
        'redirect' => '/Dashboard'
      ]);
    } else {
      return redirect('/Dashboard');
    }
  }
}
