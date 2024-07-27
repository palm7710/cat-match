<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_id', 'user_id', 'status',
    ];

    // 必要に応じてリレーションを追加
    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
