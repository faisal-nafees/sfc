<?php

namespace App\Classes\MSFace;

use App\Classes\MSFace\MSFace;
use Illuminate\Support\Facades\Http;
use App\Models\MSFace\LargePersonGroup;

class LPG extends MSFace
{
    // Large Person Group(LPG)
    public function createLPG()
    {
        $msLPG = new LargePersonGroup();
        $msLPG->name             = "large-person-group";
        $msLPG->recognitionModel = "recognition_01";
        $msLPG->save();

        $response = Http::withHeaders([
            'Content-Type'              => 'application/json',
            'Ocp-Apim-Subscription-Key' => $this->key
        ])->put($this->uriBase . "largepersongroups/" . $msLPG->id, [
            'largePersonGroupId' => $msLPG->name,
            'recognitionModel'   => $msLPG->recognitionModel,
            'userData'           => $msLPG->userData,
        ]);
        return $response;
    }

    public function getLPG(Int $lpg_id)
    {
        // DETECT FACE AND FACE ID
        $response = Http::withHeaders([
            'Content-Type'              => 'application/json',
            'Ocp-Apim-Subscription-Key' => $this->key
        ])->GET($this->uriBase . "largepersongroups/" . $lpg_id . "?returnRecognitionModel=True");
        return $response;
    }

    public function listLPG()
    {
        $response = Http::withHeaders([
            'Content-Type'              => 'application/json',
            'Ocp-Apim-Subscription-Key' => $this->key
        ])->get($this->uriBase . "largepersongroups?tart=sample_group&top=2&returnRecognitionModel=True");
        return $response;
    }

    public function getLPGTrainingStatus(Int $lpg_id)
    {
        $response = Http::withHeaders([
            'Content-Type'              => 'application/json',
            'Ocp-Apim-Subscription-Key' => $this->key
        ])->get($this->uriBase . "largepersongroups/" . $lpg_id);
        return $response;
    }

    public function deleteLPG(Int $lpg_id)
    {
        $response = Http::withHeaders([
            'Content-Type'              => 'application/json',
            'Ocp-Apim-Subscription-Key' => $this->key
        ])->delete($this->uriBase . "largepersongroups/" . $lpg_id);
        return $response;
    }
}
