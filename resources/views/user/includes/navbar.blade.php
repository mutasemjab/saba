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
        <li><a href="{{route('menu')}}">{{ __('front.menu') }}</a></li>
        <li><a href="#videos">{{ __('front.videos') }}</a></li>
        <li><a href="#hours">{{ __('front.hours') }}</a></li>
        <li><a href="#contact">{{ __('front.contact') }}</a></li>
        <li><a class="nav-lang" hreflang="{{ $target }}" href="{{ $targetUrl }}">{{ $targetName }}</a></li>
    </ul>
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
        <li><a href="#about"   onclick="toggleDrawer()">{{ __('front.about') }}</a></li>
        <li><a href="#best"    onclick="toggleDrawer()">{{ __('front.featured') }}</a></li>
        <li><a href="{{route('menu')}}"    onclick="toggleDrawer()">{{ __('front.menu') }}</a></li>
        <li><a href="#videos"  onclick="toggleDrawer()">{{ __('front.videos') }}</a></li>
        <li><a href="#hours"   onclick="toggleDrawer()">{{ __('front.hours') }}</a></li>
        <li><a href="#contact" onclick="toggleDrawer()">{{ __('front.contact') }}</a></li>
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