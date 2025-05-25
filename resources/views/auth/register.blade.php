<x-logout-layout>

<link rel="stylesheet" href="{{ asset('css/register.css') }}">

<div class="background">
    <!-- ロゴとサブタイトル -->
    <div class="logo_container">
        <img src="{{ asset('images/atlas.png') }}" alt="Atlas Logo" class="logo">
        <h2 class="subtitle">Social Network Service</h2>
    </div>

    <!-- 新規登録フォーム -->
    <section class="register_section">
        <h2 class="welcome_message">新規ユーザー登録</h2>
        <!-- エラーメッセージの表示 -->
        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::open(['url' => route('register')]) !!}
        @csrf

        <!-- ユーザー名入力 -->
        <div class="form_group">
            {{ Form::label('username', 'user name', ['class' => 'form_label']) }}
            {{ Form::text('username', null, ['class' => 'input', 'placeholder' => 'ユーザー名を入力']) }}
        </div>

        <!-- メールアドレス入力 -->
        <div class="form_group">
            {{ Form::label('email', 'mail address', ['class' => 'form_label']) }}
            {{ Form::email('email', null, ['class' => 'input', 'placeholder' => 'メールアドレスを入力']) }}
        </div>

        <!-- パスワード入力 -->
        <div class="form_group">
            {{ Form::label('password', 'password', ['class' => 'form_label']) }}
            {{ Form::password('password', ['class' => 'input', 'placeholder' => 'パスワードを入力']) }}
        </div>

        <!-- パスワード確認 -->
        <div class="form_group">
            {{ Form::label('password_confirmation', 'password confirm', ['class' => 'form_label']) }}
            {{ Form::password('password_confirmation', ['class' => 'input', 'placeholder' => 'パスワードを再入力']) }}
        </div>

        <!-- 登録ボタン -->
        <div class="form_group register_button_container">
            {{ Form::submit('REGISTER', ['class' => 'btn_submit']) }}
        </div>

        <p class="login_link">
            <a href="{{ route('login') }}">ログイン画面へ戻る</a>
        </p>

        {!! Form::close() !!}
    </section>
</div>

</x-logout-layout>
