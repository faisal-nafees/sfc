<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conversation;
use App\Models\User;
use Carbon\Carbon;

class Message extends Model
{
    use HasFactory;

    public function getCreatedAtAttribute($created_at)
    {
        return Carbon::createFromTimeStamp(strtotime($created_at))->diffForHumans();
        // $date = $this->created_at;
        // $now = $date->now();

        // return $date->diffForHumans($now, true);
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sender()
    {
        return $this->user();
    }
}
