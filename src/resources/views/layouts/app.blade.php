<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PiGLy')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- 各画面専用CSS --}}
    @yield('css')
</head>

<body class="layout">
    <main class="layout__container">
        @yield('content')
    </main>
</body>
</html>
