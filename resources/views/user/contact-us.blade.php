@extends('layouts.front')

@push('styles')
<style>
    .contact-page-hero {
        min-height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        padding: 160px 24px 90px
    }

    .contact-page-content {
        position: relative;
        z-index: 10;
        text-align: center;
        max-width: 520px;
        margin: 0 auto
    }

    .contact-page-content .hero-logo-big {
        width: 190px
    }

    .contact-page-title {
        font-family: 'Amiri', serif;
        font-size: clamp(2rem, 4.5vw, 2.8rem);
        color: #fff;
        margin: 6px 0 14px;
        opacity: 0;
        animation: fadeInUp .8s .7s forwards
    }

    .contact-page-title span {
        color: var(--gold)
    }

    .contact-page-desc {
        font-size: .95rem;
        color: rgba(245, 237, 216, .7);
        line-height: 1.9;
        margin-bottom: 40px;
        opacity: 0;
        animation: fadeInUp .8s .85s forwards
    }

    .contact-social-row {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
        margin-bottom: 46px;
        opacity: 0;
        animation: fadeInUp .8s 1s forwards
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: flex-start;
        gap: 14px;
        width: 240px;
        text-decoration: none;
        color: var(--text-light);
        transition: transform .3s
    }

    .social-link:hover {
        transform: translateY(-2px)
    }

    .social-link .social-btn {
        width: 52px;
        height: 52px;
        font-size: 1.3rem;
        border-radius: 50%;
        border: 1px solid rgba(206, 173, 106, .35);
        flex-shrink: 0
    }

    .social-link:hover .social-btn {
        background: var(--gold);
        color: var(--dark-brown)
    }

    .social-link-name {
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: .5px
    }

    .social-link-name.is-number {
        direction: ltr
    }

    .contact-menu-btn {
        opacity: 0;
        animation: fadeInUp .8s 1.15s forwards;
        margin-bottom: 40px
    }

    .contact-menu-btn .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 17px 50px
    }

    .contact-divider-sm {
        width: 70px;
        height: 1px;
        background: linear-gradient(to right, transparent, var(--gold-dark), transparent);
        margin: 0 auto 40px;
        opacity: 0;
        animation: fadeInUp .8s 1.3s forwards
    }

    .contact-quick-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 34px;
        opacity: 0;
        animation: fadeInUp .8s 1.45s forwards
    }

    .contact-phone {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: var(--text-light)
    }

    .contact-phone-icon {
        width: 48px;
        height: 48px;
        border: 1px solid rgba(206, 173, 106, .4);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold);
        font-size: 1.05rem;
        transition: all .3s
    }

    .contact-phone:hover .contact-phone-icon {
        background: var(--gold);
        color: var(--dark-brown)
    }

    .contact-phone-text {
        text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }}
    }

    .contact-phone-label {
        font-size: .65rem;
        letter-spacing: 3px;
        color: var(--gold);
        text-transform: uppercase;
        margin-bottom: 3px
    }

    .contact-phone-value {
        font-size: 1.15rem;
        font-weight: 700;
        letter-spacing: 1px;
        display: inline-block
    }

    .contact-phone-value.is-number {
        direction: ltr
    }

    @media (max-width:480px) {
        .contact-page-hero {
            padding: 140px 18px 70px
        }

        .social-link {
            width: 210px
        }

        .social-link .social-btn {
            width: 46px;
            height: 46px;
            font-size: 1.15rem
        }

        .contact-quick-row {
            flex-direction: column;
            gap: 22px
        }
    }
</style>
@endpush

@section('content')
@php
    $settingNav = $setting ?? \App\Models\Setting::first();
    $banner     = \App\Models\Banner::first();
    $bannerUrl  = $banner ? asset('assets/admin/uploads/' . $banner->photo) : '';
@endphp

<section class="contact-page-hero">
    <div class="hero-banner-img" @if(!empty($bannerUrl)) style="background-image:url('{{ $bannerUrl }}')" @endif></div>
    <div class="hero-overlay"></div>
    <div class="hero-pattern"></div>

    <div class="hero-ornament">
        <svg viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
            <g fill="none" stroke="#cead6a" stroke-width="0.8">
                <circle cx="200" cy="200" r="180" />
                <circle cx="200" cy="200" r="150" />
                <circle cx="200" cy="200" r="100" />
                <polygon points="200,20 380,200 200,380 20,200" />
                <polygon points="200,50 350,200 200,350 50,200" />
                <line x1="200" y1="20" x2="200" y2="380" />
                <line x1="20" y1="200" x2="380" y2="200" />
                <line x1="74" y1="74" x2="326" y2="326" />
                <line x1="326" y1="74" x2="74" y2="326" />
                <circle cx="200" cy="200" r="10" />
            </g>
        </svg>
    </div>

    <div class="particles" id="particles"></div>

    <div class="contact-page-content">
        <img src="{{ $settingNav && $settingNav->logo
                ? asset('assets/admin/uploads/' . $settingNav->logo)
                : asset('assets_front/images/main_logo.png') }}"
            alt="{{ __('front.site_name') }}" class="hero-logo-big">

        <h1 class="contact-page-title">{{ __('front.contact_page_title') }} <span>{{ __('front.contact_page_title_span') }}</span></h1>
        <p class="contact-page-desc">{{ __('front.contact_page_desc') }}</p>

        {{-- Social links --}}
        <div class="contact-social-row">
            @if(!empty($settingNav->instagram))
                <a href="{{ $settingNav->instagram }}" target="_blank" rel="noopener" class="social-link" aria-label="Instagram">
                    <span class="social-btn"><i class="fab fa-instagram"></i></span>
                    <span class="social-link-name">Instagram</span>
                </a>
            @endif
            @if(!empty($settingNav->facebook))
                <a href="{{ $settingNav->facebook }}" target="_blank" rel="noopener" class="social-link" aria-label="Facebook">
                    <span class="social-btn"><i class="fab fa-facebook-f"></i></span>
                    <span class="social-link-name">Facebook</span>
                </a>
            @endif
            @if(!empty($settingNav->twitter))
                <a href="{{ $settingNav->twitter }}" target="_blank" rel="noopener" class="social-link" aria-label="X">
                    <span class="social-btn"><i class="fab fa-x-twitter"></i></span>
                    <span class="social-link-name">X</span>
                </a>
            @endif
            @if(!empty($settingNav->whatsapp_number))
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settingNav->whatsapp_number) }}" target="_blank" rel="noopener" class="social-link" aria-label="WhatsApp">
                    <span class="social-btn"><i class="fab fa-whatsapp"></i></span>
                    <span class="social-link-name is-number">{{ $settingNav->whatsapp_number }}</span>
                </a>
            @endif
        </div>
  {{-- Phone & Map --}}
        <div class="contact-quick-row">
            @if(!empty($settingNav->phone))
                <a href="tel:{{ $settingNav->phone }}" class="contact-phone">
                    <span class="contact-phone-icon"><i class="fas fa-phone-alt"></i></span>
                    <span class="contact-phone-text">
                        <span class="contact-phone-value is-number">{{ $settingNav->phone }}</span>
                    </span>
                </a>
            @endif

            @if(!empty($settingNav->google_map))
                <a href="{{ $settingNav->google_map }}" target="_blank" rel="noopener" class="contact-phone">
                    <span class="contact-phone-icon"><i class="fas fa-map-marker-alt"></i></span>
                    <span class="contact-phone-text">
                        <span class="contact-phone-value">{{ __('front.find_on_map') }}</span>
                    </span>
                </a>
            @endif
        </div>
        {{-- Menu button --}}
        <div class="contact-menu-btn">
            <a href="{{ route('menu') }}" class="btn-primary"><span><i class="fas fa-utensils"></i> {{ __('front.explore_menu') }}</span></a>
        </div>

      
    </div>
</section>
@endsection
