<?php

namespace App\Classes;

use App\Models\GeneralData;
use App\Classes\MSFace\MSFace;
use Illuminate\Support\Facades\Session;

class FaceVerification
{
    public static function slide($face)
    {
        // Get Large Person Group Data
        if (!($gd = GeneralData::find(1))) {
            return  ['errors' => ['Could verify face because of some technical issue']];
        }
        $lpgData =  json_decode($gd->large_person_group);
        $lpg = $lpgData[count($lpgData) - 1];

        // INIT FACE VERIFICATION
        $msFace          = new MSFace();

        // DETECT FACES FROM WEBCAM AND GET FACE ID
        $detectFace = $msFace->detectFace($face);
        $webcam_faceId     = @$detectFace['data'][0]['faceId'];
        if (!@$detectFace['success'] || !@$webcam_faceId) {
            return  ['errors' => [$detectFace['error']]];
        }

        // GET FACE VERIFICATION
        $verifyFaceToPerson = $msFace->verifyFaceToPerson($webcam_faceId, auth()->user()->uuid, $lpg->largePersonGroupId);
        if (!@$verifyFaceToPerson['success']) {
            return  ['errors' => [$verifyFaceToPerson['error']]];
        }
        if (!@$verifyFaceToPerson['data']['isIdentical']) {
            return  ['errors' => ['webcam_image' => "Your face didn't match!"]];
        }

        // Save Face verification log  to session
        $verified_slide_id    =  Session::get('face_verify_slide')['slide_id'];
        $verified_slide_index =  Session::get('face_verify_slide')['slideIndex'];

        $face_verified_slides = Session::has('face_verified_slides') ? Session::get('face_verified_slides') : [];
        if (@$face_verified_slides[$verified_slide_id]) {
            $face_verified_slides[$verified_slide_id] =  $verified_slide_index;
        } else {
            $face_verified_slides[$verified_slide_id] = $verified_slide_index;
        }
        Session::put('face_verified_slides', $face_verified_slides);
        Session::forget('face_verify_slide');
        return ['success' => true, 'message' => 'Face Verified Successfully!'];
    }

    public static function getLatestLPG()
    {
        // Int Microsoft Face API
        $msFace          = new MSFace();

        // Verify if large person group data exist, else create one
        if (!($gd = GeneralData::find(1))) {
            $gd = new GeneralData();
            // !TODO: testing
            $gd->id = 1;
            $gd->save();
        }
        if (empty(@$gd->large_person_group)) {
            $listLPGs = $msFace->listLPGs();
            if (
                $listLPGs['success']
                && count($listLPGs['data'])
            ) {
                $gd->large_person_group      = json_encode($listLPGs['data']);
            } else {
                $createLPG = $msFace->createLPG();
                if ($createLPG['success']) {
                    $gd->large_person_group = json_encode($createLPG['data']);
                }
            }
            $gd->save();
        }
        $lpgData = json_decode($gd->large_person_group);
        // Last/Latest LPG

        $lpg = $lpgData[(count($lpgData) - 1)];
        return ['success' => true, 'lpg' => $lpg];
    }
}
