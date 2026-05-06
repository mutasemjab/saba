{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    NAVBAR
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
@php
    $settingNav = $setting ?? cache()->remember('site_setting', 3600, fn() => \App\Models\Setting::first());
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
        <li><a href="{{ route('home') }}#about">{{ __('front.about') }}</a></li>
        <li><a href="{{ route('home') }}#best">{{ __('front.featured') }}</a></li>
        <li><a href="{{ route('menu') }}">{{ __('front.menu') }}</a></li>
        <li><a href="{{ route('home') }}#videos">{{ __('front.videos') }}</a></li>
        <li><a href="{{ route('home') }}#hours">{{ __('front.hours') }}</a></li>
        <li><a href="{{ route('home') }}#contact">{{ __('front.contact') }}</a></li>
        <li><a class="nav-lang" hreflang="{{ $target }}" href="{{ $targetUrl }}">{{ $targetName }}</a></li>
    </ul>
    {{-- Mobile-only lang button (shown next to hamburger) --}}
    <a class="nav-mobile-lang" hreflang="{{ $target }}" href="{{ $targetUrl }}">{{ $targetName }}</a>
    {{-- Mobile hamburger --}}
    <button class="nav-hamburger" id="navHamburger" aria-label="Menu" onclick="toggleDrawer()">
        <span></span><span></span><span></span>
    </button>
</nav>

{{-- Mobile Drawer --}}
<div class="nav-drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>
<div class="nav-drawer" id="navDrawer">
    <button class="nav-drawer-close" onclick="toggleDrawer()" aria-label="Close">✕</button>
    <a href="{{ route('home') }}" class="nav-drawer-logo">
        <img src="{{ $settingNav && $settingNav->logo ? asset('assets/admin/uploads/'.$settingNav->logo) : asset('assets_front/images/main_logo.png') }}" alt="سبأ">
    </a>
    <ul class="nav-drawer-links">
        <li><a href="{{ route('home') }}#about"   onclick="toggleDrawer()">{{ __('front.about') }}</a></li>
        <li><a href="{{ route('home') }}#best"    onclick="toggleDrawer()">{{ __('front.featured') }}</a></li>
        <li><a href="{{ route('menu') }}"         onclick="toggleDrawer()">{{ __('front.menu') }}</a></li>
        <li><a href="{{ route('home') }}#videos"  onclick="toggleDrawer()">{{ __('front.videos') }}</a></li>
        <li><a href="{{ route('home') }}#hours"   onclick="toggleDrawer()">{{ __('front.hours') }}</a></li>
        <li><a href="{{ route('home') }}#contact" onclick="toggleDrawer()">{{ __('front.contact') }}</a></li>
        <li><a class="nav-drawer-lang" hreflang="{{ $target }}" href="{{ $targetUrl }}">{{ $targetName }}</a></li>
    </ul>
</div>

<script>
function toggleDrawer() {
    document.getElementById('navDrawer').classList.toggle('open');
    document.getElementById('drawerOverlay').classList.toggle('open');
    document.body.classList.toggle('drawer-open');
}
</script>