@extends('layouts.app')

@push('head')
<style>
body {
    background:
        radial-gradient(circle at top, rgba(184,148,90,.14), transparent 28%),
        linear-gradient(180deg, #f6efe7 0%, #f1e8dd 100%);
}

.page-shell {
    width: min(1180px, calc(100% - 2rem));
    margin: 0 auto;
}

.hero {
    display: grid;
    grid-template-columns: 1.05fr .95fr;
    gap: 2rem;
    align-items: center;
    padding: 3.5rem 0 2rem;
}

.hero-copy {
    padding: 1rem 0;
}

.eyebrow {
    text-transform: uppercase;
    letter-spacing: .24em;
    color: #8a5a44;
    font-size: .72rem;
    margin-bottom: 1rem;
}

.hero h1 {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(3rem, 6vw, 5.8rem);
    line-height: .95;
    margin: 0;
    color: #1f1a17;
}

.hero .lead {
    margin-top: 1.25rem;
    max-width: 34rem;
    font-size: 1.08rem;
    line-height: 1.8;
    color: #5b4a40;
}

.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: .9rem;
    margin-top: 1.5rem;
}

.cta {
    display: inline-block;
    text-decoration: none;
    border-radius: 999px;
    padding: .95rem 1.35rem;
    font-size: .82rem;
    letter-spacing: .12em;
    text-transform: uppercase;
}

.cta-primary {
    background: #1f1a17;
    color: #fff;
}

.cta-secondary {
    border: 1px solid rgba(31, 26, 23, 0.16);
    color: #1f1a17;
}

.hero-panel {
    position: relative;
    min-height: 560px;
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 18px 50px rgba(31, 26, 23, 0.12);
}

.hero-panel img,
.feature-image img,
.gallery-card img,
.story-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.hero-panel::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(15, 12, 10, .2) 44%, rgba(15, 12, 10, .55) 100%);
}

.hero-badge {
    position: absolute;
    left: 1.2rem;
    bottom: 1.2rem;
    z-index: 2;
    background: rgba(255,255,255,.72);
    color: #1f1a17;
    backdrop-filter: blur(12px);
    border-radius: 999px;
    padding: .75rem 1rem;
    font-size: .72rem;
    letter-spacing: .18em;
    text-transform: uppercase;
}

.section {
    padding: 3.5rem 0;
}

.section-head {
    display: flex;
    justify-content: space-between;
    align-items: end;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.section-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2rem, 3vw, 3rem);
    line-height: 1;
    margin: 0;
    color: #1f1a17;
}

.section-subtitle {
    margin: .3rem 0 0;
    color: #715b4f;
    line-height: 1.7;
    max-width: 36rem;
}

.card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 1rem;
}

.product-card,
.story-card,
.info-card,
.gallery-card {
    background: rgba(255,255,255,.72);
    border: 1px solid rgba(31, 26, 23, 0.08);
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 14px 36px rgba(31, 26, 23, 0.08);
}

.product-card,
.story-card,
.gallery-card,
.sig-card {
    cursor: pointer;
}

.product-card img,
.story-card img {
    width: 100%;
    height: 260px;
    object-fit: cover;
    display: block;
}

.product-card .body,
.story-card .body,
.info-card .body {
    padding: 1.2rem;
}

.meta {
    text-transform: uppercase;
    letter-spacing: .18em;
    font-size: .68rem;
    color: #8a5a44;
}

.price {
    display: inline-flex;
    margin-top: .8rem;
    padding: .45rem .7rem;
    border-radius: 999px;
    background: rgba(31,26,23,.06);
    font-weight: 700;
    letter-spacing: .08em;
    color: #1f1a17;
}

.split {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    align-items: stretch;
}

.feature-image {
    border-radius: 28px;
    overflow: hidden;
    min-height: 420px;
    box-shadow: 0 18px 50px rgba(31, 26, 23, 0.12);
}

.feature-copy {
    display: grid;
    gap: 1rem;
    align-content: center;
    padding: 1rem 0;
}

.stat-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: .9rem;
    margin-top: 1rem;
}

.stat {
    padding: 1rem;
    background: rgba(255,255,255,.68);
    border-radius: 20px;
    border: 1px solid rgba(31,26,23,.08);
}

.stat strong {
    display: block;
    font-family: 'Cormorant Garamond', serif;
    font-size: 2rem;
    line-height: 1;
}

.stat span {
    display: block;
    margin-top: .35rem;
    color: #6f5c51;
    font-size: .78rem;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: .75rem;
}

.gallery-card {
    min-height: 180px;
    position: relative;
}

.gallery-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    display: block;
}

.gallery-caption {
    position: absolute;
    left: .75rem;
    right: .75rem;
    bottom: .75rem;
    padding: .75rem .9rem;
    border-radius: 16px;
    background: rgba(255,255,255,.7);
    backdrop-filter: blur(12px);
    color: #1f1a17;
    box-shadow: 0 10px 28px rgba(31,26,23,.12);
}

.gallery-caption .meta {
    display: block;
    font-size: .62rem;
    letter-spacing: .18em;
    line-height: 1.4;
}

.contact-wrap {
    display: grid;
    grid-template-columns: .9fr 1.1fr;
    gap: 1.5rem;
}

.contact-stack {
    display: grid;
    gap: .75rem;
}

.contact-item {
    padding: .95rem 1rem;
    background: rgba(255,255,255,.72);
    border-radius: 18px;
    border: 1px solid rgba(31,26,23,.08);
}

.contact-item strong {
    display: block;
    font-size: .72rem;
    letter-spacing: .16em;
    text-transform: uppercase;
    color: #8a5a44;
    margin-bottom: .35rem;
}

.form-grid {
    display: grid;
    gap: .9rem;
}

.fg label {
    display: block;
    margin-bottom: .45rem;
    font-size: .72rem;
    letter-spacing: .16em;
    text-transform: uppercase;
    color: #6f5c51;
}

.fg input,
.fg textarea,
.fg select {
    width: 100%;
    border: 1px solid rgba(31,26,23,.12);
    border-radius: 16px;
    padding: .95rem 1rem;
    background: rgba(255,255,255,.82);
    color: #1f1a17;
    font: inherit;
}

.fg textarea {
    min-height: 140px;
    resize: vertical;
}

@media (max-width: 980px) {
    .hero,
    .split,
    .contact-wrap {
        grid-template-columns: 1fr;
    }

    .hero-panel {
        min-height: 420px;
    }

    .stat-row,
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .gallery-caption {
        left: .5rem;
        right: .5rem;
        bottom: .5rem;
        padding: .6rem .75rem;
    }
}

@media (max-width: 640px) {
    .page-shell {
        width: min(100% - 1rem, 1180px);
    }

    .section {
        padding: 2.5rem 0;
    }

    .section-head {
        flex-direction: column;
        align-items: start;
    }

    .stat-row,
    .gallery-grid {
        grid-template-columns: 1fr;
    }

    .gallery-caption {
        left: .5rem;
        right: .5rem;
        bottom: .5rem;
    }
}

@media (min-width: 1400px) {
    .page-shell {
        width: min(1360px, calc(100% - 3rem));
    }

    .hero {
        grid-template-columns: 1.1fr .9fr;
        gap: 2.5rem;
    }

    .hero-panel {
        min-height: 660px;
    }

    .gallery-grid {
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 1rem;
    }
}

@media (hover: none) {
    .sig-over {
        opacity: 1;
        transform: translateY(0);
        background: linear-gradient(0deg, rgba(31, 26, 23, 0.9) 0%, rgba(31, 26, 23, 0.35) 55%, transparent 100%);
    }

    .gallery-caption {
        background: rgba(255,255,255,.78);
    }
}
</style>
@endpush

@section('content')
<div class="page-shell">
    <section class="hero">
        <div class="hero-copy">
            <div class="eyebrow">Curtain Studio • Uganda</div>
            <h1>Designed for <span class="hero-words"><span class="word active">light</span><span class="word">privacy</span><span class="word">comfort</span></span>, tailored for home.</h1>
            <p class="lead">Explore premium curtains, drapes, blackout panels, and custom window treatments shaped for Ugandan homes and commercial spaces.</p>
            <div class="hero-actions">
                <a class="cta cta-primary" href="#collection">Browse Collection</a>
                <a class="cta cta-secondary" href="#contact">Book Consultation</a>
            </div>
            <div class="stat-row">
                <div class="stat"><strong>500+</strong><span>Homes Styled</span></div>
                <div class="stat"><strong>12+</strong><span>Fabric Lines</span></div>
                <div class="stat"><strong>48hr</strong><span>Response Time</span></div>
                <div class="stat"><strong>Bespoke</strong><span>Service Focused</span></div>
            </div>
        </div>
        <div class="hero-panel">
            <img class="parallax" src="https://i.pinimg.com/736x/8f/ec/24/8fec2448ee910fb49370ffb4b1b3379e.jpg" alt="Elegant curtains framing a bright interior" loading="lazy">
            <div class="hero-badge">Custom Curtains in Uganda</div>
        </div>
    </section>

    <!-- NEW SIGNATURE PIECES SECTION -->
    <section id="signature" class="reveal-fade">
        <div class="sig-header">
            <div class="sig-label">Signature Collection</div>
            <h2 class="sig-title">Our Finest Pieces</h2>
            <p class="sig-subtitle">Handpicked curtain styles and premium fabrics that define elegance and comfort in every room.</p>
        </div>
        <div class="sig-grid">
            <div class="sig-card">
                <div class="sig-img">
                    <img src="https://i.pinimg.com/736x/8f/ec/24/8fec2448ee910fb49370ffb4b1b3379e.jpg" alt="Velour Nocturne Drape" loading="lazy">
                </div>
                <div class="sig-over">
                    <div class="sig-name">Velour Nocturne</div>
                    <div class="sig-tag">Blackout · Floor-Length</div>
                    <div class="sig-desc">Rich velvet blackout fabric for dramatic, light-controlled interiors.</div>
                </div>
            </div>
            <div class="sig-card">
                <div class="sig-img">
                    <img src="https://i.pinimg.com/736x/58/9f/92/589f92fba7423b01456d998ff1718eb5.jpg" alt="Silver Mist Sheer" loading="lazy">
                </div>
                <div class="sig-over">
                    <div class="sig-name">Silver Mist Sheer</div>
                    <div class="sig-tag">Sheer · All Sizes</div>
                    <div class="sig-desc">Light-filtering sheers that soften daylight with elegant transparency.</div>
                </div>
            </div>
            <div class="sig-card">
                <div class="sig-img">
                    <img src="https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg" alt="Sahara Linen" loading="lazy">
                </div>
                <div class="sig-over">
                    <div class="sig-name">Sahara Linen</div>
                    <div class="sig-tag">Semi-Sheer · Natural</div>
                    <div class="sig-desc">Warm linen texture with natural light control and timeless style.</div>
                </div>
            </div>
            <div class="sig-card">
                <div class="sig-img">
                    <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=700&q=80" alt="Midnight Velvet" loading="lazy">
                </div>
                <div class="sig-over">
                    <div class="sig-name">Midnight Velvet</div>
                    <div class="sig-tag">Blackout · Eyelet</div>
                    <div class="sig-desc">Deep, sophisticated velvet in eyelet style for modern elegance.</div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="collection">
        <div class="section-head">
            <div>
                <h2 class="section-title">Signature pieces</h2>
                <p class="section-subtitle">A focused selection of our featured curtain styles and the fabrics behind them.</p>
            </div>
            <a class="cta cta-secondary" href="{{ route('products') }}">View all products</a>
        </div>
        <div class="card-grid">
            @foreach ($featuredProducts as $product)
                <article class="product-card js-product-card" tabindex="0"
                    data-image="{{ $product['image_url'] ?? 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg' }}"
                    data-title="{{ $product['name'] }}"
                    data-category="{{ $product['category'] }}"
                    data-description="{{ $product['description'] ?? 'Premium curtain design chosen for timeless interiors.' }}">
                    <img src="{{ $product['image_url'] ?? 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg' }}" alt="{{ $product['name'] }}" loading="lazy">
                    <div class="body">
                        <div class="meta">{{ $product['category'] }}</div>
                        <h3>{{ $product['name'] }}</h3>
                        @if (!empty($product['description']))
                            <p style="line-height:1.8;color:#5b4a40;margin-top:.85rem;">{{ $product['description'] }}</p>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section">
        <div class="split">
            <div class="feature-image">
                <img src="{{ $featuredImageUrl ?? 'https://i.pinimg.com/736x/58/9f/92/589f92fba7423b01456d998ff1718eb5.jpg' }}" alt="Featured curtain interior" loading="lazy">
            </div>
            <div class="feature-copy">
                <div class="eyebrow">Why clients choose us</div>
                <h2 class="section-title">A curtain service that feels precise, not crowded.</h2>
                <p class="section-subtitle">We keep the page focused on the essentials: the work, the lookbook, the proof, and the consultation form. No extra chrome, no competing navigation inside the content.</p>
                <div class="card-grid" style="grid-template-columns:1fr 1fr;">
                    <div class="info-card"><div class="body"><h3>Measured at home</h3><p style="color:#5b4a40;line-height:1.8;">We come to you and measure the window properly before any tailoring starts.</p></div></div>
                    <div class="info-card"><div class="body"><h3>Installed neatly</h3><p style="color:#5b4a40;line-height:1.8;">The final hang, drape, and fit are handled by the team that made the curtains.</p></div></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="lookbook">
        <div class="section-head">
            <div>
                <h2 class="section-title">Lookbook</h2>
                <p class="section-subtitle">Curtain-heavy inspiration from living rooms, bedrooms, and formal spaces.</p>
            </div>
        </div>
        <div class="gallery-grid">
            @foreach ($lookbookImages as $image)
                <article class="gallery-card js-gallery-card" tabindex="0"
                    data-image="{{ $image['image_url'] }}"
                    data-title="{{ $image['title'] }}"
                    data-category="{{ $image['caption'] ?? $image['title'] }}"
                    data-description="{{ $image['alt_text'] }}">
                    <img src="{{ $image['image_url'] }}" alt="{{ $image['alt_text'] }}" loading="lazy">
                    <div class="gallery-caption">
                        <div class="meta">{{ $image['caption'] ?? $image['title'] }}</div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section" id="stories">
        <div class="section-head">
            <div>
                <h2 class="section-title">Success stories</h2>
                <p class="section-subtitle">A few client notes that show how the right curtains change a room.</p>
            </div>
        </div>
        <div class="card-grid">
            @foreach ($successStories as $story)
                <article class="story-card">
                    <img src="{{ $story['image_url'] ?? 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg' }}" alt="{{ $story['client_name'] }} story" loading="lazy">
                    <div class="body">
                        <div class="meta">{{ $story['client_name'] }} · {{ $story['location'] }}</div>
                        <h3>{{ $story['quote'] }}</h3>
                        <p style="color:#5b4a40;line-height:1.8;">{{ $story['story'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section" id="contact">
        <div class="section-head">
            <div>
                <h2 class="section-title">Book a consultation</h2>
                <p class="section-subtitle">Email arrindamark@gmail.com or WhatsApp +256 772 513 055, or send a request below.</p>
            </div>
        </div>
        <div class="contact-wrap">
            <div class="contact-stack">
                <div class="contact-item"><strong>Email</strong><span>arrindamark@gmail.com</span></div>
                <div class="contact-item"><strong>WhatsApp</strong><span>+256 772 513 055</span></div>
                <div class="contact-item"><strong>Coverage</strong><span>Uganda nationwide</span></div>
                <div class="contact-item"><strong>Service</strong><span>Bespoke curtain design</span></div>
            </div>

            <form class="form-grid" action="{{ route('consultation.store') }}" method="POST">
                @csrf
                <div class="fg">
                    <label for="full_name">Full Name</label>
                    <input id="full_name" name="full_name" type="text" placeholder="Your name" value="{{ old('full_name') }}">
                    @error('full_name') <div style="margin-top:.45rem;color:#b35c47;font-size:.72rem;">{{ $message }}</div> @enderror
                </div>
                <div class="fg">
                    <label for="phone">Phone / WhatsApp</label>
                    <input id="phone" name="phone" type="text" placeholder="+256 ..." value="{{ old('phone') }}">
                    @error('phone') <div style="margin-top:.45rem;color:#b35c47;font-size:.72rem;">{{ $message }}</div> @enderror
                </div>
                <div class="fg">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="your@email.com" value="{{ old('email') }}">
                    @error('email') <div style="margin-top:.45rem;color:#b35c47;font-size:.72rem;">{{ $message }}</div> @enderror
                </div>
                <div class="fg">
                    <label for="space_type">Space Type</label>
                    <select id="space_type" name="space_type">
                        <option value="">Select your space...</option>
                        <option {{ old('space_type') === 'Living Room' ? 'selected' : '' }}>Living Room</option>
                        <option {{ old('space_type') === 'Bedroom' ? 'selected' : '' }}>Bedroom</option>
                        <option {{ old('space_type') === 'Dining Room' ? 'selected' : '' }}>Dining Room</option>
                        <option {{ old('space_type') === 'Home Office' ? 'selected' : '' }}>Home Office</option>
                        <option {{ old('space_type') === 'Commercial / Office' ? 'selected' : '' }}>Commercial / Office</option>
                        <option {{ old('space_type') === 'Multiple Rooms' ? 'selected' : '' }}>Multiple Rooms</option>
                        <option {{ old('space_type') === 'Full Home' ? 'selected' : '' }}>Full Home</option>
                    </select>
                    @error('space_type') <div style="margin-top:.45rem;color:#b35c47;font-size:.72rem;">{{ $message }}</div> @enderror
                </div>
                <div class="fg">
                    <label for="vision">Your Vision</label>
                    <textarea id="vision" name="vision" placeholder="Tell us about your space, preferred fabrics, colours, or any inspiration...">{{ old('vision') }}</textarea>
                    @error('vision') <div style="margin-top:.45rem;color:#b35c47;font-size:.72rem;">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="cta cta-primary" style="border:none;cursor:pointer;justify-self:start;">Send Request</button>
            </form>
        </div>
    </section>
</div>
@endsection