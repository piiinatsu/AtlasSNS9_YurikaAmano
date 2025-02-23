<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'bio',
        'icon_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // このユーザーがフォローしているユーザー（フォローリスト）
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id')
                    ->withTimestamps();
    }

    // このユーザーをフォローしているユーザー（フォロワーリスト）
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id')
                    ->withTimestamps();
    }

    // このユーザーが投稿した記事
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }
}
