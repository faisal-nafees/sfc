<?php

namespace App\Classes\Twilio;

use Twilio\Rest\Client;

class Twilio
{
    private $sid;
    private $token;
    private $twilioClient;

    public function __construct()
    {
        $this->sid = config("twilio.account_sid");
        $this->token = config("twilio.auth_token");
        $this->apiKey = config("twilio.api_key_sid");
        $this->apiSecret = config("twilio.api_key_secret");
    }

    public function getSid()
    {
        return $this->sid;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getTwilioClient()
    {
        return  $this->twilioClient = new Client($this->sid, $this->token);
    }
}
