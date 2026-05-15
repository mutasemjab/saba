{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    NAVBAR
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
@php
    $settingNav  = $setting ?? cache()->remember('site_setting', 3600, fn() => \App\Models\Setting::first());
    $current     = LaravelLocalization::getCurrentLocale();
    $supported   = LaravelLocalization::getSupportedLocales();
    $currentName = $supported[$current]['native'] ?? strtoupper($current);
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
        {{-- Desktop language dropdown --}}
        <li class="lang-dropdown-wrap">
            <button class="nav-lang lang-dropdown-btn" aria-haspopup="listbox" aria-expanded="false">
                {{ $currentName }}<svg class="lang-chevron" viewBox="0 0 10 6" width="10" height="6" fill="none"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <ul class="lang-dropdown-menu" role="listbox">
                @foreach($supported as $locale => $props)
                    @if($locale !== $current)
                        <li role="option">
                            <a hreflang="{{ $locale }}" href="{{ LaravelLocalization::getLocalizedURL($locale, null, [], true) }}">{{ $props['native'] }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
    </ul>
    {{-- Mobile-only lang dropdown (shown next to hamburger) --}}
    <div class="nav-mobile-lang lang-dropdown-wrap">
        <button class="lang-dropdown-btn" aria-haspopup="listbox" aria-expanded="false">
            {{ $currentName }}<svg class="lang-chevron" viewBox="0 0 10 6" width="10" height="6" fill="none"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <ul class="lang-dropdown-menu" role="listbox">
            @foreach($supported as $locale => $props)
                @if($locale !== $current)
                    <li role="option">
                        <a hreflang="{{ $locale }}" href="{{ LaravelLocalization::getLocalizedURL($locale, null, [], true) }}">{{ $props['native'] }}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
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
        {{-- Drawer language dropdown --}}
        <li class="lang-dropdown-wrap drawer-lang-wrap">
            <button class="nav-drawer-lang lang-dropdown-btn" aria-haspopup="listbox" aria-expanded="false">
                {{ $currentName }}<svg class="lang-chevron" viewBox="0 0 10 6" width="10" height="6" fill="none"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <ul class="lang-dropdown-menu drawer-lang-menu">
                @foreach($supported as $locale => $props)
                    @if($locale !== $current)
                        <li>
                            <a onclick="toggleDrawer()" hreflang="{{ $locale }}" href="{{ LaravelLocalization::getLocalizedURL($locale, null, [], true) }}">{{ $props['native'] }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
    </ul>
</div>

<script>
function toggleDrawer() {
    document.getElementById('navDrawer').classList.toggle('open');
    document.getElementById('drawerOverlay').classList.toggle('open');
    document.body.classList.toggle('drawer-open');
}

(function () {
    function closeAll() {
        document.querySelectorAll('.lang-dropdown-menu.open').forEach(function (m) {
            m.classList.remove('open');
            var btn = m.closest('.lang-dropdown-wrap').querySelector('.lang-dropdown-btn');
            if (btn) btn.setAttribute('aria-expanded', 'false');
        });
    }

    document.addEventListener('click', closeAll);

    document.querySelectorAll('.lang-dropdown-wrap').forEach(function (wrap) {
        var btn  = wrap.querySelector('.lang-dropdown-btn');
        var menu = wrap.querySelector('.lang-dropdown-menu');
        if (!btn || !menu) return;
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            var isOpen = menu.classList.contains('open');
            closeAll();
            if (!isOpen) {
                menu.classList.add('open');
                btn.setAttribute('aria-expanded', 'true');
            }
        });
    });
}());
</script>
