<?php

namespace App\Classes\Twilio;

use App\Classes\Twilio\Twilio;
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class TwilioPlayerStreamer extends Twilio
{

    public function createPlayerStreamer()
    {
        $player_streamer = $this->getTwilioClient()->media->v1->playerStreamer
            ->create();

        return $player_streamer->sid;
    }

    public function retrivePlayerStreamer()
    {
        $player_streamer = $this->getTwilioClient()->media->v1->playerStreamer("VJXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
            ->fetch();

        return $player_streamer->dateCreated->format(
            'Y-m-d H:i:s'
        );
    }

    public function readAllPlayerStreamers(): array
    {
        $player_streamers = $this->getTwilioClient()->media->v1->playerStreamer
            ->read([], 20);

        return $player_streamers;
    }

    public function readAllStartedPlayerStreamers(): array
    {
        $player_streamers = $this->getTwilioClient()->media->v1->playerStreamer
            ->read(["status" => "started"], 20);

        return $player_streamers;
    }

    public function updatePlayerStreamer($sid, $update)
    {
        $player_streamer = $this->getTwilioClient()->media->v1->playerStreamer($sid)
            ->update($update);
        return $player_streamer;
        // return $player_streamer->dateCreated->format(
        //     'Y-m-d H:i:s'
        // );
    }

    public function endPlayerStreamer($sid)
    {
        return $this->updatePlayerStreamer($sid, 'ended');
    }
}
