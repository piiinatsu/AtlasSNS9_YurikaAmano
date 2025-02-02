<link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
<script src="{{ asset('js/dropdown.js') }}" defer></script>

<div class="layout-container">
  <!-- ヘッダー -->
  <div class="header-container">
    <h1><a href="{{ route('posts.index') }}"><img src="{{ asset('images/atlas.png') }}" alt="Atlas Logo"></a></h1>
    <div class="user-menu">
      <!-- ユーザー情報 -->
      <div class="user-info">
        <span class="user-name">{{ $username }}さん</span>
        <img src="{{ asset('images/icon1.png') }}" alt="User Icon" class="user-icon">
        <button class="dropdown-button">
          <span class="dropdown-arrow"></span>
        </button>
      </div>

      <!-- アコーディオンメニュー -->
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

  <!-- コンテンツとサイドバー -->
  <div class="content-container">
    <!-- メインコンテンツのエリア -->
    <div class="content-area">
      <!-- ここにページ内容が入ります -->
    </div>

    <!-- サイドバー -->
    <div class="sidebar">
      <div class="follow-info">
        <p>フォロー数 <span class="follow-count">12人</span></p>
        <a href="{{ route('follows.followlist') }}" class="btn-follow">フォローリスト</a>
        <p>フォロワー数 <span class="follower-count">20人</span></p>
        <a href="{{ route('follows.followerlist') }}" class="btn-follow">フォロワーリスト</a>
      </div>

      <div class="search">
        <a href="{{ route('users.search') }}" class="btn-search">ユーザー検索</a>
      </div>
    </div>
  </div>
</div>
