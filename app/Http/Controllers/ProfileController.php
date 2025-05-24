<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\Post;

class ProfileController extends Controller
{
    public function profile(){
        $user = Auth::user(); // ログイン中のユーザー情報を取得
        if (!$user) {
            return redirect('/posts/index');
        }
        // 投稿一覧を取得
        $posts = Post::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('profiles.profile', compact('user', 'posts'));
    }
    // プロフィール更新処理
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // バリデーション
        $validated = $request->validate([
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|email|max:40',
            'newPassword' => 'nullable|string|min:8|max:20|confirmed|regex:/^[a-zA-Z0-9]+$/',
            'bio' => 'nullable|string|max:150',
            'iconImage' => 'nullable|image|max:2048',
        ]);

        // 値の更新
        $user->username = $validated['username'];
        $user->email = $validated['mail'];
        $user->bio = $validated['bio'];

        // パスワードが入力されていれば更新
        if (!empty($validated['newPassword'])) {
            $user->password = Hash::make($validated['newPassword']);
        }

        // アイコン画像がアップロードされていれば保存
        if ($request->hasFile('iconImage')) {
            $filename = uniqid() . '.' . $request->file('iconImage')->getClientOriginalExtension();
            $request->file('iconImage')->storeAs('public/images', $filename);
            $user->icon_image = $filename;
        }

        $user->save();

        // 保存後に投稿一覧ページへリダイレクト
        return redirect('/posts/index');
    }

}
