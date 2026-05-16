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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Cormorant+Garamond:wght@300;400;600&display=swap" rel="stylesheet">
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
        <div class="header-shell">
            <a class="brand" href="{{ route('home') }}" aria-label="LuxeCurtain Hub home">LuxeCurtain Hub</a>
            <nav class="nav-main" aria-label="Primary navigation">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'nav-link--active' : '' }}">Home</a>
                <a href="{{ route('products') }}" class="nav-link {{ request()->routeIs('products') ? 'nav-link--active' : '' }}">Products</a>
                <a href="{{ route('home') }}#signature" class="nav-link">Collection</a>
                <a href="{{ route('home') }}#contact" class="nav-link">Contact</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="footer-wrapper">
            <div class="footer-shell">
                <div class="footer-col">
                    <h4 class="footer-title">Explore</h4>
                    <ul class="footer-list">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('products') }}">Products</a></li>
                        <li><a href="{{ route('home') }}#signature">Collection</a></li>
                        <li><a href="{{ route('home') }}#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4 class="footer-title">Contact</h4>
                    <p class="footer-item"><a href="mailto:arrindamark@gmail.com">arrindamark@gmail.com</a></p>
                    <p class="footer-item"><a href="tel:+256772513055">+256 772 513 055</a></p>
                    <p class="footer-item">Kampala, Uganda</p>
                </div>

                <div class="footer-col">
                    <h4 class="footer-title">About</h4>
                    <p class="footer-desc">Premium curtain styling, bespoke fittings, and measured installations for homes and commercial spaces across Uganda.</p>
                </div>
            </div>

            <div class="footer-bottom">
                <div>
                    <p class="footer-brand">LUXECURTAIN HB</p>
                    <p class="footer-tagline">Premium Curtain Collections · Uganda</p>
                </div>
                <p class="footer-copyright">© 2026 LuxeCurtain Hub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <div class="image-modal" id="image-modal" aria-hidden="true">
        <div class="image-modal__backdrop" data-modal-close></div>
        <div class="image-modal__panel" role="dialog" aria-modal="true" aria-labelledby="image-modal-title">
            <button class="image-modal__close" type="button" data-modal-close aria-label="Close details">×</button>
            <button class="image-modal__nav image-modal__nav--prev" type="button" id="image-modal-prev" aria-label="Previous image">‹</button>
            <button class="image-modal__nav image-modal__nav--next" type="button" id="image-modal-next" aria-label="Next image">›</button>
            <div class="image-modal__media">
                <img id="image-modal-img" src="" alt="">
                <div class="image-modal__count" id="image-modal-count"></div>
            </div>
            <div class="image-modal__content">
                <p class="image-modal__eyebrow" id="image-modal-kicker"></p>
                <h3 id="image-modal-title"></h3>
                <p class="image-modal__category" id="image-modal-category"></p>
                <p class="image-modal__desc" id="image-modal-desc"></p>
                <div class="image-modal__actions">
                    <button class="image-modal__request" type="button" id="image-modal-request">Request this style</button>
                    <a class="image-modal__link" href="#contact">Go to consultation</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
