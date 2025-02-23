<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //  全てのビューでフォロー数・フォロワー数・ユーザー名を共有する
        View::composer('*', function ($view) {
            $user = Auth::user(); // 現在ログイン中のユーザーを取得

            if ($user) {
                // ログインしている場合
                $view->with('username', $user->username);
                $view->with('followCount', $user->follows()->count());
                $view->with('followerCount', $user->followers()->count());
            } else {
                // ログインしていない場合
                $view->with('username', 'ゲスト');
                $view->with('followCount', 0);
                $view->with('followerCount', 0);
            }
        });
    }
}
