<?php

namespace App\Http\Controllers;

use Image;
use File;
use App\Models\User;
use App\Classes\Helper;
use App\Models\GeneralData;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Classes\FaceVerification;
use App\Classes\MSFace\MSFace;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class FaceVerificationController extends Controller
{
    public function verifyHeadPose(Request $request)
    {
        $request->validate([
            'face_image'    => 'required',
            'direction'     => 'in:forward,right,left,up,down|required'
        ], [
            'face'          => 'Please capture clear image of your face!'
        ]);
        $faceURL = Helper::optimizeImageToURL($request->face_image);
		Log::info('face detecion url .', $faceURL);
		//$request->file('face_image')->storeAs('face_images',  $request->direction .'_'. $faceURL);
        if (!@$faceURL['url']) {
            return response()->json(['error' => 'Please capture clear image of your face!']);
        }
        $direction = $request->direction;
        $errorMSG = 'Failed to verify face!, Please capture a clear image of your face looking  <b>' . $direction . '</b> in a well lit environment!';
        try {
            $msFace  = new MSFace();    // Int Microsoft Face API

            // DETECT FACES FROM WEBCAM
            $detectFace = $msFace->detectFace($faceURL['url'], ['headPose']);

            if ($detectFace['success']) {
                $headPose = $detectFace['data'][0]['faceAttributes']['headPose'];
                $headPoseCorrect = true;

                if ($direction == 'forward') {
                    if ($headPose['roll'] > 10 || $headPose['roll'] < -10 || $headPose['yaw'] > 10 || $headPose['yaw'] < -10 || $headPose['pitch'] > 15 || $headPose['pitch'] < -15) {
                        $headPoseCorrect = false;
                    }
                } elseif ($direction == 'right') {
                    if ($headPose['yaw'] > -10) {
                        $headPoseCorrect = false;
                    }
                } elseif ($direction == 'left') {
                    if ($headPose['yaw'] < 10) {
                        $headPoseCorrect = false;
                    }
                } elseif ($direction == 'up') {
                    if ($headPose['pitch'] < 0) {
                        $headPoseCorrect = false;
                    }
                } elseif ($direction == 'down') {
                    if ($headPose['pitch'] > 0) {
                        $headPoseCorrect = false;
                    }
                }
                if ($headPoseCorrect) {
                    // if ($direction == 'down') {
                    // 	$emailExist     = User::whereBaseEnc('email', '=',$request->email)->first();
                    // 	if ($emailExist) {
                    // 		$user = User::find($emailExist->id);
                    // 		$user->face_verification = "Y";
                    // 		$user->save();
                    // 		return response()->json(['success' => true, 'temp_face_path' => $faceURL['tempPath'],'email'=> $request->email,'face_verified'=>true]);
                    // 	}
                    // }
                    return response()->json(['success' => true, 'temp_face_path' => $faceURL['tempPath'], 'email' => $request->email, 'face_verified' => false]);
                }
            }

            throw new \Exception($errorMSG.' > '.$detectFace['error']);
        } catch (\Exception $e) {
            return response()->json(['error' =>  $errorMSG]);
        } catch (\Throwable $th) {
            return response()->json(['error' =>  $errorMSG]);
        }
    }

    public function faceMatch(Request $request)
    {
        $faceV = FaceVerification::slide($request->webcamImage);
        if (!@$faceV['success']) {
            return back()->withErrors($faceV['errors']);
        }
        return redirect()->intended('/dashboard');
    }

    public function matchFaces(Request $request)
    {
        // dd($request->all());
        $msFace = new MSFace();
        $matchFaces = $msFace->matchStreamToStream($request->face_one, $request->face_two);
        if (@$matchFaces['success'] && @$matchFaces['data']['confidence']) {
            return [
                'success' => @$matchFaces['data']['confidence'] > 0.4,
                'data' => @$matchFaces
            ];
        } else {
            return @$matchFaces['errors'] ? ['errors' => @$matchFaces['errors']] : true;
        }
    }

    // get image url from webcam
    public function getTempPath(Request $request)
    {
        if (!$request->image) {
            return response()->json(['success' => false, 'error' => 'No image found'], 400);
        }
        $fileData = Helper::optimizeImageToURL($request->image);
        if ($fileData['success']) {
            return response()->json(['success' => true, 'tempPath' => $fileData['tempPath']], 200);
        } else {
            return response()->json(['success' => false, 'error' => $fileData['error']], 400);
        }
    }

    public function facePerson()
    {
        $user = array();
        $msFace = new MSFace();
        $response = $msFace->createLPG($user);

        dd($response);
    }

    public function verifieFaceVerified(Request $request)
    {

        $emailExist     = User::whereBaseEnc('email', '=',$request->email)->first();
        if ($emailExist) {
            if ($emailExist->face_verification == "Y") {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            return response()->json(['success' => false]);
        }
    }
}
