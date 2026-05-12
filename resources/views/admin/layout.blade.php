<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-shell">
    <aside class="admin-sidebar">
        <div>
            <div class="admin-brand">LuxeCurtain Hub</div>
            <div class="admin-subtitle">Administration</div>
        </div>
        <nav class="admin-nav">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.index', 'products') }}">Products</a>
            <a href="{{ route('admin.index', 'blog-posts') }}">Blog Posts</a>
            <a href="{{ route('admin.index', 'success-stories') }}">Success Stories</a>
            <a href="{{ route('admin.index', 'site-images') }}">Site Images</a>
            <a href="{{ route('admin.index', 'orders') }}">Orders</a>
            <a href="{{ route('admin.index', 'consultations') }}">Consultations</a>
        </nav>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="admin-logout">Logout</button>
        </form>
    </aside>

    <main class="admin-main">
        @yield('content')
    </main>
</body>
</html>
