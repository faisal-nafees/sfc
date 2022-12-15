<?php
namespace App\Events;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ClientMessageEvent implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $message;
  public $channel;

  public function __construct($message,$channel)
  {
      $this->message = $message;
      $this->channel = $channel;
  }

  public function broadcastOn()
  {
    $channelName = 'chat-channel'.$this->channel;
      return [$channelName];
  }

  public function broadcastAs()
  {
      return 'get-message';
  }
}