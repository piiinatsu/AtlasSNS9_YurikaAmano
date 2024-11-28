<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     * 登録画面を表示する
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // バリデーションの追加
        $validatedData = $request->validate([
            'username' => 'required|string|min:2|max:12', // 入力必須、文字列、2～12文字
            'email' => 'required|string|email|max:40|unique:users,email', // 入力必須、メアド形式、一意性
            'password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/^[a-zA-Z0-9]+$/', // 英数字のみ
                'confirmed', // password_confirmation と一致
            ],
        ]);

        // ユーザー登録処理（暗号化）
        $user = User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // セッションにユーザー名を保存
        $request->session()->put('registered_username', $user->username);

        return redirect()->route('register.added');
    }

    // 登録完了画面を出す
    public function added(): View
    {
        // セッションからユーザー名を取得
        $username = session('registered_username');

        // 登録完了画面を表示
        return view('auth.added', ['username' => $username]);
    }
}
