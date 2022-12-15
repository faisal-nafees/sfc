<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_answers');
    }
}
