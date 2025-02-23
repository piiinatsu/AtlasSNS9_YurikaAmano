<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory; // データベースにテスト用のダミーデータを簡単に作れる
    protected $fillable = [ //どのカラムのデータを追加していいか
        'following_id', // フォローした人のID
        'followed_id',  // フォローされた人のID
    ];

    // フォローしたユーザー
    public function followingUser()
    {
        return $this->belongsTo(User::class, 'following_id');
        // return $this->belongsTo(1モデル(相手)の場所, '、多モデル(自分)のidが入ったカラム');
    }

    // フォローされたユーザー
    public function followedUser()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
}
