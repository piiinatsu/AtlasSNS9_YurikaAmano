<x-login-layout :username="$user->username" :followCount="$user->follows()->count()" :followerCount="$user->followers()->count()">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="container">
  <div class="follow_header">
    <div class="icon_list">
      @php
        $iconPath = $user->icon_image
          ? 'images/' . $user->icon_image
          : 'images/default-icon.png';
      @endphp
      <img src="{{ asset($iconPath) }}" alt="{{ $user->username }}" class="user_icon">

      <div class="user_info">
        <div class="info_row">
          <span class="info_label">ユーザー名</span>
          <span class="info_value">{{ $user->username }}</span>
        </div>
        <div class="info_row">
          <span class="info_label">自己紹介</span>
          <span class="info_value">{{ $user->bio }}</span>
        </div>
      </div>
      <div class="follow_action" id="followArea">
        @include('components.follow_button', ['targetUser' => $user])
      </div>
    </div>
  </div>

  <hr class="section_divider">

  <div class="post_list">
    <ul>
      @foreach ($posts as $post)
        @php
          $iconPath = $user->icon_image
            ? 'images/' . $user->icon_image
            : 'images/default-icon.png';
        @endphp
        <li class="post_block">
          <figure>
            <a href="{{ route('users.show', ['id' => $user->id]) }}">
              <img src="{{ asset($iconPath) }}" alt="{{ $user->username }}">
            </a>
          </figure>
          <div class="post_content">
            <div class="post_header">
              <div class="post_name">{{ $user->username }}</div>
              <div class="post_date">{{ $post->created_at->format('Y-m-d H:i') }}</div>
            </div>
            <div class="post_text">{!! nl2br(e($post->post)) !!}</div>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</div>
<script src="{{ asset('js/follow.js') }}"></script>
</x-login-layout>
