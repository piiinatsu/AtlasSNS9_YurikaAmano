<x-logout-layout>

<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="background">
  <div class="logo_container">
    <img src="{{ asset('images/atlas.png') }}" alt="Atlas Logo" class="logo">
    <h1 class="subtitle">Social Network Service</h1>
  </div>
  <!-- ログインフォーム -->
  <section class="login_section">
    <h1 class="welcome_message">AtlasSNSへようこそ</h1>

    {!! Form::open(['url' => route('login')]) !!}
    @csrf

    <!-- メールアドレス入力 -->
    <div class="form_group">
      {{ Form::label('email', 'メールアドレス', ['class' => 'form_label']) }}
      {{ Form::text('email', null, ['class' => 'input']) }}
    </div>

    <!-- パスワード入力 -->
    <div class="form_group">
      {{ Form::label('password', 'パスワード', ['class' => 'form_label']) }}
      {{ Form::password('password', ['class' => 'input']) }}
    </div>

    @if ($errors->any())
    <div class="error_messages">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <!-- ログインボタン -->
    <div class="form_group login_button_container">
      {{ Form::submit('ログイン', ['class' => 'btn_submit']) }}
    </div>

    <p class="register_link">
      <a href="{{ route('register') }}">新規ユーザーの方はこちら</a>
    </p>

    {!! Form::close() !!}
  </section>
</div>

</x-logout-layout>
