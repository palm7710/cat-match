<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'to_cat_id', 'from_user_id', 'status',
    ];

    public function cat()
    {
        return $this->belongsTo(Cat::class, 'to_cat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
}
