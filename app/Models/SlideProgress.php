<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast;

class SlideProgress extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'agreement' => 'object',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
    public function slide()
    {
        return $this->belongsTo('App\Models\Slide');
    }
}
