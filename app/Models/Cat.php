<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cat extends Authenticatable
{
    protected $fillable = [
        'name', 'sex', 'breed', 'self_introduction', 'img_name', 'email', 'password','owner_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function receivedReactions()
    {
        return $this->hasMany(Reaction::class, 'to_cat_id');
    }

    public function sentReactions()
    {
        return $this->hasManyThrough(Reaction::class, User::class, 'id', 'from_user_id', 'id', 'id');
    }
}
