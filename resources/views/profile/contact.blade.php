@extends('layouts.frontend')

@section('content')
<style>
    .contact-hero {
        position: relative;
        background-color: #0f172a;
        padding: 4.5rem 0;
        overflow: hidden;
    }
    .contact-hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.2;
    }
    
    /* Updated to match custom pink theme */
    .contact-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background-color: #FFF1F2;
        color: #F43F5E;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .btn-custom-pink {
        background-color: #F43F5E;
        color: #fff;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-custom-pink:hover {
        background-color: #E11D48;
        color: #fff;
        transform: translateY(-1px);
    }

    .social-btn {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: 1px solid #E2E8F0;
        color: #475569;
        background: #fff;
        transition: all 0.2s ease;
    }

    .social-btn:hover {
        background-color: #FFF1F2;
        color: #F43F5E;
        border-color: #FDA4AF;
    }
</style>

<div class="bg-white">
    <!-- Hero Section -->
    <div class="contact-hero text-center text-white">
        <img class="contact-hero-bg" src="https://images.unsplash.com/photo-1534536281715-e28d76689b4d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Contact us header">
        <div class="container position-relative py-3">
            <h1 class="display-5 fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">Get in Touch</h1>
            <p class="lead text-light opacity-75 mx-auto mt-2" style="max-width: 600px;">
                Have questions or feedback? We’d love to hear from you. Send us a message and we'll respond as soon as possible.
            </p>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="container py-5 my-3">
        <div class="row g-5">
            
            <!-- Left Side: Contact Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm p-4 p-md-4 rounded-4 bg-light" style="border: 1px solid #E2E8F0 !important;">
                    <h3 class="fw-bold text-dark mb-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">Send us a Message</h3>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label small fw-semibold text-secondary">Your Name</label>
                                <input type="text" name="name" id="name" class="form-control rounded-3 py-2 shadow-none" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label small fw-semibold text-secondary">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control rounded-3 py-2 shadow-none" placeholder="name@example.com" required>
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label small fw-semibold text-secondary">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control rounded-3 py-2 shadow-none" placeholder="Order Inquiry, Feedback, etc." required>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label small fw-semibold text-secondary">Message</label>
                                <textarea name="message" id="message" rows="5" class="form-control rounded-3 py-2 shadow-none" placeholder="Write your message here..." required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-custom-pink fw-bold px-4 py-3 w-100 shadow-sm">
                                    <i class="fa-solid fa-paper-plane me-2"></i> Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Side: Info & Details -->
            <div class="col-lg-5 d-flex flex-column justify-content-between">
                <div>
                    <h3 class="fw-bold text-dark mb-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">Contact Information</h3>
                    <p class="text-muted mb-4">
                        Fill out the form or reach out to us directly through any of the channels below.
                    </p>

                    <!-- Info Cards -->
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="contact-icon-box shadow-sm">
                            <i class="fa-solid fa-location-dot fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0">Our Location</h6>
                            <small class="text-muted">123 Street, Phnom Penh, Cambodia</small>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="contact-icon-box shadow-sm">
                            <i class="fa-solid fa-phone fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0">Phone Number</h6>
                            <small class="text-muted">+855 12 345 678 / +855 98 765 432</small>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="contact-icon-box shadow-sm">
                            <i class="fa-solid fa-envelope fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0">Email Address</h6>
                            <small class="text-muted">support@fooddash.com</small>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="contact-icon-box shadow-sm">
                            <i class="fa-solid fa-clock fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0">Business Hours</h6>
                            <small class="text-muted">Mon - Sun: 8:00 AM - 10:00 PM</small>
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="mt-4 pt-3 border-top">
                    <h6 class="fw-bold text-dark mb-3">Follow Us</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="social-btn">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-btn">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#" class="social-btn">
                            <i class="fa-brands fa-telegram"></i>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection