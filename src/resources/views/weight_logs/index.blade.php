@extends('layouts.auth')

@section('content')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs.css') }}">
@endsection


@section('content')
<div class="container">
    <div class="summary-box">
        <div class="summary-item">
            <p>目標体重</p>
            <h2>{{ optional($target)->target_weight }}kg</h2>
        </div>

        <div class="summary-item">
            <p>目標まで</p>
            <h2>{{ $difference }}kg</h2>
        </div>

        <div class="summary-item">
            <p>最新体重</p>
            <h2>{{ $latestWeight }}kg</h2>
        </div>
    </div>

    <form method="GET" class="search-box">
        <input type="date" name="from" value="{{ request('from') }}">
        〜
        <input type="date" name="to" value="{{ request('to') }}">
        <button type="submit">検索</button>

        <button type="submit" class="add-btn">
            データ追加
        </button>

        @if(request('from') && request('to'))
            <a href="{{ route('dashboard') }}">リセット</a>
        @endif
    </form>

    @if(request('from') && request('to'))
        <p>
            {{ request('from') }} 〜 {{ request('to') }} の検索結果
            {{ $weightLogs->total() }}件
        </p>
    @endif

    <!-- 一覧 -->
    <table>
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
        @foreach($weightLogs as $log)
            <tr class="hover-row">
                <td>{{ $log->date->format('Y/m/d') }}</td>
                <td>{{ number_format($log->weight,1) }}kg</td>
                <td>{{ $log->calories }}cal</td>
                <td>{{ gmdate('H:i', $log->exercise_time * 60) }}</td>
                <td>
                    <a href="{{ route('weight.edit', $log->id) }}">
                        ✏️
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
