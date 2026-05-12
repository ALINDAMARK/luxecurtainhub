<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Login' }}</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-login-page">
    <form class="admin-login-card" action="{{ route('admin.login.attempt') }}" method="POST">
        @csrf
        <div class="admin-login-kicker">Admin Access</div>
        <h1>Manage LuxeCurtain Hub</h1>
        <p>Enter the admin key to manage products, articles, orders, stories, and site images.</p>

        <label for="admin_key">Admin Key</label>
        <input id="admin_key" name="admin_key" type="password" placeholder="Enter admin key" value="{{ old('admin_key') }}">
        @error('admin_key')
            <div class="admin-error">{{ $message }}</div>
        @enderror

        <button type="submit" class="admin-button">Enter Dashboard</button>
        <div class="admin-note">Default scaffold key: luxe-curtain-admin unless ADMIN_PANEL_KEY is set.</div>
    </form>
</body>
</html>
