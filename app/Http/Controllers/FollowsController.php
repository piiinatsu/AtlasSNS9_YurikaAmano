<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // リクエストのデータを受け取る
use Illuminate\Support\Facades\Auth; //ログインしているユーザーの情報を取得する
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;

class FollowsController extends Controller //親の Controller の機能を引き継ぐ
{
    // フォローリストページ(フォローしているユーザーのアイコン一覧 + 投稿一覧)
    public function followList(){
        $user = Auth::user(); // ログイン中のユーザーの情報を取得
        if (!$user) {
            return redirect('/login');
        }

        // --- レイアウト用 (ヘッダー等で表示する用) ---
        $username       = $user->username;
        $followCount    = $user->follows->count();    // フォロー数
        $followerCount  = $user->followers->count();  // フォロワー数

        // 上段アイコン: 「自分がフォローしているユーザー」コレクション
        $followedUsers = $user->follows;

        // 下段投稿一覧: そのユーザーたちの投稿
        $followingsPosts = \App\Models\Post::whereIn('user_id', $followedUsers->pluck('id'))
                                        ->orderBy('created_at','desc')
                                        ->get();

        return view('follows.followList', compact(
            'username', 'followCount', 'followerCount',
            'followedUsers', 'followingsPosts'
        ));
    }
    // フォロワーリストページ
    public function followerList()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }
        // --- 追加: レイアウト用 ---
        $username      = $user->username;
        $followCount   = $user->follows()->count();
        $followerCount = $user->followers()->count();
        // 自分をフォローしている「Followモデルのコレクション」
        // (followed_id = 自分のID)
        $followerUsers = $user->followers;
        // フォロワーのリストを取得
        $followers = collect(); // **エラー回避のため空のコレクションを用意**
        if ($followerUsers->isNotEmpty()) {
        $followers = User::whereIn('id', $followerUsers->pluck('following_id'))->get();
        }
        // 自分をフォローしているユーザーたちの投稿を取得
        // => Followテーブルの "following_id" が投稿者のIDになる
        $followerUserIds = $followerUsers->pluck('id')->toArray();
        $followerPosts = Post::whereIn('user_id', $followerUserIds)
                                ->orderBy('created_at','desc')
                                ->get();

        return view('follows.followerList', [
            'username'       => $username,
            'followCount'    => $followCount,
            'followerCount'  => $followerCount,
            'followerUsers'  => $followerUsers,   // アイコン一覧用
            'followerPosts'  => $followerPosts,   // 投稿一覧用
        ]);
    }
}
