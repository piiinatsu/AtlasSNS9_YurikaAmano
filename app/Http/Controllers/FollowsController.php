<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // リクエストのデータを受け取る
use Illuminate\Support\Facades\Auth; //ログインしているユーザーの情報を取得する
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;

class FollowsController extends Controller //親の Controller の機能を引き継ぐ
{
    // フォローリストページ
    public function followList(){
        $user = Auth::user(); // ログイン中のユーザーの情報を取得
        if (!$user) {
            return redirect('/login');
        }
        // フォローリスト (Follow テーブルのデータ)
        $followRecords = $user->follows;
        // フォローしているユーザーのリスト
        $followers = User::whereIn('id', $followRecords->pluck('followed_id'))->get();
        // フォローしているユーザーの投稿を取得
        $followerPosts = Post::whereIn('user_id', $followers->pluck('id'))
            ->orderBy('created_at', 'desc') // 新しい順に並べる
            ->get();
        // ビューに送る
        return view('follows.followList', compact(
            'followRecords',
            'followers',
            'followerPosts'
        ));
    }
    // フォロワーリストページ
    public function followerList()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }

        // 自分をフォローしている「Followモデルのコレクション」
        // (followed_id = 自分のID)
        $followerRecords = $user->followers ?? collect();

        // 自分をフォローしているユーザーたちの投稿を取得
        // => Followテーブルの "following_id" が投稿者のIDになる
        $followerUserIds = $followerRecords->pluck('following_id');
        $followerPosts = Post::whereIn('user_id', $followerUserIds)
                                ->orderBy('created_at','desc')
                                ->get();

        return view('follows.followerList', compact(
            'followerRecords',
            'followerPosts'
        ));
    }
    // **サイドバー用のフォロー数・フォロワー数を取得**
    public function followInfo()
    {
        $user = Auth::user(); // ログイン中のユーザーの情報を取得
        if (!$user) {
            return redirect('/login');
        }

        return view('layouts.sidebar');
    }
}
