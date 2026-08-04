@extends('layouts.frontend')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap');

    .fd-home {
        --ink: #0F172A;
        --primary: #10B981;
        --primary-hover: #059669;
        --primary-soft: #ECFDF5;
        --muted: #64748B;
        --border: #F1F5F9;
        --card-bg: #FFFFFF;
        --bg-soft: #F8FAFC;
        font-family: 'Inter', sans-serif;
        color: var(--ink);
        background-color: var(--bg-soft);
        padding-bottom: 80px;
    }

    .fd-home h1, .fd-home h2, .fd-home h3, .fd-home .fd-display {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .fd-wrap {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* Hero Section */
    .fd-hero {
        background: #fff;
        padding: 50px 0 70px;
        border-bottom: 1px solid var(--border);
        margin-bottom: 60px;
    }

    .fd-hero-grid {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    @media (min-width: 1024px) {
        .fd-hero-grid {
            flex-direction: row;
            align-items: center;
            gap: 60px;
        }
        .fd-hero-text, .fd-hero-media {
            flex: 1;
        }
    }

    .fd-eyebrow {
        display: inline-flex;
        align-items: center;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background: var(--primary-soft);
        color: var(--primary);
        padding: 6px 14px;
        border-radius: 50px;
        margin-bottom: 16px;
    }

    .fd-h1 {
        font-weight: 800;
        line-height: 1.15;
        font-size: clamp(2.25rem, 4vw, 3.5rem);
        color: var(--ink);
        margin-bottom: 16px;
    }

    .fd-sub {
        font-size: 17px;
        line-height: 1.6;
        color: var(--muted);
        max-width: 480px;
        margin-bottom: 28px;
    }

    .fd-cta-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 36px;
    }

    .fd-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 28px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .fd-btn-primary {
        background: var(--primary);
        color: #fff;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
    }

    .fd-btn-primary:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
    }

    .fd-btn-outline {
        background: #fff;
        color: var(--ink);
        border: 1px solid #E2E8F0;
    }

    .fd-btn-outline:hover {
        background: var(--bg-soft);
        border-color: #CBD5E1;
    }

    /* Stats Grid */
    .fd-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        padding-top: 24px;
        border-top: 1px solid var(--border);
    }

    .fd-stat-num {
        font-weight: 800;
        font-size: 20px;
        color: var(--ink);
        margin: 0 0 4px 0;
    }

    .fd-stat-label {
        font-size: 13px;
        color: var(--muted);
        margin: 0;
    }

    /* Hero Image & Card */
    .fd-hero-media {
        position: relative;
    }

    .fd-hero-img-wrap {
        border-radius: 24px;
        overflow: hidden;
        height: 380px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .fd-hero-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .fd-eta-card {
        position: absolute;
        left: 20px;
        bottom: -20px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        border: 1px solid var(--border);
    }

    .fd-eta-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: var(--primary-soft);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Featured Header */
    .fd-featured-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 32px;
    }

    .fd-featured-eyebrow {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--primary);
        display: block;
        margin-bottom: 6px;
    }

    .fd-featured-title {
        font-weight: 800;
        font-size: 28px;
        color: var(--ink);
        margin: 0;
    }

    .fd-view-all {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
        font-size: 14px;
        color: var(--primary);
        text-decoration: none;
        transition: gap 0.2s;
    }

    .fd-view-all:hover {
        gap: 10px;
    }

    .fd-view-all svg {
        width: 16px;
        height: 16px;
    }

    /* Product Grid & Modern Cards */
    .fd-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }

    @media (min-width: 640px) {
        .fd-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (min-width: 1024px) {
        .fd-grid { grid-template-columns: repeat(3, 1fr); }
    }

    .fd-card {
        background: var(--card-bg);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #E2E8F0;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }

    .fd-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08);
        border-color: #CBD5E1;
    }

  .fd-card-img-wrap {
        position: relative;
        height: 200px;
        overflow: hidden;
        background: #F8FAFC;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .fd-card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 12px; 
        transition: transform 0.5s ease;
    }

    .fd-card:hover .fd-card-img-wrap img {
        transform: scale(1.05);
    }

    .fd-rating {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(4px);
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .fd-card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .fd-card-title {
        margin: 0 0 8px 0;
        font-weight: 700;
        font-size: 17px;
        color: var(--ink);
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .fd-card-desc {
        margin: 0 0 20px 0;
        font-size: 13.5px;
        line-height: 1.5;
        color: var(--muted);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
    }

    .fd-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 12px;
        border-top: 1px solid var(--border);
        margin-top: auto;
    }

    .fd-price {
        margin: 0;
        font-weight: 800;
        font-size: 19px;
        color: var(--ink);
    }

    .fd-login-btn {
        font-size: 12px;
        font-weight: 600;
        padding: 8px 14px;
        border-radius: 8px;
        background: var(--bg-soft);
        border: 1px solid #E2E8F0;
        color: var(--ink);
        text-decoration: none;
        transition: background 0.2s;
    }

    .fd-login-btn:hover {
        background: #E2E8F0;
    }

    .fd-add-btn {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: var(--primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
    }

    .fd-add-btn:hover {
        background: var(--primary-hover);
        transform: scale(1.05);
    }
</style>

<div class="fd-home">

    <!-- Hero Section -->
    <div class="fd-hero">
        <div class="fd-wrap fd-hero-grid">
            <div class="fd-hero-text">
                <span class="fd-eyebrow">🚀 Delivering across the city</span>
                <h1 class="fd-h1">Order from your favorite local spots</h1>
                <p class="fd-sub">
                    Browse hundreds of restaurants nearby and get hot food delivered to your door in under 30 minutes.
                </p>
                <div class="fd-cta-row">
                    <a href="{{ route('products.index') }}" class="fd-btn fd-btn-primary">Browse restaurants</a>
                    @guest
                        <a href="{{ route('register') }}" class="fd-btn fd-btn-outline">Create account</a>
                    @endguest
                </div>
                <div class="fd-stats">
                    <div>
                        <p class="fd-stat-num">500+</p>
                        <p class="fd-stat-label">Restaurants</p>
                    </div>
                    <div>
                        <p class="fd-stat-num">28 min</p>
                        <p class="fd-stat-label">Fast Delivery</p>
                    </div>
                    <div>
                        <p class="fd-stat-num">4.8 ★</p>
                        <p class="fd-stat-label">User Rating</p>
                    </div>
                </div>
            </div>

            <div class="fd-hero-media">
                <div class="fd-hero-img-wrap">
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80"
                        alt="Food delivery" width="1035" height="380">
                </div>
                <div class="fd-eta-card">
                    <span class="fd-eta-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </span>
                    <div>
                        <p style="margin:0; font-size:14px; font-weight:700; color:var(--ink);">Arriving in 22 min</p>
                        <p style="margin:2px 0 0; font-size:12px; color:var(--muted);">Order placed 2 min ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured dishes -->
    <div class="fd-wrap">
        <div class="fd-featured-head">
            <div>
                <span class="fd-featured-eyebrow">Popular right now</span>
                <h2 class="fd-featured-title">Dishes people keep ordering</h2>
            </div>
            <a href="{{ route('products.index') }}" class="fd-view-all">
                View full menu
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>

        <div class="fd-grid">
            @isset($featuredProducts)
                @foreach($featuredProducts as $product)
                    <div class="fd-card">
                        <div class="fd-card-img-wrap">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=400&q=80' }}" 
                                 alt="{{ $product->product_name }}" width="400" height="210">
                            <span class="fd-rating">★ 4.8</span>
                        </div>
                        <div class="fd-card-body">
                            <h3 class="fd-card-title">{{ $product->product_name }}</h3>
                            <p class="fd-card-desc">{{ $product->description }}</p>
                            <div class="fd-card-footer">
                                <p class="fd-price">${{ number_format($product->selling_price ?? 0, 2) }}</p>
                                
                                @guest
                                    <a href="{{ route('login') }}" class="fd-login-btn">Log in to order</a>
                                @endguest
                                @auth
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="fd-add-btn" aria-label="Add {{ $product->product_name }}">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>

</div>

<!-- Toast Notification -->
<div id="toast-notification" style="position: fixed; bottom: 24px; right: 24px; background: #0F172A; color: #fff; padding: 14px 24px; border-radius: 12px; font-size: 14px; font-weight: 600; box-shadow: 0 10px 25px rgba(0,0,0,0.15); opacity: 0; transition: opacity 0.3s ease, transform 0.3s ease; transform: translateY(20px); pointer-events: none; z-index: 9999;">
    Product added to cart successfully!
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toast = document.getElementById('toast-notification');

    function showToast(message) {
        toast.innerText = message;
        toast.style.opacity = '1';
        toast.style.transform = 'translateY(0)';
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(20px)';
        }, 2000);
    }

    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            let url = this.action;
            let token = this.querySelector('input[name="_token"]').value;

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const cartBadge = document.querySelector('.cart-badge-count');
                    if (cartBadge) {
                        cartBadge.innerText = data.cartCount;
                    }
                    showToast(data.success);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script>
@endsection