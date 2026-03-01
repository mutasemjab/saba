{{-- ══════════════════════════════ FOOTER ══════════════════════════════ --}}
<footer>
    <div class="footer-top">
        <div class="footer-brand">
            <img src="{{ $settingNav && $settingNav->logo ? asset('assets/admin/uploads/'.$settingNav->logo) : asset('assets_front/images/main_logo.png') }}" alt="سبأ" class="footer-brand-logo">
            <p>{{ __('front.footer_about') }}</p>
            <div class="footer-social">
                @if($settingNav->instagram)<a href="{{ $settingNav->instagram }}" target="_blank" class="social-btn"><i class="fab fa-instagram"></i></a>@endif
                @if($settingNav->facebook)<a href="{{ $settingNav->facebook }}" target="_blank" class="social-btn"><i class="fab fa-facebook-f"></i></a>@endif
                @if($settingNav->twitter)<a href="{{ $settingNav->twitter }}" target="_blank" class="social-btn"><i class="fab fa-x-twitter"></i></a>@endif
            </div>
        </div>
        <div class="footer-col">
            <h4>{{ __('front.quick_links') }}</h4>
            <ul>
                <li><a href="#about">{{ __('front.about') }}</a></li>
                <li><a href="#best">{{ __('front.featured') }}</a></li>
                <li><a href="{{ route('menu') }}">{{ __('front.menu') }}</a></li>
                <li><a href="#videos">{{ __('front.videos') }}</a></li>
                <li><a href="#hours">{{ __('front.hours') }}</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>{{ __('front.services') }}</h4>
            <ul>
                <li><a href="#contact">{{ __('front.table_booking') }}</a></li>
                <li><a href="#">{{ __('front.delivery') }}</a></li>
                <li><a href="#">{{ __('front.events') }}</a></li>
                <li><a href="#">{{ __('front.catering') }}</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>{{ __('front.contact') }}</h4>
            <ul>
                <li><a href="#">{{ $settingNav->address ?? '' }}</a></li>
                <li><a href="tel:{{ $settingNav->phone ?? '' }}">{{ $settingNav->phone ?? '' }}</a></li>
                <li><a href="mailto:{{ $settingNav->email ?? '' }}">{{ $settingNav->email ?? '' }}</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p class="footer-copy">© {{ date('Y') }} <span>{{ __('front.site_name') }}</span> · {{ __('front.all_rights') }}</p>
        <div class="footer-ornament">⬡ سبأ ⬡</div>
    </div>
</footer>
