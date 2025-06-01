<x-login-layout>
<link rel="stylesheet" href="{{ asset('css/posts.css') }}">

  <div class="container">
    <!-- 投稿フォーム -->
    <div class="post_form">
      @php
        $authUser = \App\Models\User::find(Auth::id());
        $authIcon = $authUser && $authUser->icon_image
          ? 'images/' . $authUser->icon_image
          : 'images/default-icon.png';
      @endphp
      <img src="{{ asset($authIcon) }}" alt="User Icon" class="user_icon">

      <!-- フォーム送信でデータベースに投稿を保存 -->
      <form method="POST" action="{{ route('posts.store') }}" class="post_form_inner">
        @csrf
        <textarea name="post" placeholder="投稿内容を入力してください。" class="post_input" rows="3" required>{{ old('post') }}</textarea>
        @if ($errors->has('post'))
          <div class="error" style="color: red; margin-top: 4px;">
              {{ $errors->first('post') }}
          </div>
        @endif
        <button type="submit" class="post_submit">
          <img src="{{ asset('images/post.png') }}" alt="送信">
        </button>
      </form>
    </div>

    <!-- 区切り線 -->
    <hr class="section_divider">

    <!-- 投稿リスト -->
    <div class="post_list">
      <ul>
        @foreach($posts as $post)
          @php
            $iconPath = $post->user->icon_image
              ? 'images/' . $post->user->icon_image
              : 'images/default-icon.png';
          @endphp
          <li class="post_block">
            <figure>
              <a href="{{ route('users.show', ['id' => $post->user->id]) }}">
                <img src="{{ asset($iconPath) }}" alt="{{ $post->user->username }}">
              </a>
            </figure>
            <div class="post_content">
              <div class="post_header">
                <div class="post_name">{{ $post->user->username }}</div>
                <div class="post_date">{{ $post->created_at->format('Y-m-d H:i') }}</div>
              </div>
              <div class="post_text">{!! nl2br(e($post->post)) !!}</div>
              <!-- 改行を <br> に変えて、HTMLとして出力 -->
            </div>
            <!-- 投稿の編集・削除ボタン（ログインユーザーのみ、自分のだけ編集可能） -->
            @if(Auth::id() === $post->user_id)
              <div class="post_actions">
                <!-- 編集ボタン（モーダルを開く） -->
                <button type="button" class="edit_btn" data-post-id="{{ $post->id }}" data-post-content="{{ $post->post }}">
                  <img src="{{ asset('images/edit.png') }}" alt="編集">
                </button>
                <!-- 削除ボタン -->
                <form method="POST" action="{{ route('posts.destroy', $post->id) }}" onsubmit="return confirm('この投稿を削除します。よろしいでしょうか？')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="delete_btn">
                    <img src="{{ asset('images/trash.png') }}" alt="削除" class="trash_icon">
                  </button>
                </form>
              </div>
            @endif
          </li>
        @endforeach
      </ul>
    </div>
  </div>
  <!-- 編集モーダル -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <form method="POST" id="editForm">
        @csrf
        @method('PUT')
        <textarea name="post" id="editPostContent" class="edit_input" maxlength="150" required></textarea>
        <input type="hidden" id="editPostId" name="post_id">
        <!-- 保存ボタン（画像ボタンに変更） -->
        <div class="edit_buttons">
          <button type="submit" class="update_btn">
            <img src="{{ asset('images/edit.png') }}" alt="保存">
          </button>
        </div>

      </form>
    </div>
  </div>


  <script src="{{ asset('js/script.js') }}"></script>

</x-login-layout>
