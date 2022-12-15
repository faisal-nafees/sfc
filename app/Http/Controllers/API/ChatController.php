<?php

namespace App\Http\Controllers\API;

use App\Events\ClientMessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Twilio\Rest\Client;

class ChatController extends Controller
{
    public function sendMessageUser(Request $request)
    {
        $conv_id = $request->session()->get('conv_id', '');

        $conversation = Conversation::where('uuid', $conv_id)->where('status', 'Y')->get()->first();
        // GET USER ID from Session
        if ($conversation) {

            $user_id = $request->user()->id;
            $message = new Message();
            $message->message = $request->message;
            $message->user_id = $user_id;
            $message->conversation_id = $conversation->id;
            $message->save();

            event(new ClientMessageEvent($request->message, $conv_id));
            return response()->json(['data' => $request->all()]);
        }
        return response()->json(['data' => 'N']);
    }
    public function sendMessageAdmin(Request $request)
    {
        $conv_id = $request->conversation_id;

        $conversation = Conversation::where('uuid', $conv_id)->where('status', 'Y')->get()->first();
        // GET USER ID from Session
        if ($conversation) {

            $user_id = 2;
            $message = new Message();
            $message->message = $request->message;
            $message->user_id = $request->user_id;
            $message->conversation_id = $conversation->id;
            $message->save();

            event(new ClientMessageEvent($request->message, $conv_id));
            return response()->json(['data' => $request->all()]);
        }
        return response()->json(['data' => 'N']);
    }

    public function recieveMessage(Request $request)
    {
        // event(new MyEvent($request->all()));
        return response()->json(['data' => $request->all()]);
    }

    public function createConversation(Request $request)
    {
        $uuid = (string) Str::uuid();
		
        // GET ADMIN ID
        $admin_id = 101;
        // GET USER ID FROM AUTH
        $user_id = $request->user()->id;

        $conversation = new Conversation();
        $conversation->uuid = $uuid;
        $conversation->user_one = $user_id;
        $conversation->user_two = $admin_id;
        $conversation->save();

        $message = new Message();
        $message->message = $request->message;
        $message->user_id = $user_id;
        $message->conversation_id = $conversation->id;
        $message->save();

        event(new ClientMessageEvent($message, $uuid));

        event(new ClientMessageEvent($message, $uuid));

        $request->session()->put('conv_id', $uuid);

        $url = url('/conversation?conv_id=' . $uuid);

        // Send SMS
		// $this->sendSMS('+13049865496',$url);1-304-415-2661
		 $this->sendSMS('+13044152661',$url); // 1-304-415-2661
        $data = Conversation::with(['userone', 'usertwo', 'messages.sender'])->find($conversation->id);
        return response()->json(['url' => $url, 'data' => $data]);
    }

    public function getAllMessagesUser(Request $request)
    {
        $conv_id = $request->session()->get('conv_id', '');

        // Check IsConversation Active
        $conversation = Conversation::with(['userone', 'usertwo', 'messages.sender'])->where('uuid', $conv_id)->where('status', 'Y')->get()->first();
        if ($conversation) {
            return response()->json(['data' => $conversation]);
        }
        return response()->json(['data' => 'N']);
    }

    public function getAllMessagesAdmin(Request $request)
    {
        $conv_id = $request->conv_id;
        $conversation = Conversation::with(['userone', 'usertwo', 'messages.sender'])->where('uuid', $conv_id)->where('status', 'Y')->get()->first();
        if ($conversation) {
            return response()->json(['data' => $conversation]);
        }
        return response()->json(['data' => 'N']);
    }
	
	public function sendSMS($phone,$body){
	$sid = 'AC2b919356d0b7d0592753543119a1c976';
		$token = '80d81197909e4ce85d5aacdb6a245e41';
		$twilio = new Client($sid, $token);
		$message = $twilio->messages
                  ->create($phone, // to
                           ["from" => "+16066033474", "body" =>$body]
                  );
		logger($message);
	
	}
}
