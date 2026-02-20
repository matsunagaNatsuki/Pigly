@extends('layouts.header')

@section('title', '体重管理画面')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/index.css')  }}">
@endsection

@section('content')
<div class="container">
    <!-- データ追加のボタンを押下するとモーダルウィンドが表示される -->
    <dialog id="modal" class="modal">
        <div class="modal-card">
            <h2 class="modal-title">Weight Logを追加</h2>
            <form action="/weight_logs/create" method="POST">
                @csrf
                <div class="form-group">
                    <label>日付 <span class="required">必須</span></label>
                    <input type="date" name="date" class="date" value="{{ old('date', date('Y-m-d')) }}">
                    <p class="error">@error('date'){{ $message }}@enderror</p>
                </div>

                <div class="form-group">
                    <label>体重 <span class="required">必須</span></label>
                    <div class="input-unit">
                        <input type="text" name="weight" placeholder="50.0" value="{{ old('weight') }}">
                        <span>kg</span>
                    </div>
                    <p class="error">
                        @error('weight')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="form-group">
                    <label>摂取カロリー <span class="required">必須</span></label>
                    <div class="input-unit">
                        <input type="text" name="calories" placeholder="1200" value="{{ old('calorie') }}">
                        <span>cal</span>
                    </div>
                    <p class="error">
                        @error('calorie')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="form-group">
                    <label>運動時間 <span class="required">必須</span></label>
                    <input type="time" name="exercise_time" value="{{ old('exercise_time') }}">
                    <p class="error">
                        @error('exercise_time')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="form-group">
                    <label>運動内容</label>
                    <textarea name="exercise_content" placeholder="運動内容を追加">{{ old('exercise_content') }}</textarea>
                    <p class="error">
                        @error('exercise_content')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="modal-buttons">
                    <button type="button" class="btn-back" onclick="closeModal()">戻る</button>
                    <button type="submit" class="btn-submit">登録</button>
                </div>
            </form>

        </div>
    </dialog>
    <!-- 上部ステータス -->
    <div class="status-box">
        <div class="status-item">
            <p>目標体重</p>
            <h2>{{ $target->target_weight}} kg</h2>
        </div>
        <div class="status-item">
            <p>目標まで</p>
            <h2>
                @if($logs->count() > 0 && $target)
                {{ number_format($logs->first()->weight - $target->target_weight, 1) }} kg
                @else
                ---
                @endif
            </h2>
        </div>
        <div class="status-item">
            <p>最新体重</p>
            <h2>
                <h2>
                    @if($latestLog)
                    {{ number_format($latestLog->weight, 1) }} kg
                    @endif
                </h2>
            </h2>
        </div>
    </div>
    <div class="weight-data">
        <!-- 検索 -->
        <form action="/weight_logs/search" method="GET" class="search-box">
            <input type="date" name="from" value="{{ request('from') }}">
            <span>〜</span>
            <input type="date" name="to" value="{{ request('to') }}">
            <button class="btn">検索</button>

            @if(request('from') || request('to'))
            <a href="/weight_logs" class="reset">リセット</a>
            @endif

            <button type="button" class="logs_create" onclick="openModal()">データを追加</button>
        </form>

        <!-- 検索件数 -->
        @if(isset($request_from) || isset($request_to))
        <p class="search-result">
            @if(request('from') && request('to'))
            {{ $request_from ?? '---' }} 〜 {{ $request_to ?? '---' }} の検索結果
            @endif

            @if($logs->total() > 0)
            {{ $logs->total() }}件
            @else
            0件
            @endif
        </p>
        @endif

        <!-- 一覧 -->
        @if($logs->count() > 0)
        <table class="log-table">
            <thead>
                <tr>
                    <th>日付</th>
                    <th>体重</th>
                    <th>摂取カロリー</th>
                    <th>運動時間</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr class="hover-row">
                    <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                    <td>{{ number_format($log->weight,1) }}kg</td>
                    <td>{{ $log->calories }}cal</td>
                    <td>{{ $log->exercise_time }}</td>
                    <td class="edit-btn">
                        <a href="/weight_logs/{{ $log->id }}/update">
                            <img src="{{ asset('img/pencil.png') }}" alt="edit" class="pencil-icon">
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- 検索がヒットしなかった時 -->
        @else
        <div class="no-data">
            該当するデータはありません。
        </div>
        @endif

        <!-- ページネーション -->
        <div class="pagination">
            {{ $logs->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('modal');
            window.openModal = function() {
                modal.style.display = 'block';
                modal.showModal();
            }
            window.closeModal = function() {
                modal.close();
                modal.style.display = 'none';
            }
        });
    </script> @if($errors->any()) <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('modal');
            modal.style.display = 'block';
            modal.showModal();
        });
    </script>
    @endif
    @endsection