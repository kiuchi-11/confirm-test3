@extends('layouts.app')

@section('title', 'ログイン | PiGLy')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register">
    <div class="register__card">

        <h1 class="register__logo">PiGLy</h1>
        <h2 class="register__title">ログイン</h2>

        <form method="POST" action="{{ route('login.post') }}" class="register__form" novalidate>
            @csrf

            <div class="register__group">
                <label class="register__label">メールアドレス</label>
                <input type="email" name="email" class="register__input" placeholder="メールアドレスを入力" value="{{ old('email') }}">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="register__group">
                <label class="register__label">パスワード</label>
                <input type="password" name="password" class="register__input" placeholder="パスワードを入力">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="register__button">
                ログイン
            </button>

        </form>

        <p class="register__link">
            <a href="{{ route('register.step1') }}">アカウント作成はこちら</a>
        </p>

    </div>
</div>
@endsection
