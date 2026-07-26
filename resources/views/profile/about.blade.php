@extends('layouts.frontend')

@section('content')
<style>
    .about-hero {
        position: relative;
        background-color: #0f172a;
        padding: 5rem 0;
        overflow: hidden;
    }
    .about-hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.2;
    }
    .icon-box {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        background-color: #198754;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
</style>

<div class="bg-white">
    <!-- Hero Section -->
    <div class="about-hero text-center text-white">
        <img class="about-hero-bg" src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1974&q=80" alt="Restaurant interior">
        <div class="container position-relative py-4">
            <h1 class="display-4 fw-bold">About Us</h1>
            <p class="lead text-light opacity-75 mx-auto mt-3" style="max-width: 650px;">
                We are passionate about delivering the best food from local restaurants directly to your doorstep, fast and fresh.
            </p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container py-5 my-4">
        <div class="text-center">
            <span class="text-uppercase fw-semibold text-success small tracking-wide">Our Mission</span>
            <h2 class="display-5 fw-bold text-dark mt-2">Quality food, fast delivery.</h2>
            <p class="text-muted lead mx-auto mt-3" style="max-width: 650px;">
                We started FoodDash with one simple goal: to make it incredibly easy for everyone to enjoy their favorite meals without leaving the comfort of their home.
            </p>
        </div>

        <!-- Features Grid -->
        <div class="row g-4 mt-5">
            <!-- Feature 1 -->
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-3 p-3 rounded-3 border bg-light h-100">
                    <div class="icon-box shadow-sm">
                        <i class="fa-solid fa-bolt fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-2">Lightning Fast Delivery</h5>
                        <p class="text-muted small mb-0">
                            Our drivers are stationed around the city to ensure your food arrives hot and fresh, in record time.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-3 p-3 rounded-3 border bg-light h-100">
                    <div class="icon-box shadow-sm">
                        <i class="fa-solid fa-utensils fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-2">Best Partner Restaurants</h5>
                        <p class="text-muted small mb-0">
                            We carefully vet all our partner restaurants to guarantee top-tier hygiene and culinary excellence.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-3 p-3 rounded-3 border bg-light h-100">
                    <div class="icon-box shadow-sm">
                        <i class="fa-solid fa-headset fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-2">Exceptional Support</h5>
                        <p class="text-muted small mb-0">
                            Our customer support team is available 24/7 to resolve any issues and ensure you have a perfect meal.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection