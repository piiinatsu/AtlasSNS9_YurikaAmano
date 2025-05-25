<x-login-layout>
  <h1>プロフィール編集</h1>

  <!-- 成功メッセージ -->
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form class="profile_form" action="{{ route('users.updateProfile') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label class="form_label">ユーザー名</label>
    <input class="form_input" type="text" name="username" value="{{ old('username', $user->username) }}">
    @error('username')
      <div class="error">{{ $message }}</div>
    @enderror

    <label class="form_label">メールアドレス</label>
    <input type="text" name="mail" value="{{ old('mail', $user->email) }}">
    @error('mail')
      <div class="error">{{ $message }}</div>
    @enderror

    <label class="form_label">新しいパスワード(変更しない場合は空)</label>
    <input type="password" name="newPassword">
    @error('newPassword')
      <div class="error">{{ $message }}</div>
    @enderror

    <label class="form_label">パスワード再入力</label>
    <input type="password" name="newPassword_confirmation">

    <label class="form_label">自己紹介(bio)</label>
    <textarea class="form_textarea" name="bio">{{ old('bio', $user->bio) }}</textarea>
    @error('bio')
      <div class="error">{{ $message }}</div>
    @enderror

    <label class="form_label">アイコン画像</label>
    <input type="file" name="iconImage">
    @error('iconImage')
      <div class="error">{{ $message }}</div>
    @enderror

    <button class="submit_button" type="submit">更新</button>
  </form>
</x-login-layout>
