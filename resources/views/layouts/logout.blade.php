<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!--IEブラウザ対策-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="AtlasSNS" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AtlasSNS</title>

        <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/logout.css') }} ">
        <!--スマホ,タブレット対応-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--サイトのアイコン指定-->
        <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
        <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
        <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
        <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
        <!--iphoneのアプリアイコン指定-->
        <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    </head>
    <body>
        @if(Request::is('auth/login') || Request::is('auth/register') || Request::is('auth/added'))
        <!-- ログインや登録ページではヘッダーを非表示 -->
        @else
        <header>
            <h1><img src="{{ asset('images/atlas.png') }}" alt="Atlas Logo"></h1>
            <p>Social Network Service</p>
        </header>
        @endif
        <div id="container">
            {{ $slot }}
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
