<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PiGLy')</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    {{-- 各画面専用CSS --}}
    @yield('css')
</head>

<body>
    <div class="header">
        <div class="logo">PiGLy</div>

        <div class="header-buttons">
            <a href="{{ route('target.edit') }}" class="btn">目標体重設定</a>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button>ログアウト</button>
        </form>
    </div>
        </div>
    </div>
    <main>
        @yield('content')
    </main>
</body>
</html>
