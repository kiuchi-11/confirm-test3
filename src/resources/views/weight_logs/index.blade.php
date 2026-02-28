@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs.css') }}">
@endsection

@section('content')

<div class="container">

    {{-- ===== サマリー ===== --}}
    <div class="summary-box">
        <div class="summary-item">
            <p>目標体重</p>
            <h2>
                {{ optional($target)->target_weight ?? '0.0' }}
                <span class="unit">kg</span>
            </h2>
        </div>

        <div class="summary-item">
            <p>目標まで</p>
            <h2>
                {{ $difference ?? '0.0' }}
                <span class="unit">kg</span>
            </h2>
        </div>

        <div class="summary-item">
            <p>最新体重</p>
            <h2>
                {{ $latestWeight ?? '0.0' }}
                <span class="unit">kg</span>
            </h2>
        </div>
    </div>

    <div class="card">
        {{-- ===== 検索 ===== --}}
        <form method="GET" action="{{ route('weight_logs.index') }}" class="search-box">
            <input type="date" name="from" value="{{ request('from') }}">
            〜
            <input type="date" name="to" value="{{ request('to') }}">

            <button type="submit" class="search-btn">検索</button>

            @if(request('from') || request('to'))
            <a href="{{ route('weight_logs.index') }}" class="reset">リセット</a>
            @endif

            {{-- モーダル起動ボタン --}}
            <a href="#createModal" class="add-btn">
                データ追加
            </a>
        </form>


        {{-- ===== 検索結果表示 ===== --}}
        @if(request('from') && request('to'))
            <p>
                {{ request('from') }} 〜 {{ request('to') }} の検索結果
                {{ $weightLogs->total() }}件
            </p>
        @endif


        {{-- ===== 一覧テーブル ===== --}}
        <table>
            <thead>
            <tr>
                <th>日付</th>
                <th>体重</th>
                <th>食事摂取カロリー</th>
                <th>運動時間</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @forelse($weightLogs as $log)
                <tr class="hover-row">
                    <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                    <td>{{ number_format($log->weight, 1) }}kg</td>
                    <td>{{ $log->calories }}cal</td>
                    <td>{{ sprintf('%02d:%02d', floor($log->exercise_time / 60), $log->exercise_time % 60) }}</td>
                    <td>
                        <a href="{{ route('weight_logs.edit', $log->id) }}" class="edit-btn">
                            ✏️
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">データがありません</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{-- ページネーション --}}
        <div class="pagination-wrapper">
            {{ $weightLogs->links('pagination::default') }}
        </div>
    </div>
</div>


{{--モーダル--}}
<div id="createModal" class="modal-overlay">

    <div class="modal">

        <h2 class="modal__title">Weight Logを追加</h2>

        <form method="POST" action="{{ route('weight_logs.store') }}">
            @csrf

            {{-- 日付 --}}
            <div class="form-group">
                <label>日付</label>
                <input type="date" name="date"
                       value="{{ old('date', date('Y-m-d')) }}">
                @error('date') <p class="error">{{ $message }}</p> @enderror
            </div>

            {{-- 体重 --}}
            <div class="form-group">
                 <label>体重</label>
                <div class="input-unit">
                    <input type="text" name="weight" value="{{ old('weight') }}">
                    <span class="unit">kg</span>
                </div>
                @error('weight') <p class="error">{{ $message }}</p> @enderror
            </div>

            {{-- 摂取カロリー --}}
            <div class="form-group">
                <label>摂取カロリー</label>
                <div class="input-unit">
                    <input type="text" name="calories" value="{{ old('calories') }}">
                    <span class="unit">kcal</span>
                </div>
                @error('calories') <p class="error">{{ $message }}</p> @enderror
            </div>

            {{-- 運動時間 --}}
            <div class="form-group">
                <label>運動時間</label>
                <input type="text" name="exercise_time" value="{{ old('exercise_time') }}">
                @error('exercise_time') <p class="error">{{ $message }}</p> @enderror
            </div>

            {{-- 運動内容 --}}
            <div class="form-group">
                <label>運動内容</label>
                <textarea name="exercise_content"
                          maxlength="120">{{ old('exercise_content') }}</textarea>
                @error('exercise_content') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="modal-buttons">
                <a href="{{ route('weight_logs.index') }}" class="cancel">戻る</a>
                <button type="submit" class="btn-submit">登録</button>
            </div>

        </form>

    </div>
</div>

@if($errors->any())
<style>
#createModal {
    display: flex !important;
}
</style>
@endif

@endsection