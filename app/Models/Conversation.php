<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;
use App\Models\User;

class Conversation extends Model
{
    use HasFactory;

    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id')
            ->with('sender');
    }

    public function userone()
    {
        return $this->belongsTo(User::class,  'user_one');
    }

    public function usertwo()
    {
        return $this->belongsTo(User::class,  'user_two');
    }
}
