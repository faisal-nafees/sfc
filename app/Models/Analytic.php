<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Analytic extends Model
{
    use HasFactory, \Znck\Eloquent\Traits\BelongsToThrough;
    protected $guarded = [];

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class);
    }

    public function categories()
    {
        return $this->belongsToThrough(Category::class, Subcategory::class);
    }
}
