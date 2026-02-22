@extends('layouts.header')

@section('title', '目標体重変更画面')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/target.css')  }}">
@endsection

@section('content')
<div class="container">
    <div class="setting-form">
        <h2 class="form-title">目標体重設定</h2>
        <form action="{{ route('goal.update') }}" method="POST">
            @csrf
            <input type="text" name="target_weight"
                value="{{ old('target_weight', $target->target_weight ?? '') }}">
            <span>kg</span>

            <p class="error">
                @error('target_weight')
                {{ $message }}
                @enderror
            </p>

            <a href="/weight_logs">戻る</a>
            <button type="submit">更新</button>
        </form>
    </div>
</div>
@endsection