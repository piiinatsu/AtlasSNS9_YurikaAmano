<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!--IEブラウザ対策-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ページの内容を表す文章" />
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/posts.css') }}">

  <!--スマホ,タブレット対応-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Scripts -->
  <!--サイトのアイコン指定-->
  <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
  <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
  <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
  <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
  <!--iphoneのアプリアイコン指定-->
  <link rel="apple-touch-icon-precomposed" href="画像のURL" />
  <!--OGPタグ/twitterカード-->
</head>

<<body>
  <header>
    <div class="header-container">
      <h1><a href="{{ route('posts.index') }}">
        <img src="{{ asset('images/atlas.png') }}" alt="Atlas Logo">
      </a></h1>
      <div class="user-menu">
        <!-- ユーザー情報 -->
        <div class="user-info">
          {{-- ★ $username が無ければゲスト表示 --}}
          <span class="user-name">{{ $username }}さん</span>
          <img src="{{ asset('images/icon1.png') }}" alt="User Icon" class="user-icon">
          <button class="dropdown-button"><span class="dropdown-arrow"></span></button>
        </div>

        <!-- ドロップダウンメニュー -->
        <ul class="dropdown-menu">
          <li><a href="{{ route('posts.index') }}">HOME</a></li>
          <li><a href="{{ route('users.profile') }}">プロフィール編集</a></li>
          <li>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
              @csrf
              <a href="#" onclick="this.closest('form').submit()">ログアウト</a>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </header>

  <div class="layout-container">
    <div class="content-container">
      {{-- ★ メインコンテンツ(子ビューが入る場所) --}}
      <div class="content-area">
        {{ $slot }}
      </div>
      {{-- ★ サイドバー --}}
      <div class="sidebar">
        <div class="follow-info">
          <p>フォロー数 <span class="follow-count">{{ $followCount ?? 0 }}人</span></p>
          <a href="{{ route('follows.followlist') }}" class="btn-follow">フォローリスト</a>
          <p>フォロワー数 <span class="follower-count">{{ $followerCount ?? 0 }}人</span></p>
          <a href="{{ route('follows.followerlist') }}" class="btn-follow">フォロワーリスト</a>
        </div>
        <div class="search">
          <a href="{{ route('users.search') }}" class="btn-search">ユーザー検索</a>
        </div>
      </div>
    </div>
  </div>

  <footer></footer>

  {{-- JS読み込み等 --}}
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/dropdown.js') }}" defer></script>
</body>
</html>