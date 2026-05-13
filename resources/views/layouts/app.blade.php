<!DOCTYPE html>
<html lang="en-UG">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'LuxeCurtain Hub' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'LuxeCurtain Hub designs and installs premium custom curtains, drapes, blackout panels, and sheer window treatments.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'curtains, custom curtains, drapes, blackout curtains, sheer curtains, curtain installation, Uganda curtains' }}">
    <meta name="theme-color" content="#0d0b09">
    <link rel="canonical" href="{{ $canonicalUrl ?? url()->current() }}">
    <meta name="robots" content="index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1">
    <meta property="og:site_name" content="LuxeCurtain Hub">
    <meta property="og:locale" content="en_UG">
    <meta property="og:title" content="{{ $title ?? 'LuxeCurtain Hub' }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'LuxeCurtain Hub designs and installs premium custom curtains, drapes, blackout panels, and sheer window treatments.' }}">
    <meta property="og:url" content="{{ $canonicalUrl ?? url()->current() }}">
    <meta property="og:type" content="{{ $pageType ?? 'website' }}">
    <meta property="og:image" content="{{ $ogImage ?? 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg' }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'LuxeCurtain Hub' }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? 'LuxeCurtain Hub designs and installs premium custom curtains, drapes, blackout panels, and sheer window treatments.' }}">
    <meta name="twitter:image" content="{{ $ogImage ?? 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg' }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('head')
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Store',
            'name' => 'LuxeCurtain Hub',
            'url' => url('/'),
            'logo' => url('/favicon.ico'),
            'description' => $metaDescription ?? 'LuxeCurtain Hub designs and installs premium custom curtains, drapes, blackout panels, and sheer window treatments.',
            'telephone' => '+256772513055',
            'email' => 'arrindamark@gmail.com',
            'areaServed' => [
                'Uganda',
                'East Africa',
            ],
            'contactPoint' => [[
                '@type' => 'ContactPoint',
                'contactType' => 'customer service',
                'telephone' => '+256772513055',
                'email' => 'arrindamark@gmail.com',
                'areaServed' => 'UG',
                'availableLanguage' => ['English'],
            ]],
            'sameAs' => [],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
</head>
<body>
    <header class="site-header">
        <div class="brand">LuxeCurtain Hub</div>
        <nav class="nav-main">
            <a href="{{ route('home') }}" class="nav-link" data-num="01">Home</a>
            <a href="{{ route('products') }}" class="nav-link" data-num="02">Products</a>
            <a href="{{ route('home') }}#signature" class="nav-link" data-num="03">Collection</a>
            <a href="{{ route('home') }}#contact" class="nav-link" data-num="04">Contact</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <p>Designed for premium curtain collections.</p>
        <p>© 2026 LuxeCurtain Hub · All rights reserved.</p>
    </footer>

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
