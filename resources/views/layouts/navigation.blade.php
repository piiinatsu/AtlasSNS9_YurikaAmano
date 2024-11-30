<link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
<script src="{{ asset('js/dropdown.js') }}" defer></script>

<div class="header-container">
    <h1><a href="#"><img src="images/atlas.png" alt="Atlas Logo"></a></h1>
    <div class="user-menu">
        <!-- ユーザー情報 -->
        <div class="user-info">
            <span class="user-name">{{ $username }}さん</span>
            <img src="images/icon1.png" alt="User Icon" class="user-icon">
            <button class="dropdown-button">
                <span class="dropdown-arrow"></span>
            </button>
        </div>

        <!-- アコーディオンメニュー -->
        <ul class="dropdown-menu">
            <li><a href="{{ route('top') }}">HOME</a></li>
            <li><a href="{{ route('profile') }}">プロフィール編集</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <a href="#" onclick="this.closest('form').submit()">ログアウト</a>
                </form>
            </li>
        </ul>
    </div>
</div>
