@extends('layouts.header')

@section('title', '体重管理画面')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/index.css')  }}">
@endsection

@section('content')
<div class="container">
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

            <a href="/weight_logs/create" class="logs_create">データを追加</a>
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
    @endsection