<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;
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
  // Route::get('/users/profile', [UsersController::class, 'profile'])->name('users.profile');
  Route::get('users/profile', [ProfileController::class, 'profile'])->name('users.profile');
  // プロフィール更新
  Route::post('/users/profile/update', [UsersController::class, 'updateProfile'])->name('users.updateProfile');
  // ユーザー検索ページ
  // Route::get('/users/search', [UsersController::class, 'searchForm'])->name('users.search_form');
  Route::get('users/search', [UsersController::class, 'search'])->name('users.search');
  // 検索結果ページ
  Route::get('users/search_result', [UsersController::class, 'searchResult'])->name('users.search_result');
  // フォロー・フォロー解除
  Route::post('users/follow/{id}', [UsersController::class, 'follow'])->name('users.follow');
  Route::post('users/unfollow/{id}', [UsersController::class, 'unfollow'])->name('users.unfollow');
  // フォローリストページ
  Route::get('follows/followlist', [FollowsController::class, 'followList'])->name('follows.followlist');
  // フォロワーリストページ
  Route::get('follows/followerlist', [FollowsController::class, 'followerList'])->name('follows.followerlist');
  // 投稿一覧
  Route::get('posts/index', [PostsController::class, 'index'])->name('posts.index');
  // 投稿の作成
  Route::post('posts/store', [PostsController::class, 'store'])->name('posts.store');
  // 投稿の編集
  Route::get('/posts/{id}/edit', [PostsController::class, 'edit'])->name('posts.edit');
  // 投稿の更新
  Route::post('/posts/{id}/update', [PostsController::class, 'update'])->name('posts.update');
  // 投稿の削除
  // Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('posts.destroy');
  Route::delete('posts/{id}/destroy', [PostsController::class, 'destroy'])->name('posts.destroy');
  // 相手のプロフィール (id付き)
  Route::get('/users/profile/{id}', [UsersController::class, 'showOtherProfile'])->name('users.show');
});
