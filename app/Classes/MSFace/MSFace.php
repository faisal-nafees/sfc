<?php

namespace App\Classes\MSFace;

use Image;
use App\Classes\Helper;
use App\Models\GeneralData;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class MSFace
{
  protected $key;
  protected $endPoint;
  protected $uriBase;
  protected $detectionModel;

  public function __construct()
  {
    $this->key              = config("msface.key");
    $this->endPoint         = config("msface.endPoint");
    $this->uriBase          = $this->endPoint . "/face/v1.0/";
    $this->detectionModel   = config("msface.detectionModel");
    $this->recognitionModel = config("msface.recognitionModel");
  }


  /* -------------------------------------------------------------------------- */
  /*                               Get Face ID                                  */
  /* -------------------------------------------------------------------------- */
  public function detectFace($face, $faceAttr = [''])
  {
    $getImageURL = $this->getImageURL($face);
    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->post($this->uriBase . "detect?detectionModel=" . $this->detectionModel . "&returnFaceAttributes=" .
      implode(',', $faceAttr)
      . "&recognitionModel=" . $this->recognitionModel . "&returnRecognitionModel=True&&returnFaceId=true&returnFaceLandmarks=false", [
      'url' => $getImageURL['url']
    ]);

    if ($response->successful() && @$response->json()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => @$response->json()];/*['error'] ?? 'Unable to detect a face!'];*/
    }
  }

  /* -------------------------------------------------------------------------- */
  /*                             Verify face to face                            */
  /* -------------------------------------------------------------------------- */
  public function matchIdToURL(String $faceId, String $personFaceURL)
  {
    try {
      // Get person face_id using url
      $personFaceData = $this->getFaceIds($personFaceURL);
      if (!($personFaceId = @$personFaceData['0']['faceId'])) {
        if (@$personFaceData['error']) {
          return $personFaceData;
        }
        return ['success' => false, 'error' =>  ['message' => $personFaceData]];
      }

      // Verify
      $response = $this->matchIdToId($faceId, $personFaceId);
      if (isset($response['isIdentical'])) {
        // Success
        if ($response->successful()) {
          return ['success' => true, 'data' => $response->json()];
        } else {
          return ['success' => false, 'error' => $response->json()['error']];
        }
      } elseif ($error = @$response['error']) {
        if ($error['code'] == 'FaceNotFound') {
          return ['success' => false, 'error' => ['message' => 'FaceNotFound'], 'url_face_id' => $personFaceId];
        } else {
          return ['success' => false, 'error' => ['message' => $response]];
        }
      }
    } catch (\Exception $ex) {
      return ['success' => false, 'error' => ['message' => $ex]];
    }
  }
  public function matchStreamToStream(String $mainFaceStream, String $personFaceStream)
  {
    // MATCH ONE FACE WITH MANY
    try {
      $mainFaceData = $this->detectFace($mainFaceStream);
      if (!@$mainFaceData['success'] || !@$mainFaceData['data']['0']['faceId']) {
        return ['success' => false, 'errors' =>  ['face_one' => @$mainFaceDat['error'] ?? 'Face not detected!']];
      }
      $mainFaceId = $mainFaceData['data']['0']['faceId'];

      $personFaceData = $this->detectFace($personFaceStream);
      if (!@$personFaceData['success'] || !@$personFaceData['data']['0']['faceId']) {
        return ['success' => false, 'errors' => ['face_two' => @$mainFaceDat['error'] ?? 'Face not detected!']];
      }
      $personFaceId = $personFaceData['data']['0']['faceId'];

      $response = Http::withHeaders([
        'Content-Type'              => 'application/json',
        'Ocp-Apim-Subscription-Key' => $this->key
      ])->post($this->uriBase . "verify", [
        "faceId1" => $mainFaceId,
        "faceId2" => $personFaceId
      ]);
      if ($response->successful() && @$response->json()) {
        return ['success' => true, 'data' => $response->json()];
      } else {
        return ['success' => false, 'errors' => [@$response->json()['error'] ?? 'Unable to detect a face!']];
      }
    } catch (\Exception $ex) {
      return ['success' => false, 'errors' =>  [@$ex->getMessage() ?? 'Something went wrong. Unable to process the request!']];
    }
  }
  public function matchIdToId(String $faceId, String $personFaceId)
  {
    // MATCH ONE FACE WITH MANY
    try {
      $response = Http::withHeaders([
        'Content-Type'              => 'application/json',
        'Ocp-Apim-Subscription-Key' => $this->key
      ])->post($this->uriBase . "verify", [
        "faceId1" => $faceId,
        "faceId2" => $personFaceId
      ]);
      if ($response->successful() && @$response->json()) {
        return ['success' => true, 'data' => $response->json()];
      } else {
        return ['success' => false, 'error' => @$response->json()['error'] ?? 'Unable to detect a face!'];
      }
    } catch (\Exception $ex) {
      return ['success' => false, 'error' => ['message' => $ex]];
    }
    return  $response->json();
  }

  public function matchURLToURL($mainFaceUrl, $personFaceUrl)
  {
    // MATCH FACES USING URL
    try {
      $mainFaceData = $this->detectFace($mainFaceUrl);

      $personFaceData = $this->detectFace($personFaceUrl);
      if (!($mainFaceId = @$mainFaceData['0']['faceId']) || !($personFaceId = @$personFaceData['0']['faceId'])) {
        return 'Face not found';
      }
      $result = $this->matchIdToId($mainFaceId, $personFaceId);
    } catch (\Exception $ex) {
      return ['success' => false, 'error' => ['message' => $ex]];
    }
    return $result;
  }

  /* -------------------------------------------------------------------------- */
  /*                            Verify face to Person                           */
  /* -------------------------------------------------------------------------- */
  public function verifyFaceToPerson(String $faceID, String $personId, ?String $largePersonGroupId)
  {

    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->post(
      $this->uriBase . "verify",
      [
        "faceId" => $faceID,
        "personId" => $personId,
        "largePersonGroupId" => $largePersonGroupId
      ]
    );
    if ($response->successful()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }

  /* -------------------------------------------------------------------------- */
  /*                           Large Person Group(LPG)                          */
  /* -------------------------------------------------------------------------- */
  public function createLPG($userData = [])
  {
    $newLPGData = [
      'name' => 'XISchool' . now()->format('d-m-Y'),
      'user_data' => $userData,
      "recognitionModel" => $this->recognitionModel
    ];
    $newLPG_id = rand(5, 5) . time();
    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->put(
      $this->uriBase . "largepersongroups/" . $newLPG_id,
      $newLPGData
    );
    if ($response->successful()) {
      $newLPGData['id'] = $newLPG_id;
      return ['success' => true, 'data' => $newLPGData];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }

  public function getLPG(Int $lpgId)
  {
    // DETECT FACE AND FACE ID
    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->get($this->uriBase . "largepersongroups/" . $lpgId . "?returnRecognitionModel=True");
    if ($response->successful()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }

  public function listLPGs()
  {
    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->get($this->uriBase . "largepersongroups?returnRecognitionModel=True");
    if ($response->successful()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }

  public function trainLPG(Int $lpgId)
  {
    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->post($this->uriBase . "largepersongroups/" . $lpgId . "/train");
    if ($response->successful()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }

  public function updateLPG(Int $lpgId, array $lpgArray)
  {
    if (!($gd = GeneralData::find(1))) {
      return;
    }
    foreach (json_decode($gd->large_person_group) as $key => $lpg) {
      if ($lpg['id'] == $lpgId) {
        break;
      } else {
        continue;
      }
    }
    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->patch(
      $this->uriBase . "largepersongroups/" . $lpg['id'],
      [
        'name'     => $lpg['name'],
        'userData' => $lpg['userData']
      ]
    );
    if ($response->successful()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }

  public function getLPGTrainingStatus(Int $lpgId)
  {
    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->get($this->uriBase . "largepersongroups/" . $lpgId . "/training");
    if ($response->successful()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }

  public function deleteLPG(Int $lpgId)
  {
    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->delete($this->uriBase . "largepersongroups/" . $lpgId);
    if ($response->successful()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }


  /* -------------------------------------------------------------------------- */
  /*                       Large Person Group Person(LPGP)                      */
  /* -------------------------------------------------------------------------- */
  public function addFaceToLPGP(Int $lpgId, String $personUUID, $face)
  {
    try {
      $getImageURL = $this->getImageURL($face);
      if (!@$getImageURL['success']) {
        return ['success' => false, 'error' => @$getImageURL['error'] && 'Image not found'];
      }
      $response   = Http::withHeaders([
        'Content-Type'              => 'application/json',
        'Ocp-Apim-Subscription-Key' => $this->key
      ])->post(
        $this->uriBase . "largepersongroups/" . $lpgId . "/persons/" . $personUUID . "/persistedfaces/?detectionModel=" . $this->detectionModel,
        [
          'url' => $getImageURL['url']
        ]
      );

      if ($response->successful()) {
        return ['success' => true, 'data' => $response->json()];
      } else {
        return ['success' => false, 'error' => $response->json()['error']];
      }
    } catch (\Exception $e) {
      return ['success' => false, 'error' => $e->getMessage()];
    }
  }

  // public function addLPGPFaceFromStream(Int $lpgId, String $personUUID,  String $image)
  // {
  //     $imgURL    = Helper::imgToURL($image);
  //     $response   = Http::withHeaders([
  //         'Content-Type'              => 'application/json',
  //         'Ocp-Apim-Subscription-Key' => $this->key
  //     ])->post(
  //         $this->uriBase . "largepersongroups/" . $lpgId . "/persons/" . $personUUID . "/persistedfaces",
  //         [
  //             "url" => $imgURL
  //         ]
  //     );
  //     if ($response->successful()) {
  //         dd("success");
  //         return ['success' => true, 'data' => $response->json()];
  //     } else {
  //         dd($response->json()['error']);
  //         return ['success' => false, 'error' => $response->json()['error']];
  //     }
  // }

  public function createLPGP(Int $lpgId, $userId = "", String $userName)
  {
    $response   = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->post(
      $this->uriBase . "largepersongroups/" . $lpgId . "/persons",
      [
        "name"     => $userName,
        "userData" => ($userId ? $userId : "")
      ]
    );
    if ($response->successful()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }

  public function getLPGP(Int $lpgpId, String $userUUID)
  {
    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->get($this->uriBase . "largepersongroups/" . $lpgpId . "/persons/" . $userUUID);
    if ($response->successful()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }

  public function getLPGPFace(Int $lpgpId, String $userUUID, String $persistedFaceId)
  {
    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->get($this->uriBase . "largepersongroups/" . $lpgpId . "/persons/" . $userUUID . "/persistedfaces/" . $persistedFaceId);
    if ($response->successful()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }

  public function listLPGPs(Int $lpgpId)
  {
    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->get($this->uriBase . "largepersongroups/" . $lpgpId . "/persons");
    if ($response->successful()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }

  public function updateLPGP(Int $lpgpId, String $userUUID, array $userData)
  {
    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->patch(
      $this->uriBase . "largepersongroups/" . $lpgpId . "/persons/" . $userUUID,
      [
        'userData' => $userData
      ]
    );
    if ($response->successful()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }


  public function deleteLPGP(Int $lpgpId, String $userUUID)
  {
    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->delete($this->uriBase . "largepersongroups/" . $lpgpId . "/persons/" . $userUUID . "/persistedfaces/");
    if ($response->successful()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }

  public function deleteFaceFromLPGP(Int $lpgpId, String $userUUID, String $persistedFaceId)
  {
    $response = Http::withHeaders([
      'Content-Type'              => 'application/json',
      'Ocp-Apim-Subscription-Key' => $this->key
    ])->delete($this->uriBase . "largepersongroups/" . $lpgpId . "/persons/" . $userUUID . "/persistedfaces/" . $persistedFaceId);
    if ($response->successful()) {
      return ['success' => true, 'data' => $response->json()];
    } else {
      return ['success' => false, 'error' => $response->json()['error']];
    }
  }

  // FACE LIST
  public function getFaceLists(String $imageUrl)
  {
    // DETECT FACE AND FACE ID
    try {
      $response = Http::withHeaders([
        'Content-Type'              => 'application/json',
        'Ocp-Apim-Subscription-Key' => $this->key
      ])->get($this->uriBase . "largefacelists?returnRecognitionModel=True");
    } catch (\Exception $ex) {
      print_r($ex);
      die;
    }
    return $response->json();
  }

  public function addToFaceList(String $imageUrl, $largeFaceListId = "userUUID_card_face_data")
  {
    // DETECT FACE AND FACE ID
    try {
      $response = Http::withHeaders([
        'Content-Type'              => 'application/json',
        'Ocp-Apim-Subscription-Key' => $this->key
      ])->post($this->uriBase . "largefacelists/" . $largeFaceListId  . "/persistedfaces", [
        'url' => $imageUrl,
      ]);
    } catch (\Exception $ex) {
      print_r($ex);
      die;
    }
    return $response->json();
  }

  public function deleteFromFaceList(String $imageUrl, String $persistedFaceId, $largeFaceListId = "userUUID_card_face_data")
  {
    // DETECT FACE AND FACE ID
    try {
      $response = Http::withHeaders([
        'Content-Type'              => 'application/json',
        'Ocp-Apim-Subscription-Key' => $this->key
      ])->delete($this->uriBase . "largefacelists/" . $largeFaceListId . "/persistedfaces/" . $persistedFaceId, [
        'url' => $imageUrl,
      ]);
    } catch (\Exception $ex) {
      print_r($ex);
      die;
    }
    return $response->json();
  }

  // Helper Methods
  public function getImageURL($file)
  {
    try {
      if (!Helper::is_valid_url($file) || Image::make($file)->exif()['FileSize'] > 6000000) {
        $optimizeImageToURL =  Helper::optimizeImageToURL($file);
        if (@$optimizeImageToURL['success']) {
          $fileUrl = $optimizeImageToURL['url'];
          $optimizedImagePath = $optimizeImageToURL['tempPath'];
        } else {
          return ['error' => 'Image is not valid'];
        }
      } else {
        $fileUrl = $file;
        $optimizedImagePath = null;
      }
      return ['success' => true, 'url' => $fileUrl, 'path' => $optimizedImagePath];
    } catch (\Exception $e) {
      return ['error' => 'Something went wrong!!'];
    }
  }
}
