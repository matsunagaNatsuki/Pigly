@extends('layouts.header')

@section('title', '情報更新画面')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/edit.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>体重ログ更新</h2>

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
            <input type="text" name="weight" class="form-control" value="{{ old('weight', $weightLogId->weight) }}" placeholder="例: 50.5">
            @error('weight')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- 摂取カロリー -->
        <div class="form-group">
            <label>摂取カロリー</label>
            <input type="text" name="calories" class="form-control" value="{{ old('calories', $weightLogId->calories) }}">
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
            <textarea name="exercise_content" class="form-control" maxlength="120">{{ old('exercise_content', $weightLogId->exercise_content) }}</textarea>
            @error('exercise_content')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- ボタン -->
        <button type="submit" class="btn btn-primary">更新</button>
        <a href="/weight_logs" class="btn btn-secondary">戻る</a>
    </form>

    <!-- ゴミ箱ボタン -->
    <form method="POST" action="{{ route('weight_logs.destroy', $weightLogId->id) }}" class="mt-2">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">ゴミ箱</button>
    </form>
</div>
@endsection