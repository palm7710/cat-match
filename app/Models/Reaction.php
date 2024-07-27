<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'to_user_id', 'from_cat_id', 'to_cat_id', 'from_user_id', 'status',
    ];

    public function toCat()
    {
        return $this->belongsTo(Cat::class, 'to_cat_id');
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function fromCat()
    {
        return $this->belongsTo(Cat::class, 'from_cat_id');
    }
}
