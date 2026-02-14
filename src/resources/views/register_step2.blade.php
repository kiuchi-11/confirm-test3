@extends('layouts.app')

@section('title', 'STEP2初期目標体重登録')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register">
    <div class="register__card">

        <h1 class="register__logo">PiGLy</h1>
        <h2 class="register__title">新規会員登録</h2>
        <p class="register__step">STEP2 体重データの入力</p>

        <form method="POST" action="{{ route('register.step2.post') }}" class="register__form">
            @csrf
            <div class="register__group">
                <label class="register__label">現在の体重</label>
                <div class="register__input-wrap">
                    <input type="text" name="weight" class="register__input" placeholder="現在の体重を入力" value="{{ old('weight') }}">
                    <span>kg</span>
                </div>
                @error('weight')
                    <p class="error">{{ $message }}</p>
                @enderror

            <div class="register__group">
                <label class="register__label">目標の体重</label>
                <div class="register__input-wrap">
                    <input type="text" name="target_weight" class="register__input" placeholder="目標の体重を入力" value="{{ old('target_weight') }}">
                    <span>kg</span>
                </div>
                @error('target_weight')
                    <p class="error">{{ $message }}</p>
                @enderror

            <button type="submit" class="register__button">
                アカウント作成
            </button>

        </form>

    </div>
</div>
@endsection
