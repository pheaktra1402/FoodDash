@extends('layouts.frontend')

@section('content')

    {{-- This section is styled with its own scoped CSS below, so it renders
         correctly regardless of your Tailwind build/purge setup. Font import:
         move this into your layout's <head> when convenient. --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@700;800&family=Inter:wght@400;500;600;700&display=swap');

        .fd-home {
            --ink:         #111827;
            --green:       #16A34A;
            --green-soft:  #E7F6EC;
            --muted:       #6B7280;
            --line:        #E5E7EB;
            --bg-soft:     #F7F9F7;
            font-family: 'Inter', sans-serif;
            color: var(--ink);
        }
        .fd-home h1, .fd-home h2, .fd-home h3, .fd-home .fd-display {
            font-family: 'Manrope', sans-serif;
        }

        /* Hero */
        .fd-hero { background: #fff; padding: 64px 0 80px; }
        .fd-wrap { max-width: 1280px; margin: 0 auto; padding: 0 24px; }
        .fd-hero-grid {
            display: flex;
            flex-direction: column;
            gap: 48px;
        }
        @media (min-width: 1024px) {
            .fd-hero-grid { flex-direction: row; align-items: center; gap: 64px; }
            .fd-hero-text, .fd-hero-media { flex: 1 1 0; min-width: 0; }
        }

        .fd-eyebrow {
            display: inline-block;
            font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em;
            background: var(--green-soft); color: var(--green);
            padding: 6px 14px; border-radius: 999px;
        }
        .fd-h1 {
            margin: 20px 0 0; font-weight: 800; line-height: 1.06; letter-spacing: -0.02em;
            font-size: clamp(2.25rem, 4.2vw, 3.75rem);
        }
        .fd-sub {
            margin: 18px 0 0; font-size: 18px; line-height: 1.6; color: var(--muted); max-width: 460px;
        }

        .fd-cta-row { margin-top: 30px; display: flex; flex-wrap: wrap; gap: 14px; }
        .fd-btn {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 14px 26px; border-radius: 12px; font-weight: 600; font-size: 15px;
            text-decoration: none; transition: transform .15s ease, background .15s ease;
        }
        .fd-btn-primary { background: var(--green); color: #fff; }
        .fd-btn-primary:hover { background: #128a3e; transform: translateY(-1px); }
        .fd-btn-outline { background: #fff; color: var(--ink); border: 1px solid var(--line); }
        .fd-btn-outline:hover { background: var(--bg-soft); }

        .fd-stats { margin-top: 40px; display: flex; align-items: center; gap: 28px; flex-wrap: wrap; }
        .fd-stat { padding-left: 0; }
        .fd-stat + .fd-stat { border-left: 1px solid var(--line); padding-left: 28px; }
        .fd-stat-num { font-weight: 800; font-size: 22px; margin: 0; }
        .fd-stat-label { margin: 2px 0 0; font-size: 13px; color: var(--muted); }

        .fd-hero-media { position: relative; }
        .fd-hero-img-wrap { border-radius: 24px; overflow: hidden; height: 340px; }
        .fd-hero-img-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; }

        .fd-eta-card {
            position: absolute; left: 20px; bottom: -24px;
            background: #fff; border-radius: 16px; box-shadow: 0 12px 30px rgba(17,24,39,0.15);
            padding: 16px 18px; display: flex; align-items: center; gap: 12px; max-width: 230px;
        }
        .fd-eta-icon {
            width: 40px; height: 40px; border-radius: 999px; background: var(--green);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .fd-eta-title { margin: 0; font-size: 14px; font-weight: 600; }
        .fd-eta-sub { margin: 2px 0 0; font-size: 12px; color: var(--muted); }

        /* Featured */
        .fd-featured { background: var(--bg-soft); padding: 80px 0; }
        .fd-featured-head {
            display: flex; flex-direction: column; gap: 16px;
        }
        @media (min-width: 640px) {
            .fd-featured-head { flex-direction: row; align-items: flex-end; justify-content: space-between; }
        }
        .fd-featured-eyebrow { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: var(--green); }
        .fd-featured-title { margin: 8px 0 0; font-weight: 800; font-size: clamp(1.75rem, 3vw, 2.25rem); letter-spacing: -0.01em; }
        .fd-view-all {
            display: inline-flex; align-items: center; gap: 6px; font-weight: 600; color: var(--ink); text-decoration: none;
        }
        .fd-view-all svg { width: 16px; height: 16px; }

        .fd-grid {
            margin-top: 40px; display: grid; grid-template-columns: 1fr; gap: 24px;
        }
        @media (min-width: 768px) { .fd-grid { grid-template-columns: repeat(3, 1fr); } }

        .fd-card {
            background: #fff; border-radius: 18px; overflow: hidden;
            box-shadow: 0 1px 2px rgba(17,24,39,0.06);
            transition: box-shadow .25s ease;
        }
        .fd-card:hover { box-shadow: 0 12px 28px rgba(17,24,39,0.12); }
        .fd-card-img-wrap { position: relative; height: 190px; }
        .fd-card-img-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .fd-rating {
            position: absolute; top: 12px; left: 12px;
            background: rgba(255,255,255,0.95); font-size: 12px; font-weight: 600;
            padding: 4px 10px; border-radius: 999px;
        }
        .fd-card-body { padding: 20px; }
        .fd-card-title { margin: 0; font-weight: 700; font-size: 18px; }
        .fd-card-desc { margin: 6px 0 0; font-size: 14px; line-height: 1.5; color: var(--muted); }
        .fd-card-footer { margin-top: 20px; display: flex; align-items: center; justify-content: space-between; }
        .fd-price { margin: 0; font-weight: 800; font-size: 20px; }

        .fd-login-btn {
            font-size: 12px; font-weight: 600; padding: 8px 16px; border-radius: 999px;
            border: 1px solid var(--line); color: var(--ink); text-decoration: none;
        }
        .fd-add-btn {
            width: 38px; height: 38px; border-radius: 999px; background: var(--ink);
            display: inline-flex; align-items: center; justify-content: center;
            border: none; cursor: pointer; transition: background .15s ease, transform .15s ease;
        }
        .fd-add-btn:hover { background: var(--green); transform: scale(1.06); }

        .fd-mobile-view-all { display: block; text-align: center; margin-top: 36px; }
        @media (min-width: 640px) { .fd-mobile-view-all { display: none; } }
    </style>

    <div class="fd-home">

        <!-- Hero -->
        <div class="fd-hero">
            <div class="fd-wrap fd-hero-grid">

                <div class="fd-hero-text">
                    <span class="fd-eyebrow">Delivering across the city</span>

                    <h1 class="fd-h1">Order from your<br>favorite local spots</h1>

                    <p class="fd-sub">
                        Browse hundreds of restaurants nearby and get hot food delivered
                        to your door in under 30 minutes.
                    </p>

                    <div class="fd-cta-row">
                        <a href="{{ route('products.index') }}" class="fd-btn fd-btn-primary">Browse restaurants</a>
                        @guest
                            <a href="{{ route('register') }}" class="fd-btn fd-btn-outline">Create account</a>
                        @endguest
                    </div>

                    <div class="fd-stats">
                        <div class="fd-stat">
                            <p class="fd-stat-num">500+</p>
                            <p class="fd-stat-label">Local restaurants</p>
                        </div>
                        <div class="fd-stat">
                            <p class="fd-stat-num">28 min</p>
                            <p class="fd-stat-label">Average delivery</p>
                        </div>
                        <div class="fd-stat">
                            <p class="fd-stat-num">4.8★</p>
                            <p class="fd-stat-label">Customer rating</p>
                        </div>
                    </div>
                </div>

                <div class="fd-hero-media">
                    <div class="fd-hero-img-wrap">
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80"
                             alt="Food from a local restaurant, ready for delivery" width="1035" height="340">
                    </div>

                    <div class="fd-eta-card">
                        <span class="fd-eta-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </span>
                        <div>
                            <p class="fd-eta-title">Arriving in 22 min</p>
                            <p class="fd-eta-sub">Order placed 2 min ago</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Featured dishes -->
        <div class="fd-featured">
            <div class="fd-wrap">

                <div class="fd-featured-head">
                    <div>
                        <span class="fd-featured-eyebrow">Popular right now</span>
                        <h2 class="fd-featured-title">Dishes people keep ordering</h2>
                    </div>
                    <a href="{{ route('products.index') }}" class="fd-view-all">
                        View full menu
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>

                <div class="fd-grid">

                    <!-- Dish 1 -->
                    <div class="fd-card">
                        <div class="fd-card-img-wrap">
                            <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-1.2.1&auto=format&fit=crop&w=1599&q=80"
                                 alt="Classic cheeseburger" width="400" height="190">
                            <span class="fd-rating">★ 4.9</span>
                        </div>
                        <div class="fd-card-body">
                            <h3 class="fd-card-title">Classic Cheeseburger</h3>
                            <p class="fd-card-desc">Beef patty, melted cheddar, lettuce, and secret sauce on a toasted brioche bun.</p>
                            <div class="fd-card-footer">
                                <p class="fd-price">$8.99</p>
                                @guest
                                    <a href="{{ route('login') }}" class="fd-login-btn">Log in to order</a>
                                @endguest
                                @auth
                                    <button class="fd-add-btn" aria-label="Add Classic Cheeseburger">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </button>
                                @endauth
                            </div>
                        </div>
                    </div>

                    <!-- Dish 2 -->
                    <div class="fd-card">
                        <div class="fd-card-img-wrap">
                            <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80"
                                 alt="Margherita pizza" width="400" height="190">
                            <span class="fd-rating">★ 4.8</span>
                        </div>
                        <div class="fd-card-body">
                            <h3 class="fd-card-title">Margherita Pizza</h3>
                            <p class="fd-card-desc">Wood-fired crust, San Marzano tomato sauce, fresh mozzarella, and basil.</p>
                            <div class="fd-card-footer">
                                <p class="fd-price">$12.50</p>
                                @guest
                                    <a href="{{ route('login') }}" class="fd-login-btn">Log in to order</a>
                                @endguest
                                @auth
                                    <button class="fd-add-btn" aria-label="Add Margherita Pizza">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </button>
                                @endauth
                            </div>
                        </div>
                    </div>

                    <!-- Dish 3 -->
                    <div class="fd-card">
                        <div class="fd-card-img-wrap">
                            <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?ixlib=rb-1.2.1&auto=format&fit=crop&w=774&q=80"
                                 alt="Spicy garlic pasta" width="400" height="190">
                            <span class="fd-rating">★ 4.7</span>
                        </div>
                        <div class="fd-card-body">
                            <h3 class="fd-card-title">Spicy Garlic Pasta</h3>
                            <p class="fd-card-desc">Al dente pasta, olive oil, toasted garlic, chili flakes, and parmesan.</p>
                            <div class="fd-card-footer">
                                <p class="fd-price">$10.99</p>
                                @guest
                                    <a href="{{ route('login') }}" class="fd-login-btn">Log in to order</a>
                                @endguest
                                @auth
                                    <button class="fd-add-btn" aria-label="Add Spicy Garlic Pasta">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </button>
                                @endauth
                            </div>
                        </div>
                    </div>

                </div>

                <div class="fd-mobile-view-all">
                    <a href="{{ route('products.index') }}" class="fd-view-all">
                        View full menu
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>

            </div>
        </div>

    </div>
@endsection
