<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\Category')->where('active', 'Y');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory')->where('active', 'Y');
    }
    public function qa()
    {
        return $this->belongsToMany('App\Models\Qa', 'slide_contents');
    }
    public function slideContents()
    {
        return $this->hasMany('App\Models\SlideContent');
    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'slide_progress');
    }
    public function slideProgress()
    {
        return $this->hasOne('App\Models\SlideProgress');
    }
}
