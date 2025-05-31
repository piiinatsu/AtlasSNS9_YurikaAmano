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
        $posts = Post::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        return view('users.profile', compact('user', 'posts'));
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
            $file = $request->file('iconImage');
            // $filename = $file->getClientOriginalName();
            $filename = time().'_'.$user->id.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $user->icon_image = $filename; // ファイル名だけをDBに保存
        }

        $user->save();

        return redirect()->route('users.profile')->with('success','プロフィール更新しました');
    }

    // ユーザー検索
    public function search()
    {
        $user = Auth::user(); // ログイン中のユーザーを取得
        // 自分を除いたユーザー一覧を取得
        $users = User::where('id', '!=', $user->id)->orderBy('created_at', 'desc')->get();
        return view('users.search', compact('users')); // 検索フォーム表示
    }

    // 検索結果表示
    public function searchResult(Request $request)
    {
        $keyword = $request->input('keyword');
        $user = Auth::user(); // ログインユーザー取得

        $query = User::query();
        if (!empty($keyword)) {
            // ユーザー名のみを対象に部分一致
            $query->where('username','LIKE',"%{$keyword}%");
        }
        // 自分以外を新しい順
        $users = $query->where('id', '!=', $user->id)->orderBy('created_at','desc')->get();

        return view('users.search_result', compact('users','keyword'));
    }

    // 相手のプロフィール ( /users/profile/{id} )
    public function showOtherProfile($id)
    {
        $loginUser = Auth::user(); // 現在ログイン中のユーザー
        $otherUser = User::findOrFail($id); // 表示対象のユーザー

        // 自分自身のプロフィールなら編集ページにリダイレクト
        if ($loginUser->id === $otherUser->id) {
            return redirect()->route('users.profile');
            }
        // 相手のの投稿一覧
        $posts = Post::where('user_id', $otherUser->id)
                    ->orderBy('created_at','desc')
                    ->get();

        return view('users.profile_readonly', [
            'user'  => $otherUser,
            'posts' => $posts,
        ]);
    }

    // フォロー処理
    public function follow($id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }

        // すでにフォローしていないときのみ追加
        if (!$user->follows()->where('followed_id', $id)->exists()) {
            $user->follows()->attach($id);
        }

        // Ajaxリクエストなら、部分HTMLを返す
        if (request()->ajax()) {
            $targetUser = User::findOrFail($id);
            return response()->json([
                'html' => view('components.follow_button', compact('targetUser'))->render(),
                'followCount' => Auth::user()->follows()->count(),
                'followerCount' => $user->followers()->count(),
            ]);
        }

        // 通常リクエストはリダイレクト
        return redirect()->route('users.search');
    }

    // フォロー解除処理
    public function unfollow($id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }

        // フォロー中のときのみ削除
        if ($user->follows()->where('followed_id', $id)->exists()) {
            $user->follows()->detach($id);
        }

        if (request()->ajax()) {
            $targetUser = User::findOrFail($id);
            return response()->json([
                'html' => view('components.follow_button', compact('targetUser'))->render(),
                'followCount' => Auth::user()->follows()->count(),
                'followerCount' => $user->followers()->count(),
            ]);
        }

        return redirect()->route('users.search');
    }

}
