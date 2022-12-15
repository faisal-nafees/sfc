<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\Category')->where('active', 'Y');
    }

    public function qa()
    {
        return $this->hasMany('App\Models\QuesAns')->where('active', 'Y');
    }

    public function slide()
    {
        return $this->hasOne('App\Models\Slide');
    }

    public function analytics()
    {
        return $this->hasMany('App\Models\Analytic');
    }

    public function slideProgress()
    {
        return $this->hasOneThrough('App\Models\SlideProgress', 'App\Models\Slide');
    }
}
