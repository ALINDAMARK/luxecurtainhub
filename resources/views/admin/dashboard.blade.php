@extends('admin.layout')

@section('content')
<section class="admin-page-header">
    <div>
        <div class="admin-kicker">Dashboard</div>
        <h1>Website Control Center</h1>
        <p>Review orders, manage published content, and update site images from one place.</p>
    </div>
</section>

<section class="admin-stats-grid">
    @foreach ($stats as $label => $value)
        <div class="admin-stat-card">
            <span>{{ ucfirst($label) }}</span>
            <strong>{{ $value }}</strong>
        </div>
    @endforeach
</section>

<section class="admin-two-column">
    <div class="admin-panel">
        <h2>Content Areas</h2>
        <div class="admin-resource-links">
            @foreach ($resources as $key => $resource)
                <a href="{{ $resource['route'] }}">{{ $resource['label'] }}</a>
            @endforeach
        </div>
    </div>

    <div class="admin-panel">
        <h2>Recent Orders</h2>
        @if ($recentOrders->isEmpty())
            <p class="admin-empty">No orders yet.</p>
        @else
            <div class="admin-list">
                @foreach ($recentOrders as $order)
                    <div class="admin-list-item">
                        <strong>{{ $order->full_name }}</strong>
                        <span>{{ $order->product_name }} · {{ $order->status }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section class="admin-panel">
    <h2>Recent Consultations</h2>
    @if ($recentConsultations->isEmpty())
        <p class="admin-empty">No consultation requests yet.</p>
    @else
        <div class="admin-list">
            @foreach ($recentConsultations as $inquiry)
                <div class="admin-list-item">
                    <strong>{{ $inquiry->full_name }}</strong>
                    <span>{{ $inquiry->space_type }} · {{ $inquiry->email }}</span>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection
