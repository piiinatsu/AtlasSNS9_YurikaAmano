<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     * createメソッド: ログインページ（auth.loginビュー）を表示する処理。
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     * storeメソッド: ユーザーが送信したログイン情報を認証し、セッションを作成する処理。
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended('top');
    }

    /**
     * Log the user out of the application.
     * LaravelのAuthファサードを使ってユーザーをログアウトさせる
     */
    public function destroy(Request $request): RedirectResponse
    {
        // ユーザーをログアウト
        Auth::guard('web')->logout();

        // セッションを無効化
        $request->session()->invalidate();

        // セッションのトークンを再生成
        $request->session()->regenerateToken();

        // ログインページにリダイレクト
        return redirect('/login');
    }
}
