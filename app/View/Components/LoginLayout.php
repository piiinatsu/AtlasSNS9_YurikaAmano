<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class loginLayout extends Component
{
    // 「ユーザ名・フォロー数・フォロワー数」の受け取り口を作る
    public $username;
    public $followCount;
    public $followerCount;

    // ★ コンストラクタで変数を受け取る
    public function __construct($username = null, $followCount = 0, $followerCount = 0)
    {
        $this->username = $username;
        $this->followCount = $followCount;
        $this->followerCount = $followerCount;
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.login');
    }
}
