<!-- コンポーネントに変数を渡す -->
<x-login-layout :username="$username" :followCount="$followCount" :followerCount="$followerCount">
<link rel="stylesheet" href="{{ asset('css/follows.css') }}">

<div class="container">
  <div class="follow_header">
    <h2 class="follow_title">Follow List</h2>
    <!-- アイコン一覧 -->
        <div class="icon_list">
          @if ($followedUsers->isNotEmpty())
            @foreach ($followedUsers as $follower)
            @php
            $iconPath = $follower->icon_image
              ? (\Illuminate\Support\Str::startsWith($follower->icon_image, 'images/')
                  ? 'storage/' . $follower->icon_image
                  : 'storage/images/' . $follower->icon_image)
              : 'images/default-icon.png';
            @endphp
            <a href="{{ route('users.show', ['id' => $follower->id]) }}">
              <img src="{{ asset($iconPath) }}" alt="{{ $follower->username }}" class="user_icon">
            </a>
            @endforeach
          @else
              <p>フォローしている人はいません。</p>
          @endif
        </div>
    </div>
    <hr class="section_divider">
    <!-- 投稿一覧 -->
    <div class="post_list">
    <ul>
      @if ($followingsPosts->isNotEmpty())
        @foreach ($followingsPosts as $post)
        @php
            $iconPath = $post->user->icon_image
              ? (\Illuminate\Support\Str::startsWith($post->user->icon_image, 'images/')
                  ? 'storage/' . $post->user->icon_image
                  : 'storage/images/' . $post->user->icon_image)
              : 'images/default-icon.png';
          @endphp
          <li class="post_block">
            <figure>
              <a href="{{ route('users.show', ['id' => $post->user->id]) }}">
                <img src="{{ asset($iconPath) }}" alt="{{ $post->user->username }}">
              </a>
            </figure>
              <div class="post_content">
                <div>
                  <div class="post_name">{{ $post->user->username }}</div>
                  <div class="post_date">{{ $post->created_at->format('Y-m-d H:i') }}</div>
                </div>
                <div class="post_text">{!! nl2br(e($post->post)) !!}</div>
              </div>
            </li>
        @endforeach
      @else
          <p>フォロー中のユーザーの投稿はありません。</p>
      @endif
    </ul>
  </div>
</div>

</x-login-layout>
