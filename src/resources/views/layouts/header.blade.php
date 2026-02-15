<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/header.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    @yield('css')
</head>
<header class="header">
    <h1 class="header_logo">PiGLy</h1>
    <ul class="nav">
        <li><a href="/wight_logs/goal_setting" class="setting_icon">目標体重設定</a></li>
        @if(Auth::check())
            <li>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="header__logout">ログアウト</button>
                </form>
            </li>
        @endif
    </ul>
</header>

<body>
    @yield('content')
</body>

</html>