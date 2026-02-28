@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_target.css') }}">
@endsection

@section('content')

<div class="target-wrapper">

    <div class="target-card">

        <h2 class="card-title">目標体重設定</h2>

        <form method="POST" action="{{ route('weight_target.update') }}">
            @csrf
            @method('PUT')

            <div class="form-row">
                <input type="text"
                       name="target_weight"
                       class="weight-input"
                       value="{{ old('target_weight', $target->target_weight ?? '') }}">
                <span class="unit">kg</span>
            </div>

            @error('target_weight')
                <p class="error">{{ $message }}</p>
            @enderror

            <div class="buttons">
                <a href="{{ route('weight_logs.index') }}" class="btn-cancel">
                    戻る
                </a>

                <button type="submit" class="btn-submit">
                    更新
                </button>
            </div>

        </form>

    </div>

</div>

@endsection