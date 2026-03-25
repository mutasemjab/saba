@extends('layouts.front')

@push('styles')
<style>
/* ── MENU PAGE HERO ── */
.menu-hero{height:360px;position:relative;display:flex;align-items:center;justify-content:center;overflow:hidden}
.menu-hero-bg{position:absolute;inset:0;background-image:url('https://images.unsplash.com/photo-1544025162-d76694265947?w=1920&q=80');background-size:cover;background-position:center;filter:brightness(.28)}
.menu-hero-content{position:relative;z-index:2;text-align:center}
.menu-hero-content h1{font-family:'Amiri',serif;font-size:clamp(2.4rem,5vw,4rem);color:var(--cream);line-height:1.2;margin:10px 0 18px}
.menu-hero-content h1 span{color:var(--gold)}
.breadcrumb{display:flex;align-items:center;justify-content:center;gap:8px;font-size:.75rem;color:rgba(245,237,216,.4)}
.breadcrumb a{color:rgba(245,237,216,.4);text-decoration:none;transition:color .3s}
.breadcrumb a:hover{color:var(--gold)}
.breadcrumb .sep{color:var(--gold-dark)}

/* ── LAYOUT ── */
.menu-page{display:grid;grid-template-columns:240px 1fr;gap:50px;max-width:1280px;margin:0 auto;padding:80px 60px}

/* ── SIDEBAR ── */
.sidebar-title{font-family:'Amiri',serif;color:var(--gold);font-size:1rem;margin-bottom:14px;padding-bottom:9px;border-bottom:1px solid rgba(206,173,106,.15)}
.sidebar-list{list-style:none;display:flex;flex-direction:column;gap:3px}
.sidebar-list a{display:flex;align-items:center;justify-content:space-between;padding:11px 14px;color:rgba(245,237,216,.5);text-decoration:none;font-size:.87rem;transition:all .3s;border:1px solid transparent}
.sidebar-list a:hover,.sidebar-list a.active{color:var(--gold);background:rgba(206,173,106,.07);border-color:rgba(206,173,106,.18)}
.sidebar-list .cat-count{font-family:'Cinzel Decorative',serif;font-size:.62rem;color:var(--gold-dark)}

/* ── PRODUCTS AREA ── */
.products-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px}
.products-title{font-family:'Amiri',serif;font-size:1.4rem;color:var(--cream)}
.products-title span{color:var(--gold)}
.products-count{font-size:.72rem;color:rgba(245,237,216,.3);letter-spacing:2px}
.products-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:22px}

/* ── PRODUCT CARD ── */
.prod-card{background:linear-gradient(135deg,rgba(7,76,58,.1) 0%,rgba(4,12,8,.8) 100%);border:1px solid rgba(206,173,106,.12);overflow:hidden;transition:all .4s;text-decoration:none;display:flex;flex-direction:column}
.prod-card:hover{border-color:rgba(206,173,106,.42);transform:translateY(-6px);box-shadow:0 16px 48px rgba(206,173,106,.1)}
.prod-card-img{height:200px;overflow:hidden;position:relative}
.prod-card-img img{width:100%;height:100%;object-fit:cover;transition:transform .6s}
.prod-card:hover .prod-card-img img{transform:scale(1.07)}
.prod-card-badge{position:absolute;top:10px;right:10px;background:var(--gold);color:var(--dark-brown);font-size:.58rem;font-weight:700;padding:3px 10px;letter-spacing:1.5px;text-transform:uppercase}
.prod-card-body{padding:18px;flex:1;display:flex;flex-direction:column;gap:5px}
.prod-card-cat{font-size:.65rem;color:var(--gold-dark);letter-spacing:2px;text-transform:uppercase}
.prod-card-name{font-family:'Amiri',serif;font-size:1.1rem;color:var(--cream)}
.prod-card-desc{font-size:.77rem;color:rgba(245,237,216,.4);line-height:1.7;flex:1}
.prod-card-footer{display:flex;justify-content:space-between;align-items:center;margin-top:12px;padding-top:12px;border-top:1px solid rgba(206,173,106,.1)}
.prod-card-price{font-family:'Cinzel Decorative',serif;color:var(--gold);font-size:.9rem}
.prod-card-arrow{font-size:.7rem;color:rgba(206,173,106,.45);letter-spacing:2px;transition:color .3s}
.prod-card:hover .prod-card-arrow{color:var(--gold)}
.no-products{grid-column:1/-1;text-align:center;padding:80px;color:rgba(245,237,216,.3)}

/* ── OPTIONS على الكارد ── */
.prod-card-options{display:flex;flex-direction:column;gap:5px;margin-top:10px;padding-top:10px;border-top:1px solid rgba(206,173,106,.08)}
.prod-card-opt-row{display:flex;justify-content:space-between;align-items:center;padding:5px 8px;background:rgba(206,173,106,.04);border:1px solid rgba(206,173,106,.1);transition:border-color .2s}
.prod-card:hover .prod-card-opt-row{border-color:rgba(206,173,106,.22)}
.prod-card-opt-name{font-size:.72rem;color:rgba(245,237,216,.6)!important}
.prod-card-opt-price{font-family:'Cinzel Decorative',serif;font-size:.68rem;color:var(--gold)!important}

/* ── RESPONSIVE ── */
@media(max-width:900px){
    .menu-page{grid-template-columns:1fr;padding:50px 24px;gap:30px}
    .sidebar-list{flex-direction:row;flex-wrap:wrap}
    .sidebar-list a{padding:8px 14px;font-size:.8rem}
    .sidebar-title{display:none}
}
</style>
@endpush

@section('content')
@php
    $settingNav = $setting ?? \App\Models\Setting::first();
    $locale     = app()->getLocale();
    $current    = LaravelLocalization::getCurrentLocale();
    $target     = $current==='ar' ? 'en' : 'ar';
    $supported  = LaravelLocalization::getSupportedLocales();
    $targetName = $target==='ar' ? ($supported[$target]['native']??'العربية') : ($supported[$target]['native']??'English');
    $targetUrl  = LaravelLocalization::getLocalizedURL($target, null, [], true);
@endphp

{{-- NAVBAR --}}
<nav id="navbar" class="scrolled">
    <a href="{{ route('home') }}" class="nav-logo">
        <img src="{{ $settingNav&&$settingNav->logo ? asset('assets/admin/uploads/'.$settingNav->logo) : asset('assets_front/images/main_logo.png') }}" alt="سبأ">
    </a>
    <ul class="nav-links">
        <li><a href="{{ route('home') }}">{{ __('front.home') }}</a></li>
        <li><a href="{{ route('home') }}#about">{{ __('front.about') }}</a></li>
        <li><a href="{{ route('menu') }}" style="color:var(--gold)">{{ __('front.menu') }}</a></li>
        <li><a href="{{ route('home') }}#contact">{{ __('front.contact') }}</a></li>
        <li><a class="nav-lang" hreflang="{{ $target }}" href="{{ $targetUrl }}">{{ $targetName }}</a></li>
    </ul>
    <a href="{{ route('home') }}#contact" class="nav-reserve">{{ __('front.book_table') }}</a>
</nav>

{{-- HERO --}}
<div class="menu-hero">
    <div class="menu-hero-bg"></div>
    <div class="menu-hero-content reveal">
        <span class="section-label">{{ __('front.menu_label') }}</span>
        <h1>{{ __('front.menu_page_title') }} <span>{{ __('front.menu_page_title_span') }}</span></h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            <span class="sep">›</span>
            <span>{{ __('front.menu') }}</span>
            @if($activeCategory)
                <span class="sep">›</span>
                <span>{{ $locale==='ar' ? $activeCategory->name_ar : $activeCategory->name_en }}</span>
            @endif
        </div>
    </div>
</div>

{{-- MAIN --}}
<div class="menu-page">

    {{-- SIDEBAR --}}
    <aside>
        <div class="sidebar-title">{{ __('front.categories') }}</div>
        <ul class="sidebar-list">
            <li>
                <a href="{{ route('menu') }}" class="{{ !$categoryId ? 'active' : '' }}">
                    {{ __('front.all') }}
                    <span class="cat-count">{{ \App\Models\Product::count() }}</span>
                </a>
            </li>
            @foreach($categories as $cat)
            <li>
                <a href="{{ route('menu', ['category_id'=>$cat->id]) }}" class="{{ $categoryId==$cat->id ? 'active' : '' }}">
                    {{ $locale==='ar' ? $cat->name_ar : $cat->name_en }}
                    <span class="cat-count">{{ $cat->products_count }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </aside>

    {{-- PRODUCTS --}}
    <div>
        <div class="products-top">
            <div class="products-title">
                @if($activeCategory)
                    {{ $locale==='ar' ? $activeCategory->name_ar : $activeCategory->name_en }}
                @else
                    {{ __('front.all') }} <span>{{ __('front.dishes') }}</span>
                @endif
            </div>
            <div class="products-count">{{ $products->count() }} {{ __('front.item') }}</div>
        </div>

        <div class="products-grid">
            @forelse($products as $p)
            <a href="{{ route('product.show', $p->id) }}" class="prod-card">
                <div class="prod-card-img">
                    <img src="{{ asset('assets/admin/uploads/'.$p->photo) }}"
                         alt="{{ $locale==='ar' ? $p->name_ar : $p->name_en }}">
                    @if($p->is_featured==1)
                        <div class="prod-card-badge">{{ __('front.featured_tag') }}</div>
                    @endif
                </div>
                <div class="prod-card-body">
                    <div class="prod-card-cat">{{ $locale==='ar' ? ($p->category->name_ar??'') : ($p->category->name_en??'') }}</div>
                    <div class="prod-card-name">{{ $locale==='ar' ? $p->name_ar : $p->name_en }}</div>
                    <div class="prod-card-desc">{{ $locale==='ar' ? \Str::limit($p->description_ar,95) : \Str::limit($p->description_en,95) }}</div>

                    {{-- ✅ Options أو سعر عادي --}}
                    @if($p->options->isNotEmpty())
                        <div class="prod-card-options">
                            @foreach($p->options as $opt)
                            <div class="prod-card-opt-row">
                                <span class="prod-card-opt-name">{{ $locale==='ar' ? $opt->name_ar : $opt->name_en }}</span>
                                @if($opt->price)
                                <span class="prod-card-opt-price">
                                    {{ number_format($opt->price, 0) }}
                                    {{ $locale==='ar' ? ($opt->price_unit_ar ?? 'درهم') : ($opt->price_unit_en ?? 'MAD') }}
                                </span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="prod-card-footer">
                            @if($p->price??false)
                                <div class="prod-card-price">{{ $p->price }} {{ $locale==='ar' ? ($p->price_unit_ar??'درهم') : ($p->price_unit_en??'MAD') }}</div>
                            @else
                                <div></div>
                            @endif
                            <div class="prod-card-arrow">{{ __('front.view_details') }} ←</div>
                        </div>
                    @endif

                    {{-- السهم دايماً ظاهر لما في options --}}
                    @if($p->options->isNotEmpty())
                    <div style="margin-top:10px;text-align:left">
                        <span class="prod-card-arrow">{{ __('front.view_details') }} ←</span>
                    </div>
                    @endif
                </div>
            </a>
            @empty
            <div class="no-products">{{ __('front.no_products') }}</div>
            @endforelse
        </div>
    </div>

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
@endsection