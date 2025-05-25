<x-logout-layout>

<link rel="stylesheet" href="{{ asset('css/added.css') }}">

<div class="background">
  <!-- ロゴとサブタイトル -->
  <div class="logo_container">
    <img src="{{ asset('images/atlas.png') }}" alt="Atlas Logo" class="logo">
    <h1 class="subtitle">Social Network Service</h1>
  </div>

  <!-- 登録完了メッセージ -->
  <section class="added_section">
    <h2 class="welcome_message">{{ request()->query('username', 'ゲスト') }}さん</h2>
    <p>ようこそ！AtlasSNSへ！</p>
    <br/>
    <p>ユーザー登録が完了いたしました。</p>
    <p>早速ログインをしてみましょう！</p>

    <div class="login_link_container">
      <a href="{{ route('login') }}" class="btn_login">ログイン画面へ</a>
    </div>
  </section>
</div>

</x-logout-layout>
