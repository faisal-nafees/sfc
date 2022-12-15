<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideContent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function slide()
    {
        return $this->belongsTo('App\Models\Slide');
    }
    public function qa()
    {
        return $this->belongsTo('App\Models\Qa');
    }
}
