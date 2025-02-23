<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostsController extends Controller
{
    // トップページ(投稿一覧)表示
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            // ログインしていない場合はリダイレクトや処理を変える
            return redirect('/login');
        }

        // ログインユーザー + フォローしているユーザーの投稿一覧
        $followIds = $user->follows()->pluck('followed_id')->all();
        $relevantUserIds = array_merge([$user->id], $followIds);

        $posts = Post::whereIn('user_id', $relevantUserIds)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('posts.index', ['posts' => $posts]);
    }

    // 新規投稿
    public function store(Request $request)
    {
        $request->validate([
            'post' => 'required|string|min:1|max:150'
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'post' => $request->post,
        ]);

        return redirect()->route('posts.index');
    }

    // 投稿削除
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // 自分の投稿のみ削除可
        if ($post->user_id === Auth::id()) {
            $post->delete();
        }
        return redirect()->route('posts.index');
    }

    // 投稿編集画面
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id !== Auth::id()) {
            abort(403); // 権限エラー
        }
        return view('posts.edit', compact('post'));
    }

    // 投稿更新
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'post' => 'required|string|min:1|max:150'
        ]);

        $post->post = $request->post;
        $post->save();

        return redirect()->route('posts.index');
    }
}
