<!-- コンポーネントに変数を渡す -->
<x-login-layout :username="$username" :followCount="$followCount" :followerCount="$followerCount">

<div class="container">
    <!-- アイコン一覧 -->
    <div class="follower-icons">
        <div class="icon-list">
          @if ($followerRecords->isNotEmpty())
            @foreach ($followers as $follower)
                <a href="{{ route('profile.show', ['id' => $follower->id]) }}">
                    <img src="{{ $follower->icon_image ?? asset('default-icon.png') }}"
                      alt="{{ $follower->username }}"
                      class="user-icon">
                </a>
            @endforeach
          @else
              <p>フォロワーはいません。</p>
          @endif
        </div>
    </div>

    <!-- 投稿一覧 -->
    <div class="follower-posts">
      @if ($followerPosts->isNotEmpty())
        @foreach ($followerPosts as $post)
            <div class="post">
                <div class="post-header">
                    <img src="{{ $post->user->icon_image ?? asset('default-icon.png') }}"
                      alt="{{ $post->user->username }}"
                      class="user-icon-small">
                    <span class="post-username">{{ $post->user->username }}</span>
                    <span class="post-date">{{ $post->created_at->format('Y-m-d H:i') }}</span>
                </div>
                <p class="post-content">{{ $post->post }}</p>
            </div>
        @endforeach
      @else
          <p>フォロー中のユーザーの投稿はありません。</p>
      @endif
    </div>
</div>

</x-login-layout>
