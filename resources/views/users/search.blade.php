<x-login-layout>
<link rel="stylesheet" href="{{ asset('css/search.css') }}">

  <div class="search_container">
    <div class="search_form_wrapper">
      <!-- 左側：検索フォーム -->
      <div class="search_form_left">
        <form action="{{ route('users.search_result') }}" method="GET" class="search_form">
          <input type="text" name="keyword" placeholder="ユーザー名" class="search_input">
          <button type="submit" class="search_btn">
            <img src="{{ asset('images/search.png') }}" alt="検索">
          </button>
        </form>
      </div>

      <!-- 右側：検索ワード -->
      @if (!empty($keyword))
        <p class="search_keyword_inline">検索ワード：<strong>{{ $keyword }}</strong></p>
      @endif
    </div>
    <div class="section_divider"></div>
    <!-- 検索結果リスト -->
    <div class="user_list">
      @foreach ($users as $user)
        <div class="user_item">
          @php
            $iconPath = $user->icon_image
              ? 'images/' . $user->icon_image
              : 'images/default-icon.png';
          @endphp

          <!-- アイコン -->
          <img src="{{ asset($iconPath) }}" alt="User Icon" class="user_icon">
          <!-- ユーザー名 -->
          <span class="user_name">{{ $user->username }}</span>

          <!-- フォロー/解除ボタン -->
          <div class="follow_form">
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
        </div>
      @endforeach
    </div>
  </div>

</x-login-layout>
