<x-login-layout>

  <div class="post-container">
    <!-- 投稿フォーム -->
    <div class="post-form">
      <img src="{{ asset('images/icon1.png') }}" alt="User Icon" class="user-icon">
      <!-- フォーム送信でデータベースに投稿を保存 -->
      <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <input type="text" name="content" placeholder="投稿内容を入力してください。" class="post-input" required>
        <button type="submit" class="post-submit">
          <img src="{{ asset('images/send.png') }}" alt="送信">
        </button>
      </form>
    </div>

    <!-- 投稿リスト -->
    <div class="post-list">
      @foreach($posts as $post)
        <div class="post-item">
          <img src="{{ asset('images/icon1.png') }}" alt="User Icon" class="user-icon">
          <div class="post-content">
            <p class="user-name">{{ $post->user->name }}</p>
            <p class="post-text">{{ $post->content }}</p>
            <p class="post-time">{{ $post->created_at->format('Y-m-d H:i') }}</p>
          </div>

          <!-- 投稿の編集・削除ボタン（ログインユーザーのみ、自分のだけ編集可能） -->
          @if(Auth::id() === $post->user_id)
            <div class="post-actions">
              <form method="POST" action="{{ route('posts.destroy', $post->id) }}" onsubmit="return confirm('削除しますか？')">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">
                  <img src="{{ asset('images/delete.png') }}" alt="削除">
                </button>
              </form>
            </div>
          @endif
        </div>
      @endforeach
    </div>
  </div>

</x-login-layout>
