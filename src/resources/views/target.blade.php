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
            <div class="input-container">
                <input type="text" name="target_weight" class="input" value="{{ old('target_weight', $target->target_weight ?? '') }}">
                <span>kg</span>
            </div>

            <p class="error">
                @error('target_weight')
                    {{ $message }}
                @enderror
            </p>

            <div class="buttons">
                <a href="/weight_logs" class="btn-return">戻る</a>
                <button type="submit" class="btn-edit">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection