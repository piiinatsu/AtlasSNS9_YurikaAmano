<x-logout-layout>

<link rel="stylesheet" href="{{ asset('css/register.css') }}">

<div class="background">
    <!-- ロゴとサブタイトル -->
    <div class="logo-container">
        <img src="{{ asset('images/atlas.png') }}" alt="Atlas Logo" class="logo">
        <h2 class="subtitle">Social Network Service</h2>
    </div>

    <!-- 新規登録フォーム -->
    <section class="register-section">
        <h2 class="welcome-message">新規ユーザー登録</h2>
        {!! Form::open(['url' => route('register')]) !!}
        @csrf

        <!-- ユーザー名入力 -->
        <div class="form-group">
            {{ Form::label('username', 'ユーザー名', ['class' => 'form-label']) }}
            {{ Form::text('username', null, ['class' => 'input', 'placeholder' => 'ユーザー名を入力']) }}
        </div>

        <!-- メールアドレス入力 -->
        <div class="form-group">
            {{ Form::label('email', 'メールアドレス', ['class' => 'form-label']) }}
            {{ Form::email('email', null, ['class' => 'input', 'placeholder' => 'メールアドレスを入力']) }}
        </div>

        <!-- パスワード入力 -->
        <div class="form-group">
            {{ Form::label('password', 'パスワード', ['class' => 'form-label']) }}
            {{ Form::password('password', ['class' => 'input', 'placeholder' => 'パスワードを入力']) }}
        </div>

        <!-- パスワード確認 -->
        <div class="form-group">
            {{ Form::label('password_confirmation', 'パスワード確認', ['class' => 'form-label']) }}
            {{ Form::password('password_confirmation', ['class' => 'input', 'placeholder' => 'パスワードを再入力']) }}
        </div>

        <!-- 登録ボタン -->
        <div class="form-group register-button-container">
            {{ Form::submit('新規登録', ['class' => 'btn-submit']) }}
        </div>

        <p class="login-link">
            <a href="{{ route('login') }}">ログイン画面へ戻る</a>
        </p>

        {!! Form::close() !!}
    </section>
</div>

</x-logout-layout>
