<x-login-layout>
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

  <div class="profile_container">
    @php
      $iconPath = $user->icon_image
        ? 'images/' . $user->icon_image
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
          <label for="username">ユーザー名</label>
          <div class="center-wrapper">
            <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required>
        </div>
          @error('username')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>

        <!-- メールアドレス -->
        <div class="form_group">
          <label for="mail">メールアドレス</label>
          <div class="center-wrapper">
            <input type="email" name="mail" id="mail" value="{{ old('mail', $user->email) }}" required>
          </div>
          @error('mail')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>

        <!-- パスワード -->
        <div class="form_group">
          <label for="newPassword">パスワード</label>
          <div class="center-wrapper">
            <input type="password" name="newPassword" id="newPassword">
          </div>
          @error('newPassword')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>

        <!-- パスワード確認 -->
        <div class="form_group">
          <label for="newPassword_confirmation">パスワード確認</label>
          <div class="center-wrapper">
            <input type="password" name="newPassword_confirmation" id="newPassword_confirmation" placeholder="新しいパスワードを確認のため入力">
          </div>
            @error('newPassword_confirmation')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>

        <!-- 自己紹介 -->
        <div class="form_group">
          <label for="bio">自己紹介</label>
          <div class="center-wrapper">
            <textarea name="bio" id="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
          </div>
          @error('bio')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>

        <!-- アイコン画像 -->
        <div class="form_group">
          <label for="iconImage">アイコン画像</label>
          <div class="center-wrapper">
            <input type="file" name="iconImage" id="iconImage" class="center-input">
          </div>
          @error('iconImage')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>

        <!-- 更新ボタン -->
        <div class="form_group_centered">
          <div class="center-wrapper full-width">
            <button type="submit" class="btn btn-danger">更新</button>
          </div>
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
