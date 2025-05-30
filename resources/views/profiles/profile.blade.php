<x-login-layout>
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

  <div class="profile_container">
    @php
      $iconPath = $user->icon_image
        ? (\Illuminate\Support\Str::startsWith($user->icon_image, 'images/')
            ? 'storage/' . $user->icon_image
            : 'storage/images/' . $user->icon_image)
        : 'images/default-icon.png';
    @endphp

    @if (Auth::id() === $user->id)
    <!-- 自分のプロフィール画像も表示 -->
      <div class="profile_image">
        <img src="{{ asset($iconPath) }}" alt="アイコン画像" class="user_icon">
      </div>
      <!-- 自分のプロフィール（編集可能） -->
      <form action="{{ route('users.updateProfile') }}" method="POST" enctype="multipart/form-data" class="profile_form">
        @csrf
        @method('POST')

        <!-- ユーザー名 -->
        <div class="form_group">
          <label for="username">user name</label>
          <input type="text" name="username" id="username" value="{{ $user->username }}" required>
        </div>

        <!-- メールアドレス -->
        <div class="form_group">
          <label for="mail">mail address</label>
          <input type="email" name="mail" id="mail" value="{{ $user->email }}" required>
        </div>

        <!-- パスワード -->
        <div class="form_group">
          <label for="newPassword">password</label>
          <input type="password" name="newPassword" id="newPassword" placeholder="変更する場合のみ入力">
        </div>

        <!-- パスワード確認 -->
        <div class="form_group">
          <label for="newPassword_confirmation">password confirm</label>
          <input type="password" name="newPassword_confirmation" id="newPassword_confirmation" placeholder="新しいパスワードを確認のため入力">
        </div>

        <!-- 自己紹介 -->
        <div class="form_group">
          <label for="bio">bio</label>
          <textarea name="bio" id="bio" rows="3">{{ $user->bio }}</textarea>
        </div>

        <!-- アイコン画像 -->
        <div class="form_group">
          <label for="iconImage">icon image</label>
          <input type="file" name="iconImage" id="iconImage">
        </div>

        <!-- 更新ボタン -->
        <div class="update_button_container">
          <button type="submit" class="btn btn-danger">更新</button>
        </div>
      </form>

    @else
      <!-- 他人のプロフィール（編集不可） -->
      <div class="profile_view">
        <img src="{{ asset($iconPath) }}" alt="アイコン画像" class="user_icon">
        <p><strong>name</strong> {{ $user->username }}</p>
        <p><strong>bio</strong> {{ $user->bio }}</p>

        <!-- フォロー or フォロー解除 -->
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
    @endif
  </div>
</x-login-layout>
