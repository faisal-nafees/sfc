<?php

namespace App\Classes\Twilio;

use App\Classes\Twilio\Twilio;
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class TwilioVideo extends Twilio
{
    public function generateAccessToken($room_name, $ttl = 3600)
    {
        $identity = uniqid();

        // Create an Access Token
        $token = new AccessToken(
            $this->getSid(),
            $this->getApiKey(),
            $this->getApiSecret(),
            $ttl,
            $identity
        );

        // Grant access to Video
        $grant = new VideoGrant();
        $grant->setRoom($room_name);
        $token->addGrant($grant);

        // Serialize the token as a JWT
        return $token->toJWT();
    }
}
