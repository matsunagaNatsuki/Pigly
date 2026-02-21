@extends('layouts.header')

@section('title', '情報更新画面')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/edit.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>Weight Log</h2>

    <form method="POST" action="{{ route('weight_logs.update', $weightLogId->id) }}" novalidate>
        @csrf
        @method('PUT')

        <!-- 日付 -->
        <div class="form-group">
            <label>日付</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $weightLogId->date) }}">
            @error('date')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- 体重 -->
        <div class="form-group">
            <label>体重</label>
            <div class="input-container">
                <input type="text" name="weight" class="form-control" value="{{ old('weight', $weightLogId->weight) }}" placeholder="例: 50.5">
                <span>kg</span>
            </div>
            @error('weight')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- 摂取カロリー -->
        <div class="form-group">
            <label>摂取カロリー</label>
            <div class="input-container">
                <input type="text" name="calories" class="form-control" value="{{ old('calories', $weightLogId->calories) }}">
                <span>cal</span>
            </div>
            @error('calories')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- 運動時間 -->
        <div class="form-group">
            <label>運動時間 (分)</label>
            <input type="time" name="exercise_time" class="form-control" value="{{ old('exercise_time', $weightLogId->exercise_time) }}">
            @error('exercise_time')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- 運動内容 -->
        <div class="form-group">
            <label>運動内容</label>
            <textarea name="exercise_content" class="form-control" maxlength="120" placeholder="運動内容を追加">{{ old('exercise_content', $weightLogId->exercise_content) }}</textarea>
            @error('exercise_content')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- ボタン -->
        <div class="buttons">
            <a href="/weight_logs" class="btn-return">戻る</a>
            <button type="submit" class="btn-edit">更新</button>
        </div>
    </form>

    <!-- ゴミ箱ボタン -->
    <form method="POST" action="{{ route('weight_logs.destroy', $weightLogId->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">
            <img src="{{ asset('img/delete.png') }}" alt="edit" class="delete">
        </button>
    </form>
</div>
@endsection