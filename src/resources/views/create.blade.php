@extends('layouts.auth')

@section('content')

<div class="modal-wrapper">
    <div class="modal">

        <h2>Weight Logを追加</h2>

        <form method="POST" action="{{ route('weight_logs.store') }}">
            @csrf

            <label>日付</label>
            <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}">

            <label>体重</label>
            <input type="text" name="weight" value="{{ old('weight') }}"> kg

            <label>摂取カロリー</label>
            <input type="text" name="calories" value="{{ old('calories') }}"> cal

            <label>運動時間</label>
            <input type="text" name="exercise_time" placeholder="00:00" value="{{ old('exercise_time') }}">

            <label>運動内容</label>
            <textarea name="exercise_content" maxlength="120">{{ old('exercise_content') }}</textarea>

            <div class="button-area">
                <a href="{{ route('weight_logs.index') }}">戻る</a>
                <button type="submit">登録</button>
            </div>

        </form>

    </div>
</div>

@endsection