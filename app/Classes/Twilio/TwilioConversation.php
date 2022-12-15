<?php

namespace App\Classes\Twilio;

use App\Classes\Twilio\Twilio;
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\PlaybackGrant;

class TwilioConversation extends Twilio
{
    public function createConversation()
    {
		
		$sid = 'AC2b919356d0b7d0592753543119a1c976';
		$token = '80d81197909e4ce85d5aacdb6a245e41';
		$twilio = new Client($sid, $token);
        $conversations = $twilio->conversations->v1->conversations->create([
                     "friendlyName" => "My First Conversation"
                 ]
        );
		
     //  echo $conversations->sid; die;
      //   $this->sendMessage($conversations->sid);   
      
    }
	
	
	 public function fetchConversation($sid)
		 
    {
		$sid = 'AC2b919356d0b7d0592753543119a1c976';
		$token = '80d81197909e4ce85d5aacdb6a245e41';
		$twilio = new Client($sid, $token);
       	$fetchconvers = $twilio->conversations->v1->conversations($sid)->fetch();

    }
	

	
	public function addParticipants($cid)
	{
	
		$sid = 'AC2b919356d0b7d0592753543119a1c976';
		$token = '80d81197909e4ce85d5aacdb6a245e41';
		$twilio = new Client($sid, $token);
		$participant = $twilio->conversations->v1->conversations($cid)
                                         ->participants
                                         ->create([
                                                      "messagingBindingAddress" => "+85581510162",
                                                      "messagingBindingProxyAddress" => "+16066033474"
                                                  ]
                                         );
		
		
       
	
     
	}
	
	public function sendMessage()
	{
	     $cid = 'CHf25dc33236874440beebb7c64a872ff8';
		$sid = 'AC2b919356d0b7d0592753543119a1c976';
		$token = '80d81197909e4ce85d5aacdb6a245e41';
		$twilio = new Client($sid, $token);
		$message = $twilio->conversations->v1->conversations($cid)
                                     ->messages
                                     ->create([
                                                  "author" => "smee",
                                                  "body" => "Ahoy there!"
                                              ]
                                     );
		
       
		return $message;
     
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
