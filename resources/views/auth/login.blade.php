<!-- LaravelのBladeコンポーネントである -->
<!-- ファイルは、resources/views/layouts/logout.blade.php に保存されている。 -->
<!-- 子コンテンツ（フォームや見出し）を $slot に挿入して、動的にHTMLを生成する。 -->
<x-logout-layout>

<!-- asset() は「公開フォルダ（public/）」の中身を指す便利な関数！ -->
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="background">
  <!-- ロゴとサブタイトル -->
  <div class="logo-container">
    <img src="{{ asset('images/atlas.png') }}" alt="Atlas Logo" class="logo">
    <h2 class="subtitle">Social Network Service</h2>
  </div>

  <!-- ログインフォーム -->
  <section class="login-section">
    <h1 class="welcome-message">AtlasSNSへようこそ</h1>

    {!! Form::open(['url' => route('login')]) !!}
    <!-- <form method="POST" action="http://127.0.0.1:8000/login"> -->
    @csrf
    <!-- <input type="hidden" name="_token" value="ランダムなトークン"> -->

    <!-- メールアドレス入力 -->
    <div class="form-group">
      {{ Form::label('email', 'メールアドレス', ['class' => 'form-label']) }}
      {{ Form::text('email', null, ['class' => 'input', 'placeholder' => 'メールアドレスを入力']) }}
    </div>

    <!-- パスワード入力 -->
    <div class="form-group">
      {{ Form::label('password', 'パスワード', ['class' => 'form-label']) }}
      {{ Form::password('password', ['class' => 'input', 'placeholder' => 'パスワードを入力']) }}
    </div>

    @if ($errors->any())
    <div class="error-messages">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <!-- ログインボタン -->
    <div class="form-group login-button-container">
      {{ Form::submit('ログイン', ['class' => 'btn-submit']) }}
    </div>

    <p class="register-link">
      <a href="{{ route('register') }}">新規ユーザーの方はこちら</a>
    </p>

    {!! Form::close() !!}
  </section>
</div>

</x-logout-layout>
