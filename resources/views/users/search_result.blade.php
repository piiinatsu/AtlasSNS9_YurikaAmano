<x-login-layout>

  <div class="search-container">
    <!-- 検索フォーム -->
    <form action="{{ route('users.search_result') }}" method="GET" class="search-form">
      <input type="text" name="keyword" placeholder="ユーザー名" value="{{ $keyword ?? '' }}" class="search-input">
      <button type="submit" class="search-btn">
        <img src="{{ asset('images/search-icon.png') }}" alt="検索">
      </button>
    </form>

    <!-- 検索ワード表示 -->
    @if (!empty($keyword))
      <p class="search-keyword">検索ワード： <strong>{{ $keyword }}</strong></p>
    @endif

    <!-- 検索結果リスト -->
    <div class="user-list">
      @foreach ($users as $user)
        <div class="user-item">
          <img src="{{ asset('images/icon1.png') }}" alt="{{ $user->username }}" class="user-icon">
          <span class="user-name">{{ $user->username }}</span>

          @if(Auth::user()->follows()->where('followed_id', $user->id)->exists())
            <!-- フォロー解除ボタン -->
            <form method="POST" action="{{ route('users.unfollow', $user->id) }}">
                @csrf
                <button type="submit" class="btn btn-danger">フォロー解除</button>
            </form>
          @else
            <!-- フォローボタン -->
            <form method="POST" action="{{ route('users.follow', $user->id) }}">
                @csrf
                <button type="submit" class="btn btn-primary">フォローする</button>
            </form>
          @endif
        </div>
      @endforeach
    </div>

  </div>

</x-login-layout>
