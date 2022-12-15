<?php

namespace App\Classes\Twilio;

use App\Classes\Twilio\Twilio;
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\PlaybackGrant;

class TwilioLive extends Twilio
{
    public function createRoom($sid)
    {
        $playback_grant = $this->getTwilioClient()->media->v1->playerStreamer($sid)
            ->playbackGrant()
            ->create(["ttl" => 60]);

        return $playback_grant->sid;
    }

    public function updateRoom($sid, $update)
    {
        $player_streamer = $this->getTwilioClient()->media->v1->playerStreamer($sid)
            ->update($update);
        return $player_streamer->dateCreated->format(
            'Y-m-d H:i:s'
        );
    }

    public function endRoom($sid)
    {
        return  $this->updateRoom($sid, "ended");
    }

    public function  generatePlaybackGrants($player_streamer_sid)
    {
        $twilio = new Client(
            $this->getApiKey(),
            $this->getApiSecret(),
            $this->getSid()
        );

        // Create access token, which we will serialize and send to the client
        $token = new AccessToken(
            $this->getSid(),
            $this->getApiKey(),
            $this->getApiSecret(),
            3600
        );

        // !TODO: PlaybackGrants have a maximum TTL (time to live) of 60 seconds
        $playbackGrant  = $twilio->media->v1->playerStreamer($player_streamer_sid)
            ->playbackGrant()
            ->create(["ttl" => 60]);
        // Wrap the grant you received from the API
        // in a PlaybackGrant object
        $wrappedPlaybackGrant = new PlaybackGrant();
        $wrappedPlaybackGrant->setGrant($playbackGrant->grant);

        // Attach the PlaybackGrant to the Access Token
        $token->addGrant($wrappedPlaybackGrant);

        // render token to string
        return $token->toJWT();
    }
}
