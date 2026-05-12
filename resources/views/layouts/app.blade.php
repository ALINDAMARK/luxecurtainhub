<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'LuxeCurtain Hub' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="brand">LuxeCurtain Hub</div>
        <nav>
            <a href="/">Home</a>
            <a href="/products">Products</a>
            <a href="/admin/login">Admin</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <p>Designed for premium curtain collections.</p>
    </footer>

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
