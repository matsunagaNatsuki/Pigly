@extends('layouts.app')

@section('title', '初期体重登録画面')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/register_step2.css') }}">
@endsection

@section('content')

<body class="auth-bg">
    <div class="card">
        <h1 class="logo">PiGLy</h1>
        <p class="title">新規会員登録</p>
        <p class="step">STEP2 体重データの入力</p>

        <form method="POST" action="{{ route('register.setting') }}" novalidate>
            @csrf
            <div class="form-group">
                <label class="label">現在の体重</label>
                <div class="input-wrap">
                    <input type="text" name="weight" value="{{ old('weight') }}" placeholder="現在の体重を入力">
                    <span class="unit">kg</span>
                </div>
                @error('weight')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="label">目標の体重</label>
                <div class="input-wrap">
                    <input type="text" name="target_weight" value="{{ old('target_weight') }}"  placeholder="目標の体重を入力">
                    <span class="unit">kg</span>
                </div>
                @error('target_weight')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn">アカウント作成</button>
        </form>
    </div>
</body>