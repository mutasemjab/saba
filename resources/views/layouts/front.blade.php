<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>مطاعم سبأ | Sab'a Restaurants</title>
    {{-- Critical CSS first --}}
    <link rel="stylesheet" href="{{ asset('assets_front/CSS/main_styles.css') }}">

    {{-- Fonts: async, non-blocking --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" onload="this.rel='stylesheet'"
        href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Cinzel+Decorative:wght@400;700;900&family=Tajawal:wght@300;400;500;700;900&display=swap">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Cinzel+Decorative:wght@400;700;900&family=Tajawal:wght@300;400;500;700;900&display=swap">
    </noscript>

    {{-- Font Awesome: async, non-blocking --}}
    <link rel="preload" as="style" onload="this.rel='stylesheet'"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </noscript>

    @stack('styles')
</head>

<body>

    {{-- PRELOADER --}}
    <div id="preloader">
        @php $settingGlobal = $setting ?? cache()->remember('site_setting', 3600, fn() => \App\Models\Setting::first()); @endphp
        <img src="{{ $settingGlobal && $settingGlobal->logo
            ? asset('assets/admin/uploads/' . $settingGlobal->logo)
            : asset('assets_front/images/main_logo.png') }}"
            alt="سبأ" class="preloader-logo">
        <div class="preloader-bar">
            <div class="preloader-fill"></div>
        </div>
    </div>

    @include('user.includes.navbar')

    @yield('content')
    <!-- Footer -->
    @include('user.includes.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Preloader — hide once page fully loads (max 400ms extra)
        window.addEventListener('load', () => setTimeout(() => document.getElementById('preloader').classList.add('done'),
            400));

        // Navbar
        window.addEventListener('scroll', () => document.getElementById('navbar').classList.toggle('scrolled', window
            .scrollY > 60));

        // Particles
        const pc = document.getElementById('particles');
        if (pc)
            for (let i = 0; i < 20; i++) {
                const p = document.createElement('div');
                p.className = 'particle';
                const s = Math.random() * 3 + 2;
                p.style.cssText =
                    `width:${s}px;height:${s}px;left:${Math.random()*100}%;animation-duration:${Math.random()*14+10}s;animation-delay:${Math.random()*10}s;`;
                pc.appendChild(p);
            }

        // Reveal
        const obs = new IntersectionObserver(entries => entries.forEach(e => e.isIntersecting && e.target.classList.add(
            'visible')), {
            threshold: .1
        });
        document.querySelectorAll('.reveal,.reveal-left,.reveal-right').forEach(el => obs.observe(el));

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const t = document.querySelector(a.getAttribute('href'));
                if (t) {
                    e.preventDefault();
                    t.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
