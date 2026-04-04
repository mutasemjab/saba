@extends('layouts.front')

@section('content')

    @php
        $settingNav = $setting ?? \App\Models\Setting::first();
        $current = LaravelLocalization::getCurrentLocale();
        $target = $current === 'ar' ? 'en' : 'ar';
        $supported = LaravelLocalization::getSupportedLocales();
        $targetName =
            $target === 'ar' ? $supported[$target]['native'] ?? 'العربية' : $supported[$target]['native'] ?? 'English';
        $targetUrl = LaravelLocalization::getLocalizedURL($target, null, [], true);
    @endphp



    {{-- ══════════════════════════════════════════════════════════════
     HERO
══════════════════════════════════════════════════════════════ --}}
    @php
        $banner = \App\Models\Banner::first();
        $bannerUrl = $banner ? asset('assets/admin/uploads/' . $banner->photo) : '';
    @endphp

    <section id="hero">
        <div class="hero-banner-img" style="background-image:url('{{ $bannerUrl }}');"></div>
        <div class="hero-overlay"></div>
        <div class="hero-pattern"></div>

        <div class="hero-ornament">
            <svg viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                <g fill="none" stroke="#cead6a" stroke-width="0.8">
                    <circle cx="200" cy="200" r="180" />
                    <circle cx="200" cy="200" r="150" />
                    <circle cx="200" cy="200" r="100" />
                    <polygon points="200,20 380,200 200,380 20,200" />
                    <polygon points="200,50 350,200 200,350 50,200" />
                    <line x1="200" y1="20" x2="200" y2="380" />
                    <line x1="20" y1="200" x2="380" y2="200" />
                    <line x1="74" y1="74" x2="326" y2="326" />
                    <line x1="326" y1="74" x2="74" y2="326" />
                    <circle cx="200" cy="200" r="10" />
                </g>
            </svg>
        </div>

        <div class="particles" id="particles"></div>

        <div class="hero-content">
            <p class="hero-tagline">المغرب · الدار البيضاء</p>
            <div class="hero-divider">
                <div class="hdl hdl1"></div>
                <div class="hero-gem"></div>
                <div class="hdl hdl2"></div>
            </div>
            <img src="{{ $settingNav && $settingNav->logo
                ? asset('assets/admin/uploads/' . $settingNav->logo)
                : asset('assets_front/images/main_logo.png') }}"
                alt="مطاعم سبأ" class="hero-logo-big">
            <p class="hero-sub">{{ __('front.hero_sub') }}</p>
            <div class="hero-cta">
                <a href="#menu" class="btn-primary"><span>{{ __('front.explore_menu') }}</span></a>
                <a href="#contact" class="btn-outline">{{ __('front.book_table') }}</a>
            </div>
        </div>

        <div class="hero-ticker">
            <div class="ticker-inner">
                <span class="ticker-item">{{ __('front.ticker_1') }}</span>
                <span class="ticker-item">Authentic Yemeni Cuisine</span>
                <span class="ticker-item">{{ __('front.ticker_2') }}</span>
                <span class="ticker-item">Gulf Flavors</span>
                <span class="ticker-item">الدار البيضاء · المغرب</span>
                <span class="ticker-item">Casablanca · Morocco</span>
                <span class="ticker-item">{{ __('front.ticker_3') }}</span>
                <span class="ticker-item">Unforgettable Experience</span>
                {{-- duplicate for infinite --}}
                <span class="ticker-item">{{ __('front.ticker_1') }}</span>
                <span class="ticker-item">Authentic Yemeni Cuisine</span>
                <span class="ticker-item">{{ __('front.ticker_2') }}</span>
                <span class="ticker-item">Gulf Flavors</span>
                <span class="ticker-item">الدار البيضاء · المغرب</span>
                <span class="ticker-item">Casablanca · Morocco</span>
                <span class="ticker-item">{{ __('front.ticker_3') }}</span>
                <span class="ticker-item">Unforgettable Experience</span>
            </div>
        </div>

        <div class="hero-scroll">
            <span>{{ __('front.explore') }}</span>
            <div class="scroll-line"></div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════════
     ABOUT
══════════════════════════════════════════════════════════════ --}}
    <section id="about">
        <div class="about-bg-text">SABA</div>
        <div class="about-inner">

            <div class="about-visual reveal-left">
                <div class="about-img-frame">
                    <div class="about-img-main">
                        <img src="{{ asset('assets/admin/uploads/' . ($about->photo ?? '')) }}"
                            onerror="this.src='https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&q=80'"
                            alt="{{ __('front.about') }}">
                    </div>
                    <div class="about-corner tl"></div>
                    <div class="about-corner br"></div>
                </div>
                <div class="about-accent-box">
                    <div class="about-accent-num">{{ $locale == 'ar' ? '١٢+' : '12+' }}</div>
                    <div class="about-accent-text">{{ __('front.years_excellence') }}</div>
                </div>
            </div>

            <div class="about-text reveal-right">
                <div class="section-header"
                    style="text-align:{{ $locale == 'ar' ? 'right' : 'left' }};margin-bottom:26px;">
                    <span class="section-label">{{ __('front.about') }}</span>
                    @if ($about)
                        <h2 class="section-title">{!! $locale == 'ar' ? $about->name_ar : $about->name_en !!}</h2>
                    @else
                        <h2 class="section-title">{{ __('front.about_title') }}</h2>
                    @endif
                    <div class="ornament-divider" style="justify-content:flex-start;">
                        <div class="ornament-divider-center"></div>
                    </div>
                </div>

                @if ($about)
                    <p>{!! $locale == 'ar' ? $about->description_ar : $about->description_en !!}</p>
                @endif

                <div class="about-features">
                    <div class="about-feat reveal reveal-delay-1">
                        <div class="about-feat-icon">🌿</div>
                        <div>
                            <div class="about-feat-title">{{ __('front.feat_fresh') }}</div>
                            <div class="about-feat-desc">{{ __('front.feat_fresh_desc') }}</div>
                        </div>
                    </div>
                    <div class="about-feat reveal reveal-delay-2">
                        <div class="about-feat-icon">👨‍🍳</div>
                        <div>
                            <div class="about-feat-title">{{ __('front.feat_chefs') }}</div>
                            <div class="about-feat-desc">{{ __('front.feat_chefs_desc') }}</div>
                        </div>
                    </div>
                    <div class="about-feat reveal reveal-delay-3">
                        <div class="about-feat-icon">🕌</div>
                        <div>
                            <div class="about-feat-title">{{ __('front.feat_ambiance') }}</div>
                            <div class="about-feat-desc">{{ __('front.feat_ambiance_desc') }}</div>
                        </div>
                    </div>
                    <div class="about-feat reveal reveal-delay-4">
                        <div class="about-feat-icon">🏆</div>
                        <div>
                            <div class="about-feat-title">{{ __('front.feat_best') }}</div>
                            <div class="about-feat-desc">{{ __('front.feat_best_desc') }}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════════
     BEST — featured products slider
══════════════════════════════════════════════════════════════ --}}
    <section id="best">
        <div class="section-header reveal">
            <span class="section-label">{{ __('front.most_ordered') }}</span>
            <h2 class="section-title">
                {{ __('front.best_title') }} <span>{{ __('front.best_title_span') }}</span>
            </h2>
            <div class="ornament-divider">
                <div class="ornament-divider-center"></div>
            </div>
            <p class="section-desc">{{ __('front.best_desc') }}</p>
        </div>

        @if ($featuredProducts->isNotEmpty())
            <div class="best-track-wrap">
                <div class="best-track" id="bestTrack">
                    @foreach ([$featuredProducts, $featuredProducts] as $group)
                        @foreach ($group as $fp)
                            <a href="{{ route('product.show', $fp->id) }}" class="best-card"
                                style="text-decoration:none;">
                                <div class="best-card-img">
                                    <img src="{{ asset('assets/admin/uploads/' . $fp->photo) }}"
                                        alt="{{ $locale == 'ar' ? $fp->name_ar : $fp->name_en }}">
                                    <div class="best-badge">{{ __('front.most_ordered') }}</div>
                                </div>
                                <div class="best-card-body">
                                    <div class="best-card-name">
                                        {{ $locale == 'ar' ? $fp->name_ar : $fp->name_en }}
                                    </div>
                                    <div class="best-card-desc">
                                        {{ $locale == 'ar' ? \Str::limit($fp->description_ar, 80) : \Str::limit($fp->description_en, 80) }}
                                    </div>
                                    <div class="best-card-footer">
                                        @if ($fp->price ?? false)
                                            <div class="best-card-price" style="color: aliceblue;text-decoration:none">
                                                {{ $fp->price }}
                                                {{ $locale == 'ar' ? $fp->price_unit_ar ?? 'درهم' : $fp->price_unit_en ?? 'MAD' }}
                                            </div>
                                        @endif
                                        <div class="best-card-stars">★★★★★</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endif
    </section>

    {{-- ══════════════════════════════════════════════════════════════
     MENU — AJAX filter
══════════════════════════════════════════════════════════════ --}}
    <section id="menu">
        <div class="section-header reveal">
            <span class="section-label">{{ __('front.menu_label') }}</span>
            <h2 class="section-title">
               <span> {{ __('front.menu_title') }} {{ __('front.menu_title_span') }}</span>
            </h2>
            <div class="ornament-divider">
                <div class="ornament-divider-center"></div>
            </div>
        </div>

        <div class="menu-tabs reveal" id="menuTabs">
            @foreach ($categories as $i => $category)
                <button class="menu-tab {{ $i === 0 ? 'active' : '' }}" data-category="{{ $category->id }}">
                    {{ $locale == 'ar' ? $category->name_ar : $category->name_en }}
                </button>
            @endforeach
        </div>

        <div class="menu-panel active" id="menuPanel">
            @forelse($products as $product)
                <a href="{{ route('product.show', $product->id) }}" class="menu-item">
                    <div class="menu-item-img">
                        <img src="{{ asset('assets/admin/uploads/' . $product->photo) }}"
                            alt="{{ $locale == 'ar' ? $product->name_ar : $product->name_en }}">
                    </div>
                    <div class="menu-item-info">
                        <div class="menu-item-name">
                            {{ $locale == 'ar' ? $product->name_ar : $product->name_en }}
                        </div>
                        <div class="menu-item-desc">
                            {{ $locale == 'ar' ? \Str::limit($product->description_ar, 90) : \Str::limit($product->description_en, 90) }}
                        </div>
                        @if ($product->is_featured == 1)
                            <span class="menu-item-tag">{{ __('front.featured_tag') }}</span>
                        @endif

                        @if ($product->options->isNotEmpty())
                            <div class="menu-item-options">
                                @foreach ($product->options as $opt)
                                    <span class="menu-item-opt">
                                        <span class="opt-label">{{ $locale == 'ar' ? $opt->name_ar : $opt->name_en }}</span>
                                        @if ($opt->price)
                                            <span class="opt-sep"></span>
                                            <span class="opt-price">{{ number_format($opt->price, 0) }}
                                                {{ $locale == 'ar' ? $opt->price_unit_ar ?? 'درهم' : $opt->price_unit_en ?? 'MAD' }}</span>
                                        @endif
                                    </span>
                                @endforeach
                            </div>
                        @elseif($product->price ?? false)
                            <div class="menu-item-price">
                                {{ $product->price }}
                                <small>{{ $locale == 'ar' ? $product->price_unit_ar ?? 'درهم' : $product->price_unit_en ?? 'MAD' }}</small>
                            </div>
                        @endif
                    </div>
                </a>
            @empty
                <div class="menu-empty">{{ __('front.no_products') }}</div>
            @endforelse
        </div>

        <div style="text-align:center;margin-top:50px;" class="reveal">
            <a href="{{ route('menu') }}" class="btn-outline">{{ __('front.view_full_menu') }} ←</a>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════════
     VIDEOS — dynamic from DB
══════════════════════════════════════════════════════════════ --}}
    <section id="videos">
        <div class="section-header reveal">
            <span class="section-label">{{ __('front.videos_label') }}</span>
            <h2 class="section-title">
                {{ __('front.videos_title') }} <span>{{ __('front.videos_title_span') }}</span>
            </h2>
            <div class="ornament-divider">
                <div class="ornament-divider-center"></div>
            </div>
            <p class="section-desc">{{ __('front.videos_desc') }}</p>
        </div>

        @php $videoCount = $videos->isNotEmpty() ? $videos->count() : 5; @endphp
        <div class="videos-slider-wrap reveal" id="videosSlider">
            <button class="videos-slider-btn videos-slider-prev" onclick="videoSlide(-1)" aria-label="prev">
                <i class="fas fa-chevron-{{ $locale == 'ar' ? 'right' : 'left' }}"></i>
            </button>
            <button class="videos-slider-btn videos-slider-next" onclick="videoSlide(1)" aria-label="next">
                <i class="fas fa-chevron-{{ $locale == 'ar' ? 'left' : 'right' }}"></i>
            </button>

            <div class="videos-slider-track-outer">
                <div class="videos-slider-track" id="videosTrack">
                    @if ($videos->isNotEmpty())
                        @foreach ($videos as $video)
                            <div class="video-card"
                                @if ($video->video_url) onclick="openVideo('{{ route('stream.video', $video->video_url) }}')" @endif>
                                <div class="video-thumb">
                                    <img src="{{ asset('assets/admin/uploads/' . $video->thumbnail) }}"
                                        alt="{{ $locale == 'ar' ? $video->title_ar : $video->title_en }}">
                                    <div class="video-dim"></div>
                                    <div class="video-play-btn"><i class="fas fa-play"></i></div>
                                    <div class="video-overlay">
                                        <div class="video-title">
                                            {{ $locale == 'ar' ? $video->title_ar : $video->title_en }}
                                        </div>
                                        @if ($video->duration)
                                            <div class="video-duration">{{ $video->duration }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- Fallback static --}}
                        @foreach ([
                            ['img' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=900&q=80', 'title' => __('front.video_1_title'), 'dur' => '٨:٢٤'],
                            ['img' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=600&q=80', 'title' => __('front.video_2_title'), 'dur' => '٤:١٢'],
                            ['img' => 'https://images.unsplash.com/photo-1529006557810-274b9b2fc783?w=600&q=80', 'title' => __('front.video_3_title'), 'dur' => '٦:٥٠'],
                            ['img' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=600&q=80', 'title' => __('front.video_4_title'), 'dur' => '٣:٣٠'],
                            ['img' => 'https://images.unsplash.com/photo-1551218808-94e220e084d2?w=600&q=80', 'title' => __('front.video_5_title'), 'dur' => '٥:١٥'],
                        ] as $v)
                            <div class="video-card">
                                <div class="video-thumb">
                                    <img src="{{ $v['img'] }}" alt="">
                                    <div class="video-dim"></div>
                                    <div class="video-play-btn"><i class="fas fa-play"></i></div>
                                    <div class="video-overlay">
                                        <div class="video-title">{{ $v['title'] }}</div>
                                        <div class="video-duration">{{ $v['dur'] }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="videos-slider-dots" id="videosDots">
                @for ($d = 0; $d < $videoCount; $d++)
                    <div class="videos-slider-dot {{ $d === 0 ? 'active' : '' }}" onclick="videoGoTo({{ $d }})"></div>
                @endfor
            </div>
        </div>
    </section>

    {{-- Video Modal --}}
    <div id="videoModal"
        style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.92);z-index:9000;
            align-items:center;justify-content:center;flex-direction:column;gap:16px;">
        <button onclick="closeVideo()"
            style="position:absolute;top:22px;left:28px;background:none;border:none;
                   color:var(--gold);font-size:2.2rem;cursor:pointer;line-height:1;">✕</button>
        <iframe id="videoFrame" width="900" height="506" frameborder="0" allowfullscreen
            style="max-width:92vw;max-height:78vh;border:1px solid rgba(206,173,106,.25);display:none;"></iframe>

        <video id="videoPlayer" width="900" height="506" controls
            style="max-width:92vw;max-height:78vh;border:1px solid rgba(206,173,106,.25);display:none;">
        </video>
    </div>

    {{-- ══════════════════════════════════════════════════════════════
     WORKING HOURS — dynamic from DB
══════════════════════════════════════════════════════════════ --}}
    <section id="hours">
        <div class="hours-pattern"></div>
        <div class="hours-content">

            <div class="section-header reveal">
                <span class="section-label">{{ __('front.hours_label') }}</span>
                <h2 class="section-title">
                    {{ __('front.hours_title') }} <span>{{ __('front.hours_title_span') }}</span>
                </h2>
                <div class="ornament-divider">
                    <div class="ornament-divider-center"></div>
                </div>
            </div>

            <div class="hours-grid">
                @if ($workingHours->isNotEmpty())
                    {{-- ✅ Dynamic from DB --}}
                    @foreach ($workingHours as $wh)
                        <div class="hour-card {{ $wh->is_ramadan ? 'hour-ramadan' : '' }}"
                            data-day="{{ $wh->day_index }}"
                            @if ($wh->is_ramadan) style="background:rgba(206,173,106,0.04);" @endif>
                            <div class="hour-day">
                                {{ $locale == 'ar' ? $wh->day_ar : $wh->day_en }}
                            </div>
                            @if ($wh->open_time && $wh->close_time)
                                <div class="hour-time">{{ $wh->open_time }} – {{ $wh->close_time }}</div>
                            @else
                                <div class="hour-time">
                                    {{ $locale == 'ar' ? 'أوقات خاصة' : 'Special Hours' }}
                                </div>
                            @endif
                            @if ($wh->note_ar || $wh->note_en)
                                <div class="hour-time-sub">
                                    {{ $locale == 'ar' ? $wh->note_ar : $wh->note_en }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    {{-- 🔁 Fallback static --}}
                    <div class="hour-card" data-day="1">
                        <div class="hour-day">{{ __('front.mon_tue') }}</div>
                        <div class="hour-time">11:00 – 23:00</div>
                        <div class="hour-time-sub">{{ __('front.lunch_dinner') }}</div>
                    </div>
                    <div class="hour-card" data-day="3">
                        <div class="hour-day">{{ __('front.wed_thu') }}</div>
                        <div class="hour-time">11:00 – 00:00</div>
                        <div class="hour-time-sub">{{ __('front.lunch_dinner') }}</div>
                    </div>
                    <div class="hour-card" data-day="5">
                        <div class="hour-day">{{ __('front.friday') }}</div>
                        <div class="hour-time">09:00 – 01:00</div>
                        <div class="hour-time-sub">{{ __('front.all_meals') }}</div>
                    </div>
                    <div class="hour-card" data-day="6">
                        <div class="hour-day">{{ __('front.saturday') }}</div>
                        <div class="hour-time">09:00 – 01:00</div>
                        <div class="hour-time-sub">{{ __('front.all_meals') }}</div>
                    </div>
                    <div class="hour-card" data-day="0">
                        <div class="hour-day">{{ __('front.sunday') }}</div>
                        <div class="hour-time">11:00 – 23:00</div>
                        <div class="hour-time-sub">{{ __('front.lunch_dinner') }}</div>
                    </div>
                    <div class="hour-card" data-day="-1" style="background:rgba(206,173,106,0.04)">
                        <div class="hour-day">{{ __('front.ramadan') }}</div>
                        <div class="hour-time">{{ __('front.special_hours') }}</div>
                        <div class="hour-time-sub">{{ __('front.follow_social') }}</div>
                    </div>
                @endif
            </div>

            <div class="hours-note reveal">
                <p>
                    {{ __('front.reservations_note') }}
                    <strong>{{ $settingNav->phone ?? '' }}</strong>
                </p>
            </div>

        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════════
     CONTACT
══════════════════════════════════════════════════════════════ --}}
    <section id="contact">
        <div class="section-header reveal">
            <span class="section-label">{{ __('front.contact') }}</span>
            <h2 class="section-title">
                {{ __('front.contact_title') }} <span>{{ __('front.contact_title_span') }}</span>
            </h2>
            <div class="ornament-divider">
                <div class="ornament-divider-center"></div>
            </div>
        </div>

        <div class="contact-inner">

            <div class="contact-info reveal-left">
                <h3>{{ __('front.contact_heading') }}</h3>

                <div class="contact-detail">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="contact-detail-title">{{ __('front.location') }}</div>
                        <div class="contact-detail-value">{{ $settingNav->address ?? '' }}</div>
                    </div>
                </div>

                <div class="contact-detail">
                    <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                    <div>
                        <div class="contact-detail-title">{{ __('front.call') }}</div>
                        <div class="contact-detail-value">
                            <a href="tel:{{ $settingNav->phone ?? '' }}" style="color:inherit;text-decoration:none;">
                                {{ $settingNav->phone ?? '' }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="contact-detail">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="contact-detail-title">{{ __('front.email') }}</div>
                        <div class="contact-detail-value">
                            <a href="mailto:{{ $settingNav->email ?? '' }}" style="color:inherit;text-decoration:none;">
                                {{ $settingNav->email ?? '' }}
                            </a>
                        </div>
                    </div>
                </div>

                @if ($settingNav->google_map ?? false)
                    <div class="contact-detail">
                        <div class="contact-icon"><i class="fas fa-map"></i></div>
                        <div>
                            <div class="contact-detail-title">{{ __('front.map') }}</div>
                            <div class="contact-detail-value">
                                <a href="{{ $settingNav->google_map }}" target="_blank"
                                    style="color:var(--gold);text-decoration:none;">
                                    {{ __('front.open_map') }} ↗
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="contact-form-box reveal-right">
                <span class="contact-form-title">{{ __('front.book_now') }}</span>

                @if (session('success'))
                    <div class="alert-success-saba">✓ {{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label>{{ __('front.name') }}</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="{{ __('front.name_placeholder') }}" required>
                            @error('name')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('front.phone') }}</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+212 ..."
                                required>
                            @error('phone')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('front.subject') }}</label>
                        <input type="text" name="subject" value="{{ old('subject') }}"
                            placeholder="{{ __('front.subject_placeholder') }}" required>
                        @error('subject')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('front.message') }}</label>
                        <textarea name="message" placeholder="{{ __('front.message_placeholder') }}" required>{{ old('message') }}</textarea>
                        @error('message')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn-primary"
                        style="width:100%;text-align:center;border:none;font-size:1rem;">
                        <span>{{ __('front.send') }} ←</span>
                    </button>
                </form>
            </div>

        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════════
     SCRIPTS
══════════════════════════════════════════════════════════════ --}}
    @push('scripts')
        <script>
            $(document).ready(function() {

                // ─── نمرر الـ route base من Laravel ───
                // هكذا نتجنب hard-coded URLs وتعمل مع locale prefix
                var productBaseUrl = '{{ url(app()->getLocale() . '/product') }}';
                var filterUrl = '{{ route('filter.products') }}';
                var locale = '{{ $locale }}';

                // ─── Menu AJAX filter ───
                $('#menuTabs').on('click', '.menu-tab', function() {
                    $('#menuTabs .menu-tab').removeClass('active');
                    $(this).addClass('active');

                    var catId = $(this).data('category');
                    var $panel = $('#menuPanel');

                    $panel.html('<div class="menu-loading">{{ __('front.loading') }}</div>');

                    $.ajax({
                        url: filterUrl,
                        type: 'GET',
                        data: {
                            category_id: catId
                        },
                        success: function(res) {
                            if (!res.products || !res.products.length) {
                                $panel.html(
                                    '<div class="menu-empty">{{ __('front.no_products') }}</div>'
                                    );
                                return;
                            }

                            var html = '';
                            res.products.forEach(function(p) {
                                var name = locale === 'ar' ? (p.name_ar || '') : (p
                                    .name_en || '');
                                var desc = locale === 'ar' ? (p.description_ar || '') : (p
                                    .description_en || '');
                                if (desc.length > 90) desc = desc.substring(0, 90) + '...';

                                var tag = p.is_featured == 1 ?
                                    '<span class="menu-item-tag">{{ __('front.featured_tag') }}</span>' :
                                    '';

                                // ─── Options badges ───
                                var optionsHtml = '';
                                if (p.options_data && p.options_data.length) {
                                    optionsHtml = '<div class="menu-item-options">';
                                    p.options_data.forEach(function(opt) {
                                        var optName = locale === 'ar' ? (opt
                                            .name_ar || '') : (opt.name_en ||
                                            '');
                                        var optUnit = locale === 'ar' ?
                                            (opt.price_unit_ar || 'درهم') :
                                            (opt.price_unit_en || 'MAD');
                                        // سعر بدون كسور عشرية
                                        var optPrice = opt.price ?
                                            '<span class="opt-sep"></span><span class="opt-price">' +
                                            Math.round(opt.price) + ' ' + optUnit +
                                            '</span>' :
                                            '';
                                        optionsHtml +=
                                            '<span class="menu-item-opt">' +
                                            '<span class="opt-label">' + optName +
                                            '</span>' +
                                            optPrice +
                                            '</span>';
                                    });
                                    optionsHtml += '</div>';
                                }

                                // ─── سعر عادي لو ما في options ───
                                var priceHtml = '';
                                if (p.price && (!p.options_data || !p.options_data
                                    .length)) {
                                    var unit = locale === 'ar' ?
                                        (p.price_unit_ar || 'درهم') :
                                        (p.price_unit_en || 'MAD');
                                    priceHtml = '<div class="menu-item-price">' + p.price +
                                        '<br><small>' + unit + '</small></div>';
                                }

                                // ─── productBaseUrl يضمن الـ locale prefix ───
                                html += '<a href="' + productBaseUrl + '/' + p.id +
                                    '" class="menu-item">' +
                                    '<div class="menu-item-img">' +
                                    '<img src="/assets/admin/uploads/' + p.photo +
                                    '" alt="' + name + '">' +
                                    '</div>' +
                                    '<div class="menu-item-info">' +
                                    '<div class="menu-item-name">' + name + '</div>' +
                                    '<div class="menu-item-desc">' + desc + '</div>' +
                                    tag +
                                    optionsHtml +
                                    '</div>' +
                                    priceHtml +
                                    '</a>';
                            });

                            $panel.html(html);
                        },
                        error: function() {
                            $panel.html(
                                '<div class="menu-empty">{{ __('front.error_loading') }}</div>'
                                );
                        }
                    });
                });

                // ─────────────────────────────────────────────
                // Working Hours — highlight today's card
                // ─────────────────────────────────────────────
                var today = new Date().getDay(); // 0=Sun … 6=Sat
                document.querySelectorAll('.hour-card[data-day]').forEach(function(card) {
                    var idx = parseInt(card.getAttribute('data-day'));
                    var match = false;
                    // grouped Mon–Tue  → day_index = 1
                    if (idx === 1 && (today === 1 || today === 2)) match = true;
                    // grouped Wed–Thu  → day_index = 3
                    else if (idx === 3 && (today === 3 || today === 4)) match = true;
                    // single days (Fri=5, Sat=6, Sun=0)
                    else if (idx >= 0 && idx === today) match = true;
                    if (match) card.classList.add('today');
                });

                // ─────────────────────────────────────────────
                // Best-products slider — pause on touch
                // ─────────────────────────────────────────────
                $('#bestTrack')
                    .on('touchstart', function() {
                        $(this).css('animation-play-state', 'paused');
                    })
                    .on('touchend', function() {
                        $(this).css('animation-play-state', 'running');
                    });

            });

            // ─────────────────────────────────────────────
            // Videos slider
            // ─────────────────────────────────────────────
            var videoIdx = 0;
            var videoTotal = document.querySelectorAll('#videosTrack .video-card').length;

            function videoGoTo(n) {
                videoIdx = (n + videoTotal) % videoTotal;
                var w = document.querySelector('.videos-slider-track-outer').offsetWidth;
                document.getElementById('videosTrack').style.transform = 'translateX(' + (-videoIdx * w) + 'px)';
                document.querySelectorAll('#videosDots .videos-slider-dot').forEach(function(d, i) {
                    d.classList.toggle('active', i === videoIdx);
                });
            }

            function videoSlide(dir) { videoGoTo(videoIdx + dir); }

            window.addEventListener('resize', function() { videoGoTo(videoIdx); });

            // Touch/swipe support
            (function() {
                var track = document.getElementById('videosTrack');
                if (!track) return;
                var startX = 0;
                track.addEventListener('touchstart', function(e) { startX = e.touches[0].clientX; }, { passive: true });
                track.addEventListener('touchend', function(e) {
                    var diff = startX - e.changedTouches[0].clientX;
                    if (Math.abs(diff) > 40) videoSlide(diff > 0 ? 1 : -1);
                });
            })();

            // ─────────────────────────────────────────────
            // Video modal — open / close
            // ─────────────────────────────────────────────
            function openVideo(url) {
                var videoId = extractYoutubeId(url);

                if (videoId) {
                    // YouTube link
                    var embed = 'https://www.youtube.com/embed/' + videoId +
                        '?autoplay=1&rel=0&modestbranding=1';
                    document.getElementById('videoFrame').src = embed;
                    document.getElementById('videoFrame').style.display = 'block';
                    document.getElementById('videoPlayer').style.display = 'none';
                } else {
                    // Local uploaded video
                    document.getElementById('videoFrame').src = '';
                    document.getElementById('videoFrame').style.display = 'none';
                    var player = document.getElementById('videoPlayer');
                    player.src = url;
                    player.style.display = 'block';
                    player.play();
                }

                document.getElementById('videoModal').style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }

            function extractYoutubeId(url) {
                // يشتغل مع كل أنواع روابط يوتيوب:
                // https://www.youtube.com/watch?v=VIDEO_ID
                // https://youtu.be/VIDEO_ID
                // https://www.youtube.com/embed/VIDEO_ID
                // https://youtube.com/shorts/VIDEO_ID
                // https://www.youtube.com/watch?v=VIDEO_ID&t=30s
                var patterns = [
                    /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/shorts\/)([a-zA-Z0-9_-]{11})/,
                    /[?&]v=([a-zA-Z0-9_-]{11})/
                ];
                for (var i = 0; i < patterns.length; i++) {
                    var match = url.match(patterns[i]);
                    if (match && match[1]) return match[1];
                }
                return null;
            }

            function closeVideo() {
                document.getElementById('videoFrame').src = '';
                document.getElementById('videoModal').style.display = 'none';
                var player = document.getElementById('videoPlayer');
                player.pause();
                player.src = '';
                document.body.style.overflow = '';
            }

            // close modal on backdrop click
            document.getElementById('videoModal').addEventListener('click', function(e) {
                if (e.target === this) closeVideo();
            });
        </script>
    @endpush

@endsection
