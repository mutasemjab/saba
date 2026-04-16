{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    NAVBAR
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
@php
    $settingNav = $setting ?? \App\Models\Setting::first();
    $current    = LaravelLocalization::getCurrentLocale();
    $target     = $current === 'ar' ? 'en' : ($current === 'en' ? 'fr' : 'ar');
    $supported  = LaravelLocalization::getSupportedLocales();
    $targetName = $supported[$target]['native'] ?? $target;
    $targetUrl  = LaravelLocalization::getLocalizedURL($target, null, [], true);
@endphp
{{-- ══════════════════════════════ NAVBAR ══════════════════════════════ --}}
<nav id="navbar">
    <a href="{{ route('home') }}" class="nav-logo">
        <img src="{{ $settingNav && $settingNav->logo ? asset('assets/admin/uploads/'.$settingNav->logo) : asset('assets_front/images/main_logo.png') }}" alt="سبأ">
    </a>
    <ul class="nav-links">
        <li><a href="#about">{{ __('front.about') }}</a></li>
        <li><a href="#best">{{ __('front.featured') }}</a></li>
        <li><a href="#menu">{{ __('front.menu') }}</a></li>
        <li><a href="#videos">{{ __('front.videos') }}</a></li>
        <li><a href="#hours">{{ __('front.hours') }}</a></li>
        <li><a href="#contact">{{ __('front.contact') }}</a></li>
        <li><a class="nav-lang" hreflang="{{ $target }}" href="{{ $targetUrl }}">{{ $targetName }}</a></li>
    </ul>
    <a href="#contact" class="nav-reserve">{{ __('front.book_table') }}</a>
</nav>