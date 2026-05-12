@extends('layouts.app')

@section('content')
<section class="grid-section">
    <h1>Our Curtain Collection</h1>
    @if (session('order_success'))
        <div style="margin:1rem 0 2rem;padding:1rem 1.2rem;border:1px solid rgba(184,148,90,.35);color:var(--gold-light);background:rgba(184,148,90,.08);font-size:.78rem;line-height:1.8;">
            {{ session('order_success') }}
        </div>
    @endif
    <div class="card-grid">
        @foreach ($products as $product)
            <article class="card">
                <img src="{{ $product['image_url'] ?? 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg' }}" alt="{{ $product['name'] }}" style="width:100%;height:260px;object-fit:cover;border-radius:16px;margin-bottom:1rem;">
                <h3>{{ $product['name'] }}</h3>
                <p>{{ $product['category'] }}</p>
                <strong>${{ $product['price'] }}</strong>
                @if (!empty($product['description']))
                    <p style="margin-top:.75rem;line-height:1.8;color:var(--ash);">{{ $product['description'] }}</p>
                @endif
            </article>
        @endforeach
    </div>
</section>

<section id="order-form" class="grid-section">
    <h2>Place an Order</h2>
    <form action="{{ route('orders.store') }}" method="POST" class="form" style="max-width:780px;">
        @csrf
        <div class="fg"><label for="full_name">Full Name</label><input id="full_name" name="full_name" type="text" value="{{ old('full_name') }}" placeholder="Your full name">@error('full_name')<div style="margin-top:.45rem;color:#cf8d7d;font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;">{{ $message }}</div>@enderror</div>
        <div class="fg"><label for="email">Email</label><input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="your@email.com">@error('email')<div style="margin-top:.45rem;color:#cf8d7d;font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;">{{ $message }}</div>@enderror</div>
        <div class="fg"><label for="phone">Phone</label><input id="phone" name="phone" type="text" value="{{ old('phone') }}" placeholder="+256 ...">@error('phone')<div style="margin-top:.45rem;color:#cf8d7d;font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;">{{ $message }}</div>@enderror</div>
        <div class="fg">
            <label for="product_name">Product</label>
            <select id="product_name" name="product_name">
                <option value="">Select a product...</option>
                @foreach ($products as $product)
                    <option value="{{ $product['name'] }}" @selected(old('product_name') === $product['name'])>{{ $product['name'] }}</option>
                @endforeach
            </select>
            @error('product_name')<div style="margin-top:.45rem;color:#cf8d7d;font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;">{{ $message }}</div>@enderror
        </div>
        <div class="fg"><label for="quantity">Quantity</label><input id="quantity" name="quantity" type="number" min="1" value="{{ old('quantity', 1) }}">@error('quantity')<div style="margin-top:.45rem;color:#cf8d7d;font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;">{{ $message }}</div>@enderror</div>
        <div class="fg"><label for="delivery_address">Delivery Address</label><input id="delivery_address" name="delivery_address" type="text" value="{{ old('delivery_address') }}" placeholder="Where should we deliver?">@error('delivery_address')<div style="margin-top:.45rem;color:#cf8d7d;font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;">{{ $message }}</div>@enderror</div>
        <div class="fg"><label for="notes">Notes</label><textarea id="notes" name="notes" placeholder="Colour, measurements, lining, or anything else...">{{ old('notes') }}</textarea>@error('notes')<div style="margin-top:.45rem;color:#cf8d7d;font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;">{{ $message }}</div>@enderror</div>
        <button type="submit" class="btn btn-outline" style="text-align:center;background:transparent;border:none;padding:0;"><span>Place Order</span></button>
    </form>
</section>
@endsection
