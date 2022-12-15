<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function users()
    {
        return $this->belongsToMany(User::class, 'category_user');
    }

    public function subcategories()
    {
        return $this->hasMany('App\Models\Subcategory')->where('active', 'Y');
    }

    public function analytics()
    {
        return $this->hasManyThrough('App\Models\Analytic', 'App\Models\Subcategory');
    }

    public function qa()
    {
        return $this->hasMany('App\Models\QuesAns')->where('active', 'Y');
    }

    public function slideProgress()
    {
        return $this->hasMany('App\Models\SlideProgress');
    }
}
