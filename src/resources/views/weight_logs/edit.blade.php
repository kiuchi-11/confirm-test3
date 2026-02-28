@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs_edit.css') }}">
@endsection

@section('content')

<div class="modal-wrapper">
    <div class="modal">

        {{-- 更新フォーム --}}
        <form method="POST" action="{{ route('weight_logs.update', $weightLog->id) }}" class="weight-form">
            @csrf
            @method('PUT')

            <h2>Weight Log</h2>

            <div class="form-group">
                <label>日付</label>
                <input type="date" name="date"
                       value="{{ old('date', \Carbon\Carbon::parse($weightLog->date)->format('Y-m-d')) }}">
            </div>

            <div class="form-group">
                <label>体重</label>
                <div class="input-unit">
                    <input type="text" name="weight"
                           value="{{ old('weight', $weightLog->weight) }}">
                    <span>kg</span>
                </div>
            </div>

            <div class="form-group">
                <label>摂取カロリー</label>
                <div class="input-unit">
                    <input type="text" name="calories"
                           value="{{ old('calories', $weightLog->calories) }}">
                    <span>cal</span>
                </div>
            </div>

            <div class="form-group">
                <label>運動時間</label>
                <input type="text" name="exercise_time"
                       value="{{ old('exercise_time', $weightLog->exercise_time) }}">
            </div>

            <div class="form-group">
                <label>運動内容</label>
                <textarea name="exercise_content">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
            </div>

            <div class="modal__actions">
                <a href="{{ route('weight_logs.index') }}" class="cancel">戻る</a>
                <button type="submit" class="submit">更新</button>
            </div>

        </form>

    </div>
</div>

@endsection