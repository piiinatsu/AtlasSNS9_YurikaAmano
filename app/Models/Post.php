<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post',
    ];

    // この投稿をしたユーザーを取得する
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
