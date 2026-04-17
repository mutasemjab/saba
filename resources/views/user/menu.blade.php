@extends('layouts.front')


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


{{-- HERO --}}
<div class="menu-hero">
    <div class="menu-hero-bg" @if(!empty($bannerUrl)) style="background-image:url('{{ $bannerUrl }}')" @endif></div>
    <div class="menu-hero-content reveal">
        <h1>{{ __('front.menu_page_title') }} <span>{{ __('front.menu_page_title_span') }}</span></h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            <span class="sep">›</span>
            <span>{{ __('front.menu') }}</span>
            @if($activeCategory)
                <span class="sep">›</span>
                <span>{{ $locale==='ar' ? $activeCategory->name_ar : ($locale==='fr' ? $activeCategory->name_fr : $activeCategory->name_en) }}</span>
            @endif
        </div>
    </div>
</div>

{{-- MAIN --}}
<div class="menu-page-wrap">
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
                    {{ $locale==='ar' ? $cat->name_ar : ($locale==='fr' ? $cat->name_fr : $cat->name_en) }}
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
                    {{ $locale==='ar' ? $activeCategory->name_ar : ($locale==='fr' ? $activeCategory->name_fr : $activeCategory->name_en) }}
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
                         alt="{{ $locale==='ar' ? $p->name_ar : ($locale==='fr' ? $p->name_fr : $p->name_en) }}">
                    @if($p->is_featured==1)
                        <div class="prod-card-badge">{{ __('front.featured_tag') }}</div>
                    @endif
                </div>
                <div class="prod-card-body">
                    <div class="prod-card-cat">{{ $locale==='ar' ? ($p->category->name_ar??'') : ($locale==='fr' ? ($p->category->name_fr??'') : ($p->category->name_en??'')) }}</div>
                    <div class="prod-card-name">{{ $locale==='ar' ? $p->name_ar : ($locale==='fr' ? $p->name_fr : $p->name_en) }}</div>
                    <div class="prod-card-desc">{{ $locale==='ar' ? \Str::limit($p->description_ar,95) : ($locale==='fr' ? \Str::limit($p->description_fr,95) : \Str::limit($p->description_en,95)) }}</div>

                    {{-- ✅ Options أو سعر عادي --}}
                    @if($p->options->isNotEmpty())
                        <div class="prod-card-options">
                            @foreach($p->options as $opt)
                            <div class="prod-card-opt-row">
                                <span class="prod-card-opt-name">{{ $locale==='ar' ? $opt->name_ar : ($locale==='fr' ? $opt->name_fr : $opt->name_en) }}</span>
                                @if($opt->price)
                                <span class="prod-card-opt-price">
                                    {{ number_format($opt->price, 0) }}
                                    {{ $locale==='ar' ? ($opt->price_unit_ar ?? 'درهم') : ($locale==='fr' ? ($opt->price_unit_fr ?? 'MAD') : ($opt->price_unit_en ?? 'MAD')) }}
                                </span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="prod-card-footer">
                            @if($p->price??false)
                                <div class="prod-card-price">{{ $p->price }} {{ $locale==='ar' ? ($p->price_unit_ar??'درهم') : ($locale==='fr' ? ($p->price_unit_fr??'MAD') : ($p->price_unit_en??'MAD')) }}</div>
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
</div>{{-- /menu-page-wrap --}}

@endsection