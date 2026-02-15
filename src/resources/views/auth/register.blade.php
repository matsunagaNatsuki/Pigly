@extends('layouts.app')

@section('title', '会員登録画面')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/register.css')  }}">
@endsection

@section('content')

<body class="auth-bg">
    <div class="card">
        <h1 class="logo">PiGLy</h1>
        <h2 class="title">新規会員登録</h2>
        <p class="step">STEP1 アカウント情報の登録</p>

        <form method="POST" action="{{ route('register.store') }}" novalidate>
            @csrf
            <div class="form-group">
                <label class="label">お名前</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="名前を入力">
                @error('name')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

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

            <button type="submit" class="btn">次に進む</button>
        </form>

        <a href="{{ route('login') }}" class="login-link">ログインはこちら</a>
    </div>
</body>