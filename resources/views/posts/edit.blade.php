<x-login-layout>
  <div class="edit_container">
    <h2>投稿を編集</h2>

    <form method="POST" action="{{ route('posts.update', $post->id) }}">
      @csrf
      @method('PUT')

      <!-- 投稿の入力フォーム -->
      <textarea name="post" class="edit_input" maxlength="150" required>{{ old('post', $post->post) }}</textarea>

      <div class="edit_buttons">
        <button type="submit" class="update_btn">更新</button>
        <a href="{{ route('posts.index') }}" class="cancel_btn">キャンセル</a>
      </div>
    </form>
  </div>
</x-login-layout>
