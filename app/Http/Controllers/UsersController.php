<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;

class UsersController extends Controller
{
    // 自分のプロフィールページ
    public function profile()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }
        return view('users.profile', compact('user'));
    }

    // プロフィール更新
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }

        $request->validate([
            'username'   => 'required|min:2|max:12',
            'mail'       => 'required|email|min:5|max:40|unique:users,email,'.$user->id,
            'newPassword' => 'nullable|sometimes|alpha_num|min:8|max:20|confirmed',
            'bio'        => 'nullable|max:150',
            'iconImage'  => 'nullable|image|mimes:jpg,png,bmp,gif,svg'
        ]);

        // 更新
        $user->username = $request->username;
        $user->email    = $request->mail;
        // パスワード更新(入力あれば)
        if ($request->filled('newPassword')) {
            $user->password = bcrypt($request->newPassword);
        }
        // bio
        $user->bio = $request->bio;
        // アイコン画像
        if ($request->hasFile('iconImage')) {
            $path = $request->file('iconImage')->store('public/images');
            $user->icon_image = str_replace('public/', '', $path);
        }

        $user->save();

        return redirect()->route('users.profile')->with('success','プロフィール更新しました');
    }

    // ユーザー検索
    public function search()
    {
        return view('users.search'); // 検索フォーム表示
    }

    // 検索結果表示
    public function searchResult(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = User::query();
        if (!empty($keyword)) {
            // ユーザー名のみを対象に部分一致
            $query->where('username','LIKE',"%{$keyword}%");
        }
        // 新しい順
        $users = $query->orderBy('created_at','desc')->get();

        return view('users.search_result', compact('users','keyword'));
    }

    // 相手のプロフィール ( /users/profile/{id} )
    public function showOtherProfile($id)
    {
        $otherUser = User::findOrFail($id);
        // そのユーザーの投稿一覧
        $posts = Post::where('user_id', $otherUser->id)
                    ->orderBy('created_at','desc')
                    ->get();

        return view('users.profile', [
            'user'  => $otherUser,
            'posts' => $posts,
            'isOtherUser' => true // Bladeで「自分の画面かどうか」を判定
        ]);
    }

    // フォロー処理
    public function follow($id){
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }
        // すでにフォローしていないか確認
        if (!$user->follows()->where('followed_id', $id)->exists()) {
            $user->follows()->attach($id); // フォローを追加
        }
        return back();
    }


    // フォロー解除処理
    public function unfollow($id){
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }
        // フォローしている場合のみ解除
        $user->follows()->detach($id); // フォローを削除
        return back(); // 元のページにリダイレクト
    }

}
