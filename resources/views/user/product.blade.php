@extends('layouts.front')

@push('styles')
<style>
/* ── PRODUCT PAGE ── */
.product-wrap{max-width:1280px;margin:0 auto;padding:120px 60px 90px}

/* ── PRODUCT HERO GRID ── */
.product-hero{display:grid;grid-template-columns:1fr 1fr;gap:72px;align-items:start;margin-bottom:100px}

/* Image */
.product-img-box{position:relative;overflow:hidden}
.product-img-box img{width:100%;height:520px;object-fit:cover;display:block;transition:transform .8s}
.product-img-box:hover img{transform:scale(1.04)}
.pic-corner{position:absolute;width:44px;height:44px}
.pic-corner.tl{top:0;right:0;border-top:2px solid var(--gold);border-right:2px solid var(--gold)}
.pic-corner.br{bottom:0;left:0;border-bottom:2px solid var(--gold);border-left:2px solid var(--gold)}
.pic-badge{position:absolute;top:16px;right:16px;background:var(--gold);color:var(--dark-brown);font-size:.6rem;font-weight:700;padding:4px 12px;letter-spacing:2px;text-transform:uppercase}

/* Info */
.product-bc{display:flex;align-items:center;gap:7px;font-size:.7rem;color:rgba(245,237,216,.32);margin-bottom:18px;flex-wrap:wrap}
.product-bc a{color:rgba(245,237,216,.32);text-decoration:none;transition:color .3s}.product-bc a:hover{color:var(--gold)}
.product-bc .sep{color:var(--gold-dark)}
.product-cat-label{font-family:'Cinzel Decorative',serif;font-size:.62rem;color:var(--gold);letter-spacing:4px;text-transform:uppercase;display:block;margin-bottom:10px}
.product-name{font-family:'Amiri',serif;font-size:clamp(2rem,4vw,3.2rem);color:var(--cream);line-height:1.2;margin-bottom:18px}
.product-ornament{display:flex;align-items:center;gap:10px;margin-bottom:24px}
.product-ornament::before,.product-ornament::after{content:'';height:1px;width:36px}
.product-ornament::before{background:linear-gradient(to right,var(--gold),transparent)}
.product-ornament::after{background:linear-gradient(to left,var(--gold),transparent)}
.product-ornament-gem{width:6px;height:6px;background:var(--gold);transform:rotate(45deg)}
.product-desc{font-size:1rem;line-height:2;color:rgba(245,237,216,.67);margin-bottom:30px;font-weight:300}

/* ── OPTIONS ── */
.product-options-wrap{margin-bottom:30px}
.product-options-label{font-size:.65rem;letter-spacing:3px;color:var(--gold);text-transform:uppercase;margin-bottom:14px;display:block}
.product-options-list{display:flex;flex-direction:column;gap:10px}
.product-option-row{display:flex;align-items:center;justify-content:space-between;padding:14px 20px;background:rgba(206,173,106,.05);border:1px solid rgba(206,173,106,.14);transition:all .3s;cursor:pointer}
.product-option-row:hover,.product-option-row.selected{background:rgba(206,173,106,.1);border-color:rgba(206,173,106,.42)}
.product-option-row.selected{border-color:var(--gold)}
.product-option-name{font-family:'Amiri',serif;font-size:1.05rem;color:var(--cream)}
.product-option-price{font-family:'Cinzel Decorative',serif;font-size:.9rem;color:var(--gold)}
.product-option-unit{font-size:.7rem;color:rgba(245,237,216,.35);margin-right:4px}
.product-option-radio{width:14px;height:14px;border:1px solid rgba(206,173,106,.4);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .3s}
.product-option-row.selected .product-option-radio{border-color:var(--gold)}
.product-option-radio-dot{width:6px;height:6px;background:var(--gold);border-radius:50%;opacity:0;transition:opacity .2s}
.product-option-row.selected .product-option-radio-dot{opacity:1}

/* Price box — عادي بدون options */
.product-price-box{display:flex;align-items:center;gap:18px;padding:20px;background:rgba(206,173,106,.05);border:1px solid rgba(206,173,106,.15);margin-bottom:30px}
.price-label{font-size:.65rem;color:var(--gold-dark);letter-spacing:3px;text-transform:uppercase;margin-bottom:4px}
.price-val{font-family:'Cinzel Decorative',serif;font-size:1.9rem;color:var(--gold);line-height:1}
.price-unit{font-size:.78rem;color:rgba(245,237,216,.35);margin-top:3px}

.product-actions{display:flex;gap:14px;flex-wrap:wrap;margin-bottom:28px}
.product-actions .btn-primary{flex:1;text-align:center;border:none;font-size:.95rem}
.product-meta{border-top:1px solid rgba(206,173,106,.1);padding-top:20px;display:flex;flex-direction:column;gap:9px}
.meta-row{display:flex;gap:10px;font-size:.82rem}
.meta-row .lbl{color:var(--gold-dark);min-width:90px}
.meta-row .val{color:rgba(245,237,216,.5)}

/* ── SIMILAR ── */
.similar-wrap{border-top:1px solid rgba(206,173,106,.1);padding-top:80px}
.similar-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:20px;margin-top:46px}
.sim-card{background:rgba(7,76,58,.07);border:1px solid rgba(206,173,106,.1);text-decoration:none;display:block;transition:all .4s;overflow:hidden}
.sim-card:hover{border-color:rgba(206,173,106,.38);transform:translateY(-5px);box-shadow:0 12px 40px rgba(206,173,106,.1)}
.sim-card-img{height:165px;overflow:hidden}
.sim-card-img img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
.sim-card:hover .sim-card-img img{transform:scale(1.08)}
.sim-card-body{padding:15px}
.sim-card-cat{font-size:.63rem;color:var(--gold-dark);letter-spacing:2px;text-transform:uppercase;margin-bottom:4px}
.sim-card-name{font-family:'Amiri',serif;font-size:.98rem;color:var(--cream);margin-bottom:6px}
.sim-card-price{font-family:'Cinzel Decorative',serif;font-size:.78rem;color:var(--gold)}

@media(max-width:900px){
    .product-wrap{padding:90px 24px 60px}
    .product-hero{grid-template-columns:1fr;gap:36px}
    .product-img-box img{height:300px}
    .similar-grid{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:480px){
    .similar-grid{grid-template-columns:1fr}
}
</style>
@endpush

@section('content')
@php
    $settingNav = $setting ?? \App\Models\Setting::first();
    $locale     = app()->getLocale();
    $current    = LaravelLocalization::getCurrentLocale();
    $target     = $current==='ar' ? 'en' : ($current==='en' ? 'fr' : 'ar');
    $supported  = LaravelLocalization::getSupportedLocales();
    $targetName = $supported[$target]['native'] ?? $target;
    $targetUrl  = LaravelLocalization::getLocalizedURL($target, null, [], true);
@endphp

{{-- NAVBAR --}}
<nav id="navbar" class="scrolled">
    <a href="{{ route('home') }}" class="nav-logo">
        <img src="{{ $settingNav&&$settingNav->logo ? asset('assets/admin/uploads/'.$settingNav->logo) : asset('assets_front/images/main_logo.png') }}" alt="سبأ">
    </a>
    <ul class="nav-links">
        <li><a href="{{ route('home') }}">{{ __('front.home') }}</a></li>
        <li><a href="{{ route('menu') }}">{{ __('front.menu') }}</a></li>
        <li><a href="{{ route('home') }}#contact">{{ __('front.contact') }}</a></li>
        <li><a class="nav-lang" hreflang="{{ $target }}" href="{{ $targetUrl }}">{{ $targetName }}</a></li>
    </ul>
    <a href="{{ route('home') }}#contact" class="nav-reserve">{{ __('front.book_table') }}</a>
</nav>

<div class="product-wrap">

    {{-- ════════════════════ PRODUCT HERO ════════════════════ --}}
    <div class="product-hero">

        {{-- Image --}}
        <div class="product-img-box reveal-left">
            <img src="{{ asset('assets/admin/uploads/'.$product->photo) }}"
                 alt="{{ $locale==='ar' ? $product->name_ar : ($locale==='fr' ? $product->name_fr : $product->name_en) }}">
            <div class="pic-corner tl"></div>
            <div class="pic-corner br"></div>
            @if($product->is_featured==1)
                <div class="pic-badge">{{ __('front.featured_tag') }}</div>
            @endif
        </div>

        {{-- Info --}}
        <div class="product-info reveal-right">

            {{-- Breadcrumb --}}
            <div class="product-bc">
                <a href="{{ route('home') }}">{{ __('front.home') }}</a>
                <span class="sep">›</span>
                <a href="{{ route('menu') }}">{{ __('front.menu') }}</a>
                @if($product->category)
                <span class="sep">›</span>
                <a href="{{ route('menu', ['category_id'=>$product->category_id]) }}">
                    {{ $locale==='ar' ? ($product->category->name_ar??'') : ($locale==='fr' ? ($product->category->name_fr??'') : ($product->category->name_en??'')) }}
                </a>
                @endif
                <span class="sep">›</span>
                <span>{{ $locale==='ar' ? \Str::limit($product->name_ar,30) : ($locale==='fr' ? \Str::limit($product->name_fr,30) : \Str::limit($product->name_en,30)) }}</span>
            </div>

            {{-- Category --}}
            @if($product->category)
            <span class="product-cat-label">{{ $locale==='ar' ? ($product->category->name_ar??'') : ($locale==='fr' ? ($product->category->name_fr??'') : ($product->category->name_en??'')) }}</span>
            @endif

            {{-- Name --}}
            <h1 class="product-name">{{ $locale==='ar' ? $product->name_ar : ($locale==='fr' ? $product->name_fr : $product->name_en) }}</h1>

            <div class="product-ornament"><div class="product-ornament-gem"></div></div>

            {{-- Description --}}
            <div class="product-desc">{!! $locale==='ar' ? $product->description_ar : ($locale==='fr' ? $product->description_fr : $product->description_en) !!}</div>

            {{-- ✅ Options أو سعر عادي --}}
            @if($product->options->isNotEmpty())
                <div class="product-options-wrap">
                    <span class="product-options-label">{{ __('front.choose_size') }}</span>
                    <div class="product-options-list">
                        @foreach($product->options as $i => $opt)
                        <div class="product-option-row {{ $i === 0 ? 'selected' : '' }}"
                             onclick="selectOption(this)">
                            <div style="display:flex;align-items:center;gap:12px">
                                <div class="product-option-radio">
                                    <div class="product-option-radio-dot"></div>
                                </div>
                                <div class="product-option-name">
                                    {{ $locale==='ar' ? $opt->name_ar : ($locale==='fr' ? $opt->name_fr : $opt->name_en) }}
                                </div>
                            </div>
                            @if($opt->price)
                            <div style="display:flex;align-items:baseline;gap:5px">
                                <div class="product-option-price">{{ number_format($opt->price, 0) }}</div>
                                <div class="product-option-unit">
                                    {{ $locale==='ar' ? ($opt->price_unit_ar ?? 'درهم') : ($locale==='fr' ? ($opt->price_unit_fr ?? 'MAD') : ($opt->price_unit_en ?? 'MAD')) }}
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

            @elseif($product->price ?? false)
                <div class="product-price-box">
                    <div>
                        <div class="price-label">{{ __('front.price') }}</div>
                        <div class="price-val">{{ $product->price }}</div>
                        <div class="price-unit">{{ $locale==='ar' ? ($product->price_unit_ar??'درهم') : ($locale==='fr' ? ($product->price_unit_fr??'MAD') : ($product->price_unit_en??'MAD')) }}</div>
                    </div>
                </div>
            @endif

            {{-- Actions --}}
            <div class="product-actions">
                <a href="{{ route('home') }}#contact" class="btn-primary"><span>{{ __('front.order_now') }} ←</span></a>
                <a href="{{ route('menu', ['category_id'=>$product->category_id]) }}" class="btn-outline">{{ __('front.more_from_category') }}</a>
            </div>

            {{-- Meta --}}
            <div class="product-meta">
                @if($product->category)
                <div class="meta-row">
                    <span class="lbl">{{ __('front.category') }}</span>
                    <span class="val">{{ $locale==='ar' ? ($product->category->name_ar??'') : ($locale==='fr' ? ($product->category->name_fr??'') : ($product->category->name_en??'')) }}</span>
                </div>
                @endif
                @if($product->is_featured==1)
                <div class="meta-row">
                    <span class="lbl">{{ __('front.status') }}</span>
                    <span class="val" style="color:var(--gold)">{{ __('front.featured_tag') }}</span>
                </div>
                @endif
            </div>

        </div>
    </div>

    {{-- ════════════════════ SIMILAR PRODUCTS ════════════════════ --}}
    @if($similar->isNotEmpty())
    <div class="similar-wrap">
        <div class="section-header reveal" style="margin-bottom:0">
            <span class="section-label">{{ __('front.similar_label') }}</span>
            <h2 class="section-title">{{ __('front.similar_title') }} <span>{{ __('front.similar_title_span') }}</span></h2>
            <div class="ornament-divider"><div class="ornament-divider-center"></div></div>
            <p class="section-desc">{{ __('front.similar_desc') }}</p>
        </div>
        <div class="similar-grid">
            @foreach($similar as $item)
            <a href="{{ route('product.show', $item->id) }}" class="sim-card reveal">
                <div class="sim-card-img">
                    <img src="{{ asset('assets/admin/uploads/'.$item->photo) }}"
                         alt="{{ $locale==='ar' ? $item->name_ar : ($locale==='fr' ? $item->name_fr : $item->name_en) }}">
                </div>
                <div class="sim-card-body">
                    <div class="sim-card-cat">{{ $locale==='ar' ? ($item->category->name_ar??'') : ($locale==='fr' ? ($item->category->name_fr??'') : ($item->category->name_en??'')) }}</div>
                    <div class="sim-card-name">{{ $locale==='ar' ? $item->name_ar : ($locale==='fr' ? $item->name_fr : $item->name_en) }}</div>

                    {{-- ✅ options أو سعر عادي في الـ similar card --}}
                    @if($item->options->isNotEmpty())
                        <div class="sim-card-price">
                            {{ __('front.from') }}
                            {{ number_format($item->options->min('price'), 0) }}
                            {{ $locale==='ar' ? ($item->options->first()->price_unit_ar ?? 'درهم') : ($locale==='fr' ? ($item->options->first()->price_unit_fr ?? 'MAD') : ($item->options->first()->price_unit_en ?? 'MAD')) }}
                        </div>
                    @elseif($item->price ?? false)
                        <div class="sim-card-price">
                            {{ $item->price }}
                            {{ $locale==='ar' ? ($item->price_unit_ar??'درهم') : ($locale==='fr' ? ($item->price_unit_fr??'MAD') : ($item->price_unit_en??'MAD')) }}
                        </div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
        <div style="text-align:center;margin-top:44px;">
            <a href="{{ route('menu') }}" class="btn-outline">{{ __('front.view_full_menu') }} ←</a>
        </div>
    </div>
    @endif

</div>

{{-- FOOTER --}}
<footer>
    <div class="footer-top">
        <div class="footer-brand">
            <img src="{{ $settingNav&&$settingNav->logo ? asset('assets/admin/uploads/'.$settingNav->logo) : asset('assets_front/images/main_logo.png') }}" alt="سبأ" class="footer-brand-logo">
            <p>{{ __('front.footer_about') }}</p>
            <div class="footer-social">
                @if($settingNav->instagram??false)<a href="{{ $settingNav->instagram }}" target="_blank" class="social-btn"><i class="fab fa-instagram"></i></a>@endif
                @if($settingNav->facebook??false)<a href="{{ $settingNav->facebook }}" target="_blank" class="social-btn"><i class="fab fa-facebook-f"></i></a>@endif
                @if($settingNav->twitter??false)<a href="{{ $settingNav->twitter }}" target="_blank" class="social-btn"><i class="fab fa-x-twitter"></i></a>@endif
            </div>
        </div>
        <div class="footer-col">
            <h4>{{ __('front.quick_links') }}</h4>
            <ul>
                <li><a href="{{ route('home') }}">{{ __('front.home') }}</a></li>
                <li><a href="{{ route('menu') }}">{{ __('front.menu') }}</a></li>
                <li><a href="{{ route('home') }}#about">{{ __('front.about') }}</a></li>
                <li><a href="{{ route('home') }}#contact">{{ __('front.contact') }}</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>{{ __('front.contact') }}</h4>
            <ul>
                <li><a href="#">{{ $settingNav->address??'' }}</a></li>
                <li><a href="tel:{{ $settingNav->phone??'' }}">{{ $settingNav->phone??'' }}</a></li>
                <li><a href="mailto:{{ $settingNav->email??'' }}">{{ $settingNav->email??'' }}</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p class="footer-copy">© {{ date('Y') }} <span>{{ __('front.site_name') }}</span> · {{ __('front.all_rights') }}</p>
        <div class="footer-ornament">⬡ سبأ ⬡</div>
    </div>
</footer>

@push('scripts')
<script>
function selectOption(el) {
    document.querySelectorAll('.product-option-row').forEach(r => r.classList.remove('selected'));
    el.classList.add('selected');
}
</script>
@endpush

@endsection