<x-logout-layout>

  <!-- 適切なURLを入力してください -->
  {!! Form::open(['url' => route('login')]) !!}
  @csrf <!-- CSRFトークンを追加 -->

  <p>AtlasSNSへようこそ</p>

  {{ Form::label('email') }}
  {{ Form::text('email',null,['class' => 'input']) }}
  {{ Form::label('password') }}
  {{ Form::password('password',['class' => 'input']) }}

  {{ Form::submit('ログイン') }}

  <p><a href="{{ route('register') }}">新規ユーザーの方はこちら</a></p>

  {!! Form::close() !!}

</x-logout-layout>
