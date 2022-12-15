<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qa extends Model
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
    public function slides()
    {
        return $this->belongsToMany('App\Models\Slide', 'slide_contents');
    }
    public function slideContent()
    {
        return $this->hasOne('App\Models\SlideContent');
    }
}
