<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PiGLy')</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- 各画面専用CSS --}}
    @yield('css')
</head>

<body>
    <div class="header">
        <div class="logo">PiGLy</div>

        <div class="header-buttons">
            <a href="{{ route('weight_target.edit') }}" class="btn">
                <i class="fa-solid fa-gear"></i>
                目標体重設定
            </a>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="header-link">
                <i class="fa-solid fa-right-from-bracket"></i>
                ログアウト</button>
        </form>
    </div>
        </div>
    </div>
    <main>
        @yield('content')
    </main>
</body>
</html>
