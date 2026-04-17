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

<div class="product-wrap-bg">
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

            {{-- Options or simple price --}}
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
</div>{{-- /product-wrap-bg --}}

@push('scripts')
<script>
function selectOption(el) {
    document.querySelectorAll('.product-option-row').forEach(r => r.classList.remove('selected'));
    el.classList.add('selected');
}
</script>
@endpush

@endsection
