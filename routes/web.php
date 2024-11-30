<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



require __DIR__ . '/auth.php';
// ログアウト処理
Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
// 登録完了ページ（ログイン不要）
Route::get('/added', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'added'])->name('register.added');
// ログインページ表示
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
// ログイン処理
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');


// ログイン中のみアクセス可能なルートをグループ化
Route::middleware(['auth'])->group(function () {
// トップページ
Route::get('top', [PostsController::class, 'index'])->name('top');
// プロフィールページ
Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
// ユーザー検索ページ
Route::get('search', [UsersController::class, 'index'])->name('search');
// フォローリストページ
Route::get('follow-list', [PostsController::class, 'index'])->name('follow-list');
// フォロワーリストページ
Route::get('follower-list', [PostsController::class, 'index'])->name('follower-list');
});
