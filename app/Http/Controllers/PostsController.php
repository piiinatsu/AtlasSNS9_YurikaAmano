<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    // public function index(){
    //     return view('posts.index');
    // }
    public function index(){
        // ログイン中のユーザー情報を取得
        $username = Auth::user()->username;
        // ビューに渡す
        // return view('ビュー名', ['キー名' => 値]);
        return view('layouts.navigation', ['username' => $username]);
    }
}
