<x-login-layout>
  <h1>投稿編集</h1>
  <form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    <textarea name="post" rows="3">{{ old('post', $post->post) }}</textarea>
    @error('post')
      <div class="error">{{ $message }}</div>
    @enderror
    <button type="submit">更新</button>
  </form>
</x-login-layout>
