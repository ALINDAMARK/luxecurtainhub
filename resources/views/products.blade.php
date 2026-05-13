@extends('layouts.app')

@section('content')
<section class="grid-section">
    <h1>Our Curtain Collection</h1>
    <p style="margin:.75rem 0 2rem;max-width:720px;line-height:1.8;color:var(--ash);">A simple gallery of the curtain products we have made. Browse the images, fabrics, and styles, then contact us if you want something similar for your space.</p>
    <div class="card-grid">
        @foreach ($products as $product)
            <article class="card">
                <img src="{{ $product['image_url'] ?? 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg' }}" alt="{{ $product['name'] }}" style="width:100%;height:260px;object-fit:cover;border-radius:16px;margin-bottom:1rem;">
                <h3>{{ $product['name'] }}</h3>
                <p>{{ $product['category'] }}</p>
                @if (!empty($product['description']))
                    <p style="margin-top:.75rem;line-height:1.8;color:var(--ash);">{{ $product['description'] }}</p>
                @endif
            </article>
        @endforeach
    </div>
</section>
@endsection
