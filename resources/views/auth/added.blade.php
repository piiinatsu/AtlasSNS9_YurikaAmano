<x-logout-layout>

<link rel="stylesheet" href="{{ asset('css/added.css') }}">

<div class="background">
  <!-- ロゴとサブタイトル -->
  <div class="logo-container">
    <img src="{{ asset('images/atlas.png') }}" alt="Atlas Logo" class="logo">
    <h2 class="subtitle">Social Network Service</h2>
  </div>

  <!-- 登録完了メッセージ -->
  <section class="added-section">
    <h2 class="welcome-message">{{ $username }}さん</h2>
    <p>ようこそ！AtlasSNSへ！</p>
    <p>ユーザー登録が完了しました。</p>
    <p>早速ログインをしてみましょう。</p>

    <div class="login-link-container">
      <a href="{{ route('login') }}" class="btn-login">ログイン画面へ</a>
    </div>
  </section>
</div>

</x-logout-layout>
