@extends('layouts.app')

@section('title', 'ログイン画面')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/login.css')  }}">
@endsection

@section('content')

<body class="auth-bg">
    <div class="card">
        <h1 class="logo">PiGLy</h1>
        <h2 class="title">ログイン</h2>
        <form method="POST" action="{{ route('login.store') }}" novalidate>
            @csrf
            <div class="form-group">
                <label class="label">メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力">
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="label">パスワード</label>
                <input type="password" name="password" placeholder="パスワードを入力">
                @error('password')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">ログイン</button>
        </form>

        <a href="{{ route('register') }}" class="login-link">アカウント作成はこちら</a>
    </div>
</body>