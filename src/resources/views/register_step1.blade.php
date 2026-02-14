@extends('layouts.app')

@section('title', 'STEP1新規会員登録')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register">
    <div class="register__card">

        <h1 class="register__logo">PiGLy</h1>
        <h2 class="register__title">新規会員登録</h2>
        <p class="register__step">STEP1 アカウント情報の登録</p>

        <form class="register__form" method="POST" action="{{ route('register.step1.post') }}" novalidate>
         @csrf
            <div class="register__group">
                <label class="register__label">お名前</label>
                <input type="text" name="name" class="register__input" placeholder="名前を入力" value="{{ old('name') }}">
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

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

            <button class="register__button">
                次に進む
            </button>
        </form>

        <a href="{{ route('login') }}">ログインはこちら</a>

    </div>
</div>
@endsection
