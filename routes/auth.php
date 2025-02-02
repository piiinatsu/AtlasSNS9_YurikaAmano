<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// ゲスト専用ページ
Route::middleware('guest')->group(function () {

    // ログインページ
    Route::get('auth/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('auth/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

    // 新規登録ページ
    Route::get('auth/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('auth/register', [RegisteredUserController::class, 'store'])->name('register.store');

    // 新規登録完了ページ
    Route::get('auth/added', [RegisteredUserController::class, 'added'])->name('register.added');

});
