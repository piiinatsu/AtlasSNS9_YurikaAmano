<x-login-layout :username="$user->username" :followCount="$user->follows()->count()" :followerCount="$user->followers()->count()">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="container">
  <div class="follow_header">
    <div class="icon_list">
      @php
          $iconPath = $user->icon_image
              ? (Str::startsWith($user->icon_image, 'images/')
                  ? 'storage/' . $user->icon_image
                  : 'storage/images/' . $user->icon_image)
              : 'images/default-icon.png';
      @endphp
      <img src="{{ asset($iconPath) }}" alt="{{ $user->username }}" class="user_icon">

      <div class="user_info">
        <p><strong>name</strong> {{ $user->username }}</p>
        <p><strong>bio</strong> {{ $user->bio }}</p>
      </div>

      <div class="follow_action">
        @if(Auth::user()->follows()->where('followed_id', $user->id)->exists())
          <form method="POST" action="{{ route('users.unfollow', $user->id) }}">
            @csrf
            <button type="submit" class="btn btn-danger">フォロー解除</button>
          </form>
        @else
          <form method="POST" action="{{ route('users.follow', $user->id) }}">
            @csrf
            <button type="submit" class="btn btn-primary">フォローする</button>
          </form>
        @endif
      </div>
    </div>
  </div>

  <hr class="section_divider">

  <div class="post_list">
    <ul>
      @foreach ($posts as $post)
        @php
            $iconPath = $user->icon_image
                ? (Str::startsWith($user->icon_image, 'images/')
                    ? 'storage/' . $user->icon_image
                    : 'storage/images/' . $user->icon_image)
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
</x-login-layout>
