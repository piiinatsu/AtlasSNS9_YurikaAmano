<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function profile(){
        $user = Auth::user(); // ログイン中のユーザー情報を取得
        if (!$user) {
            return redirect('/login'); // 未ログインならログイン画面へリダイレクト
        }
        return view('profiles.profile', compact('user'));
    }

}
