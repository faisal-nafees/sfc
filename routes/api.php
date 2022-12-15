<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnalyticController;
use App\Http\Controllers\API\TwilioController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\AccessTokenController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/* -------------------------------------------------------------------------- */
/*                                 Twilio Live                                */
/* -------------------------------------------------------------------------- */
Route::get('access_token', [TwilioController::class, 'getAccessToken']);

// Playback Grants
Route::get('generate-playback-grants', [TwilioController::class, 'generatePlaybackGrants']);

// PlayerStreamer
Route::get('create-player-streamer', [TwilioController::class, 'createPlayerStreamer']);
Route::get('get-all-player-streamers', [TwilioController::class, 'getAllPlayerStreamers']);
Route::get('get-all-started-player-streamers', [TwilioController::class, 'getAllStartedPlayerStreamers']);
Route::get('end-player-streamer/{sid}', [TwilioController::class, 'endPlayerStreamer']);
Route::get('end-all-player-streamers', [TwilioController::class, 'endAllPlayerStreamers']);

// Media Processor
Route::get('create-media-processors', [TwilioController::class, 'createMediaProcessor']);
Route::get('get-all-media-processors', [TwilioController::class, 'getAllMediaProcessors']);
Route::get('get-all-started-media-processors', [TwilioController::class, 'getAllStartedMediaProcessors']);
Route::get('end-media-processor/{sid}', [TwilioController::class, 'endMediaProcessor']);
Route::get('end-all-media-processor', [TwilioController::class, 'endAllMediaProcessors']);


// Twilio Conversation
Route::post('create-conversation', [TwilioController::class, 'createConversation']);
Route::post('fetch-conversation', [TwilioController::class, 'fetchConversation']);
Route::post('add-participants', [TwilioController::class, 'addParticipants']);
Route::post('send-message', [TwilioController::class, 'sendMessage']);
Route::post('get-all-messages', [TwilioController::class, 'getAllMessages']);
Route::post('end-conversation', [TwilioController::class, 'endRoom']);

Route::middleware('auth')->post('/send-message-user',[ChatController::class,'sendMessageUser']);
Route::middleware('auth')->post('/get-all-messages-user',[ChatController::class,'getAllMessagesUser']);
Route::middleware('auth')->post('/create-conversation',[ChatController::class,'createConversation']);

Route::post('/send-message-admin',[ChatController::class,'sendMessageAdmin']);
Route::post('/get-all-messages-admin',[ChatController::class,'getAllMessagesAdmin']);


