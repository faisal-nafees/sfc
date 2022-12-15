<?php

namespace App\Models;

use App\Models\Analytic;
use App\Casts\Base64Encode;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory,  Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'role',
        'email',
        'id_image',
        'org_code',
        'failed_attempts',
        'status',
        'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fname'             => Base64Encode::class,
        'lname'             => Base64Encode::class,
        'email'             => Base64Encode::class,
        'email_verified_at' => 'datetime',
        'slide_progress' => 'array',
    ];

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    // protected function fname(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => base64_decode($value),
    //         set: fn ($value) => base64_encode($value),
    //     );
    // }
    public function scopeWhereBaseEnc($query,$field, $op = '=', $value)
    {
        return $query->where($field, $op, base64_encode($value));
    }

    public function scopeOrWhereBaseEnc($query,$field, $op = '=', $value)
    {
        return $query->orWhere($field, $op, base64_encode($value));
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_user');
    }
    public function slides()
    {
        return $this->belongsToMany('App\Models\Slide', 'slide_progress');
    }
    public function slideprogress()
    {
        return $this->hasMany('App\Models\SlideProgress');
    }
    public function answers()
    {
        return $this->hasMany('App\Models\UserAnswer');
    }
    public function analytics()
    {
        return $this->hasMany(Analytic::class);
    }
    public function conversations()
    {
        return $this->hasMany('App\Models\Conversation');
    }
}
