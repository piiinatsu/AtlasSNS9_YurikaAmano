<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;
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
Route::post('/auth/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// ログイン中のみアクセス可能なルートをグループ化
Route::middleware(['auth'])->group(function () {
  // トップページ
  Route::get('posts/index', [PostsController::class, 'index'])->name('posts.index');
  // プロフィールページ
  Route::get('users/profile', [ProfileController::class, 'profile'])->name('users.profile');
  // ユーザー検索ページ
  Route::get('users/search', [UsersController::class, 'search'])->name('users.search');
  // 検索結果ページ
  Route::get('users/search_result', [UsersController::class, 'searchResult'])->name('users.search_result');
  // フォローリストページ
  Route::get('follows/followlist', [FollowsController::class, 'followList'])->name('follows.followlist');
  // フォロワーリストページ
  Route::get('follows/followerlist', [FollowsController::class, 'followerList'])->name('follows.followerlist');
});
