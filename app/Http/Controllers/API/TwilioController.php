<?php

namespace App\Http\Controllers\API;

use Twilio\Jwt\AccessToken;
use Illuminate\Http\Request;
use Twilio\Jwt\Grants\VideoGrant;
use App\Classes\Twilio\TwilioLive;
use App\Classes\Twilio\TwilioMediaProcessor;
use App\Classes\Twilio\TwilioVideo;
use App\Http\Controllers\Controller;
use App\Classes\Twilio\TwilioPlayerStreamer;
use Twilio\Rest\Client;
use Twilio\Jwt\Grants\PlaybackGrant;
use App\Classes\Twilio\Twilio;
use Session;

class TwilioController extends Controller
{


    public function getAccessToken()
    {
        try {
            $twilioVideo = new TwilioVideo();
            $accessToken = $twilioVideo->generateAccessToken();
            return response()->json(['status' => 'error', 'data' => ['access_token' => $accessToken]]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'data' => ['message' => $e->getMessage()]]);
        }
    }

    /* -------------------------------------------------------------------------- */
    /*                               Player Streamer                              */
    /* -------------------------------------------------------------------------- */

    public function createPlayerStreamer()
    {
        try {
            $twilioLive = new TwilioLive();
            $token = $twilioLive->createPlayerStreamer();
            return response()->json(['status' => 'success', 'data' => ['player_streamer_sid' => $token]]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 'error', 'data' => ['message' => $e->getMessage()]]);
        }
    }

    public function generatePlaybackGrants(Request $request)
    {
        try {
            $data = [];
            $twilioPS = new TwilioPlayerStreamer();
            $twilioLiveMP = new TwilioMediaProcessor();
            $twilioLive = new TwilioLive();
            $data['player_streamer_sid'] = $twilioPS->createPlayerStreamer();
            $data['media_processors_sid'] = $twilioLiveMP->createMediaProcessor(
                'cool_room',
                [$data['player_streamer_sid']]
            );
            // TODO: Clean Up
            $data['pg_access_token'] = $twilioLive->generatePlaybackGrants($data['player_streamer_sid']);
            // $token = $twilioLive->generatePlaybackGrants('VJb98de32aad79dc69b5f72b92f6f0f10b');
            // $token = $twilioLive->generatePlaybackGrants($request->player_streamer_sid);
            // return $token;
            return response()->json(['status' => 'success', 'data' =>  $data]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 'error', 'data' => ['message' => $e->getMessage()]]);
        }
    }

    public function getAllPlayerStreamers()
    {
        try {
            $twilioPS = new TwilioPlayerStreamer();
            $token = $twilioPS->readAllPlayerStreamers();
            dd($token);
            return response()->json(['status' => 'success', 'data' => ['player_streamers' => $token]]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 'error', 'data' => ['message' => $e->getMessage()]]);
        }
    }

    public function getAllStartedPlayerStreamers()
    {
        try {
            $twilioPS = new TwilioPlayerStreamer();
            $token = $twilioPS->readAllStartedPlayerStreamers();
            dd($token);
            return response()->json(['status' => 'success', 'data' => ['player_streamers' => $token]]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 'error', 'data' => ['message' => $e->getMessage()]]);
        }
    }


    public function endPlayerStreamer(Request $request)
    {
        try {
            $twilioPS = new TwilioPlayerStreamer();
            $token = $twilioPS->endPlayerStreamer($request->player_streamer_sid);
            return response()->json(['status' => 'success', 'data' => ['token' => $token]]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 'error', 'data' => ['message' => $e->getMessage()]]);
        }
    }

    public function endAllPlayerStreamers()
    {
        try {
            $twilioPS = new TwilioPlayerStreamer();
            $player_streamers = $twilioPS->readAllPlayerStreamers();
            $ps_tokens = [];
            if ($player_streamers && count($player_streamers) > 0) {
                foreach ($player_streamers as $player_streamer) {
                    $twilioPS->endPlayerStreamer($player_streamer->sid);
                }
                dd($ps_tokens);
                return response()->json(['status' => 'success', 'data' => ['ps_tokens' => $ps_tokens]]);
            } else {
                return response()->json(['status' => 'error', 'data' => ['message' => 'No Player Streamers Found']]);
            }
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 'error', 'data' => ['message' => $e->getMessage()]]);
        }
    }

    /* -------------------------------------------------------------------------- */
    /*                               Media Processor                              */
    /* -------------------------------------------------------------------------- */

    public function createMediaProcessor(Request $request)
    {
        try {
            $twilioMP = new TwilioMediaProcessor();
            $token = $twilioMP->createMediaProcessor($request->room_sid, $request->player_streamers_sid);
            return response()->json(['status' => 'success', 'data' => ['media_processors_sid' => $token]]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 'error', 'data' => ['message' => $e->getMessage()]]);
        }
    }

    public function getAllMediaProcessors()
    {
        try {
            $twilioMP = new TwilioMediaProcessor();
            $media_processors = $twilioMP->retriveAllMediaProcessors();
            return response()->json(['status' => 'success', 'data' => ['media_processors' => $media_processors]]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 'error', 'data' => ['message' => $e->getMessage()]]);
        }
    }

    public function getAllStartedMediaProcessors()
    {
        try {
            $twilioMP = new TwilioMediaProcessor();
            $media_processores = $twilioMP->retriveAllStartedMediaProcessors();
            return response()->json(['status' => 'success', 'data' => ['media_processores' => $media_processores]]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 'error', 'data' => ['message' => $e->getMessage()]]);
        }
    }


    public function endMediaProcessor($sid)
    {
        try {
            $twilioMP = new TwilioMediaProcessor();
            $media_processors_sid = $twilioMP->endMediaProcessor($sid);
            return response()->json(['status' => 'success', 'data' => ['media_processors_sid' => $media_processors_sid]]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 'error', 'data' => ['message' => $e->getMessage()]]);
        }
    }

    public function endAllMediaProcessors()
    {
        try {
            $twilioMP = new TwilioMediaProcessor();
            $media_processors = $twilioMP->retriveAllStartedMediaProcessors();
            if ($media_processors && count($media_processors) > 0) {
                $mp_tokens = [];
                foreach ($media_processors as $media_processor) {
                    array_push($mp_tokens, $twilioMP->endMediaProcessor($media_processor->sid));
                }
                dd($mp_tokens);
                return response()->json(['status' => 'success', 'data' => ['mp_tokens' => $mp_tokens]]);
            } else {
                return response()->json(['status' => 'success', 'data' => ['message' => 'No Media Processors Found']]);
            }
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 'error', 'data' => ['message' => $e->getMessage()]]);
        }
    }
	
	
	 public function createConversation(Request $request)
    {
		
		$sid = 'AC2b919356d0b7d0592753543119a1c976';
		$token = '80d81197909e4ce85d5aacdb6a245e41';
		$twilio = new Client($sid, $token);
		$coverID = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
        $conversations = $twilio->conversations->v1->conversations->create([
                    $coverID => "My First Conversation"
                 ]
        );
		 session(['sid' => $conversations->sid]);
		 session(['username' => $request->username]);
		 session(['userphone' => $request->phone]);
		 
		  $twilio->conversations->v1->conversations($conversations->sid)
			  ->participants
			  ->create(
			  [
				  // "messagingBindingAddress" => "+85581510162",
				  "messagingBindingAddress" => "+919389534027",
				  "messagingBindingProxyAddress" => "+16066033474"
			  ]
			);
		 $twilio->conversations->v1->conversations($conversations->sid)
                                         ->participants
                                         ->create(
										  [
											  // "messagingBindingAddress" => "+85581510162",
											  "messagingBindingAddress" => $request->phone,
											  "messagingBindingProxyAddress" => "+16066033474"
										  ]
                                         );
		 $message = $twilio->conversations->v1->conversations($conversations->sid)
                                     ->messages
                                     ->create([
                                                  "author" => $request->username,
                                                  "body" => $request->message
                                              ]
                                     );
		
       		$messages = $twilio->conversations->v1->conversations(session('sid'))
			->messages
			->read([], 20);

		$msgs = [];
		foreach ($messages as $record) {
			array_push($msgs,['message'=>$record->body,'author' => $record->author,'index' => $record->index]);
		}

		 return response()->json(['message' => "Conversation Created Successfully","success" => true,"messages" => $msgs]);
     //  echo $conversations->sid; die;
      //   $this->sendMessage($conversations->sid);   
      
    }
	
	
	 public function fetchConversation(Request $request)
		 
    {
		$sid = 'AC2b919356d0b7d0592753543119a1c976';
		$token = '80d81197909e4ce85d5aacdb6a245e41';
		$twilio = new Client($sid, $token);
       	$fetchconvers = $twilio->conversations->v1->conversations(session('sid'))->fetch();
		 return response()->json(['data' => $fetchconvers->sid]);

    }
	

	
	public function addParticipants(Request $request)
	{
	
		$sid = 'AC2b919356d0b7d0592753543119a1c976';
		$token = '80d81197909e4ce85d5aacdb6a245e41';
		$twilio = new Client($sid, $token);
		$participant = $twilio->conversations->v1->conversations($request->sid)
                                         ->participants
                                         ->create([
                                                     // "messagingBindingAddress" => "+85581510162",
                                                      "messagingBindingAddress" => $request->phone,
                                                      "messagingBindingProxyAddress" => "+16066033474"
                                                  ]
                                         );
		 return response()->json(['psid' => 	$participant->sid]);
     
	}
	
	public function sendMessage(Request $request)
	{
	    // $cid = 'CHf25dc33236874440beebb7c64a872ff8';
		$sid = 'AC2b919356d0b7d0592753543119a1c976';
		$token = '80d81197909e4ce85d5aacdb6a245e41';
		$twilio = new Client($sid, $token);
		//$rsid = ;
		$message = $twilio->conversations->v1->conversations(session('sid'))
                                     ->messages
                                     ->create([
                                                  "author" => session('username'),
                                                  "body" => $request->body
                                              ]
                                     );
		
       		$messages = $twilio->conversations->v1->conversations(session('sid'))
			->messages
			->read([], 20);

		$msgs = [];
		foreach ($messages as $record) {
			array_push($msgs,['message'=>$record->body,'author' => $record->author,'index' => $record->index]);
		}
		 return response()->json(['data' =>$msgs,'success' => true]);
     
	}
	


    public function updateRoom($sid, $update)
    {
        $player_streamer = $this->getTwilioClient()->media->v1->playerStreamer($sid)
            ->update($update);
        return $player_streamer->dateCreated->format(
            'Y-m-d H:i:s'
        );
    }

    public function endRoom(Request $request)
    {
		$sid = 'AC2b919356d0b7d0592753543119a1c976';
		$token = '80d81197909e4ce85d5aacdb6a245e41';
		$twilio = new Client($sid, $token);
	
		if($request->has('sid')){
		$twilio->conversations->v1->conversations($request->sid)
                          ->delete();
			
			Session::forget('sid');
			return   response()->json(['success' => true]);
		}else{
			
		if(session('sid')){
		
		$twilio->conversations->v1->conversations(session('sid'))
                          ->delete();
			
			Session::forget('sid');
			return   response()->json(['success' => true]);
		}
		}
        return   response()->json(['success' => true,'message' =>'Room not Found']);
    }
	
	
	public function getAllMessages(Request $request){
	
		$sid = 'AC2b919356d0b7d0592753543119a1c976';
		$token = '80d81197909e4ce85d5aacdb6a245e41';
		$twilio = new Client($sid, $token);
		//session(['sid2' => '122']);
		

		$messages = $twilio->conversations->v1->conversations(session('sid'))
			->messages
			->read([], 20);

		$msgs = [];
		foreach ($messages as $record) {
			array_push($msgs,['message'=>$record->body,'author' => $record->author,'index' => $record->index]);
		}
		 return response()->json(['msgs' => $msgs,'data' => $messages]);
	}
	
	public function sendSMS($phone,$body){
	$sid = 'AC2b919356d0b7d0592753543119a1c976';
		$token = '80d81197909e4ce85d5aacdb6a245e41';
		$twilio = new Client($sid, $token);
		$message = $twilio->messages
                  ->create($phone, // to
                           ["from" => "+16066033474", "body" =>$body]
                  );
		return $message;
	
	}
}
