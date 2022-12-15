<?php

namespace App\Classes\Twilio;

use App\Classes\Twilio\Twilio;

class TwilioMediaProcessor extends Twilio
{

    public function createMediaProcessor($room_name, $player_streamers_sid)
    {
        $media_processor = $this->getTwilioClient()->media->v1->mediaProcessor
            ->create(
                "video-composer-v2", // extension
                json_encode([
                    "identity" => "video-composer-v2",
                    "room" => [
                        "name" => $room_name
                    ],
                    "outputs" => $player_streamers_sid,
                    "audioBitrate" => 128,
                    "resolution" => "1280x720",
                    "video" => true
                ]) // extensionContext
            );

        return $media_processor->sid;
    }

    public function retriveAllMediaProcessors(): array
    {
        $mediaProcessors  = $this->getTwilioClient()->media->v1->mediaProcessor
            ->read([], 20);
        return $mediaProcessors;
    }

    public function retriveAllStartedMediaProcessors(): array
    {
        $mediaProcessors  = $this->getTwilioClient()->media->v1->mediaProcessor
            ->read(["status" => "started"], 20);
        return $mediaProcessors;
    }

    public function updateMediaProcessor($sid, $update)
    {
        $player_streamer = $this->getTwilioClient()->media->v1->playerStreamer($sid)
            ->update($update);
        return $player_streamer;
        // return $player_streamer->dateCreated->format(
        //     'Y-m-d H:i:s'
        // );
    }

    public function endMediaProcessor($sid)
    {
        return   $this->updateMediaProcessor($sid, "ended");
    }
}
