        <div id="head">
            <h1><a href="#"><img src="images/atlas.png"></a></h1>
            <div id="">
                <div id="">
                    <p>{{ $username }}さん</p>
                </div>
                <ul>
                    <li><a href="{{ route('top') }}">ホーム</a></li>
                    <li><a href="{{ route('profile') }}">プロフィール</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <a href="#" onclick="this.closest('form').submit()">ログアウト</a>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
