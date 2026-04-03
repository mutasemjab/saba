<?php $__env->startSection('content'); ?>

    <?php
        $settingNav = $setting ?? \App\Models\Setting::first();
        $current = LaravelLocalization::getCurrentLocale();
        $target = $current === 'ar' ? 'en' : 'ar';
        $supported = LaravelLocalization::getSupportedLocales();
        $targetName =
            $target === 'ar' ? $supported[$target]['native'] ?? 'العربية' : $supported[$target]['native'] ?? 'English';
        $targetUrl = LaravelLocalization::getLocalizedURL($target, null, [], true);
    ?>



    
    <?php
        $banner = \App\Models\Banner::first();
        $bannerUrl = $banner ? asset('assets/admin/uploads/' . $banner->photo) : '';
    ?>

    <section id="hero">
        <div class="hero-banner-img" style="background-image:url('<?php echo e($bannerUrl); ?>');"></div>
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
            <img src="<?php echo e($settingNav && $settingNav->logo
                ? asset('assets/admin/uploads/' . $settingNav->logo)
                : asset('assets_front/images/main_logo.png')); ?>"
                alt="مطاعم سبأ" class="hero-logo-big">
            <p class="hero-sub"><?php echo e(__('front.hero_sub')); ?></p>
            <div class="hero-cta">
                <a href="#menu" class="btn-primary"><span><?php echo e(__('front.explore_menu')); ?></span></a>
                <a href="#contact" class="btn-outline"><?php echo e(__('front.book_table')); ?></a>
            </div>
        </div>

        <div class="hero-ticker">
            <div class="ticker-inner">
                <span class="ticker-item"><?php echo e(__('front.ticker_1')); ?></span>
                <span class="ticker-item">Authentic Yemeni Cuisine</span>
                <span class="ticker-item"><?php echo e(__('front.ticker_2')); ?></span>
                <span class="ticker-item">Gulf Flavors</span>
                <span class="ticker-item">الدار البيضاء · المغرب</span>
                <span class="ticker-item">Casablanca · Morocco</span>
                <span class="ticker-item"><?php echo e(__('front.ticker_3')); ?></span>
                <span class="ticker-item">Unforgettable Experience</span>
                
                <span class="ticker-item"><?php echo e(__('front.ticker_1')); ?></span>
                <span class="ticker-item">Authentic Yemeni Cuisine</span>
                <span class="ticker-item"><?php echo e(__('front.ticker_2')); ?></span>
                <span class="ticker-item">Gulf Flavors</span>
                <span class="ticker-item">الدار البيضاء · المغرب</span>
                <span class="ticker-item">Casablanca · Morocco</span>
                <span class="ticker-item"><?php echo e(__('front.ticker_3')); ?></span>
                <span class="ticker-item">Unforgettable Experience</span>
            </div>
        </div>

        <div class="hero-scroll">
            <span><?php echo e(__('front.explore')); ?></span>
            <div class="scroll-line"></div>
        </div>
    </section>

    
    <section id="about">
        <div class="about-bg-text">SABA</div>
        <div class="about-inner">

            <div class="about-visual reveal-left">
                <div class="about-img-frame">
                    <div class="about-img-main">
                        <img src="<?php echo e(asset('assets/admin/uploads/' . ($about->photo ?? ''))); ?>"
                            onerror="this.src='https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&q=80'"
                            alt="<?php echo e(__('front.about')); ?>">
                    </div>
                    <div class="about-corner tl"></div>
                    <div class="about-corner br"></div>
                </div>
                <div class="about-accent-box">
                    <div class="about-accent-num">١٢+</div>
                    <div class="about-accent-text"><?php echo e(__('front.years_excellence')); ?></div>
                </div>
            </div>

            <div class="about-text reveal-right">
                <div class="section-header"
                    style="text-align:<?php echo e($locale == 'ar' ? 'right' : 'left'); ?>;margin-bottom:26px;">
                    <span class="section-label"><?php echo e(__('front.about')); ?></span>
                    <?php if($about): ?>
                        <h2 class="section-title"><?php echo $locale == 'ar' ? $about->name_ar : $about->name_en; ?></h2>
                    <?php else: ?>
                        <h2 class="section-title"><?php echo e(__('front.about_title')); ?></h2>
                    <?php endif; ?>
                    <div class="ornament-divider" style="justify-content:flex-start;">
                        <div class="ornament-divider-center"></div>
                    </div>
                </div>

                <?php if($about): ?>
                    <p><?php echo $locale == 'ar' ? $about->description_ar : $about->description_en; ?></p>
                <?php endif; ?>

                <div class="about-features">
                    <div class="about-feat reveal reveal-delay-1">
                        <div class="about-feat-icon">🌿</div>
                        <div>
                            <div class="about-feat-title"><?php echo e(__('front.feat_fresh')); ?></div>
                            <div class="about-feat-desc"><?php echo e(__('front.feat_fresh_desc')); ?></div>
                        </div>
                    </div>
                    <div class="about-feat reveal reveal-delay-2">
                        <div class="about-feat-icon">👨‍🍳</div>
                        <div>
                            <div class="about-feat-title"><?php echo e(__('front.feat_chefs')); ?></div>
                            <div class="about-feat-desc"><?php echo e(__('front.feat_chefs_desc')); ?></div>
                        </div>
                    </div>
                    <div class="about-feat reveal reveal-delay-3">
                        <div class="about-feat-icon">🕌</div>
                        <div>
                            <div class="about-feat-title"><?php echo e(__('front.feat_ambiance')); ?></div>
                            <div class="about-feat-desc"><?php echo e(__('front.feat_ambiance_desc')); ?></div>
                        </div>
                    </div>
                    <div class="about-feat reveal reveal-delay-4">
                        <div class="about-feat-icon">🏆</div>
                        <div>
                            <div class="about-feat-title"><?php echo e(__('front.feat_best')); ?></div>
                            <div class="about-feat-desc"><?php echo e(__('front.feat_best_desc')); ?></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    
    <section id="best">
        <div class="section-header reveal">
            <span class="section-label"><?php echo e(__('front.most_ordered')); ?></span>
            <h2 class="section-title">
                <?php echo e(__('front.best_title')); ?> <span><?php echo e(__('front.best_title_span')); ?></span>
            </h2>
            <div class="ornament-divider">
                <div class="ornament-divider-center"></div>
            </div>
            <p class="section-desc"><?php echo e(__('front.best_desc')); ?></p>
        </div>

        <?php if($featuredProducts->isNotEmpty()): ?>
            <div class="best-track-wrap">
                <div class="best-track" id="bestTrack">
                    <?php $__currentLoopData = [$featuredProducts, $featuredProducts]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('product.show', $fp->id)); ?>" class="best-card"
                                style="text-decoration:none;">
                                <div class="best-card-img">
                                    <img src="<?php echo e(asset('assets/admin/uploads/' . $fp->photo)); ?>"
                                        alt="<?php echo e($locale == 'ar' ? $fp->name_ar : $fp->name_en); ?>">
                                    <div class="best-badge"><?php echo e(__('front.most_ordered')); ?></div>
                                </div>
                                <div class="best-card-body">
                                    <div class="best-card-name">
                                        <?php echo e($locale == 'ar' ? $fp->name_ar : $fp->name_en); ?>

                                    </div>
                                    <div class="best-card-desc">
                                        <?php echo e($locale == 'ar' ? \Str::limit($fp->description_ar, 80) : \Str::limit($fp->description_en, 80)); ?>

                                    </div>
                                    <div class="best-card-footer">
                                        <?php if($fp->price ?? false): ?>
                                            <div class="best-card-price" style="color: inherit;text-decoration:none">
                                                <?php echo e($fp->price); ?>

                                                <?php echo e($locale == 'ar' ? $fp->price_unit_ar ?? 'درهم' : $fp->price_unit_en ?? 'MAD'); ?>

                                            </div>
                                        <?php endif; ?>
                                        <div class="best-card-stars">★★★★★</div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </section>

    
    <section id="menu">
        <div class="section-header reveal">
            <span class="section-label"><?php echo e(__('front.menu_label')); ?></span>
            <h2 class="section-title">
               <span> <?php echo e(__('front.menu_title')); ?> <?php echo e(__('front.menu_title_span')); ?></span>
            </h2>
            <div class="ornament-divider">
                <div class="ornament-divider-center"></div>
            </div>
        </div>

        <div class="menu-tabs reveal" id="menuTabs">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button class="menu-tab <?php echo e($i === 0 ? 'active' : ''); ?>" data-category="<?php echo e($category->id); ?>">
                    <?php echo e($locale == 'ar' ? $category->name_ar : $category->name_en); ?>

                </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="menu-panel active" id="menuPanel">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('product.show', $product->id)); ?>" class="menu-item">
                    <div class="menu-item-img">
                        <img src="<?php echo e(asset('assets/admin/uploads/' . $product->photo)); ?>"
                            alt="<?php echo e($locale == 'ar' ? $product->name_ar : $product->name_en); ?>">
                    </div>
                    <div class="menu-item-info">
                        <div class="menu-item-name">
                            <?php echo e($locale == 'ar' ? $product->name_ar : $product->name_en); ?>

                        </div>
                        <div class="menu-item-desc">
                            <?php echo e($locale == 'ar' ? \Str::limit($product->description_ar, 90) : \Str::limit($product->description_en, 90)); ?>

                        </div>
                        <?php if($product->is_featured == 1): ?>
                            <span class="menu-item-tag"><?php echo e(__('front.featured_tag')); ?></span>
                        <?php endif; ?>

                        <?php if($product->options->isNotEmpty()): ?>
                            <div class="menu-item-options">
                                <?php $__currentLoopData = $product->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="menu-item-opt">
                                        <span class="opt-label"><?php echo e($locale == 'ar' ? $opt->name_ar : $opt->name_en); ?></span>
                                        <?php if($opt->price): ?>
                                            <span class="opt-sep"></span>
                                            <span class="opt-price"><?php echo e(number_format($opt->price, 0)); ?>

                                                <?php echo e($locale == 'ar' ? $opt->price_unit_ar ?? 'درهم' : $opt->price_unit_en ?? 'MAD'); ?></span>
                                        <?php endif; ?>
                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php elseif($product->price ?? false): ?>
                            <div class="menu-item-price">
                                <?php echo e($product->price); ?>

                                <small><?php echo e($locale == 'ar' ? $product->price_unit_ar ?? 'درهم' : $product->price_unit_en ?? 'MAD'); ?></small>
                            </div>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="menu-empty"><?php echo e(__('front.no_products')); ?></div>
            <?php endif; ?>
        </div>

        <div style="text-align:center;margin-top:50px;" class="reveal">
            <a href="<?php echo e(route('menu')); ?>" class="btn-outline"><?php echo e(__('front.view_full_menu')); ?> ←</a>
        </div>
    </section>

    
    <section id="videos">
        <div class="section-header reveal">
            <span class="section-label"><?php echo e(__('front.videos_label')); ?></span>
            <h2 class="section-title">
                <?php echo e(__('front.videos_title')); ?> <span><?php echo e(__('front.videos_title_span')); ?></span>
            </h2>
            <div class="ornament-divider">
                <div class="ornament-divider-center"></div>
            </div>
            <p class="section-desc"><?php echo e(__('front.videos_desc')); ?></p>
        </div>

        <?php if($videos->isNotEmpty()): ?>
            
            <div class="videos-grid reveal">
                <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="video-card <?php echo e($i === 0 ? 'video-main' : ''); ?>"
                        <?php if($video->video_url): ?> onclick="openVideo('<?php echo e(route('stream.video', $video->video_url)); ?>')"

                 style="cursor:pointer" <?php endif; ?>>
                        <div class="video-thumb">
                            <img src="<?php echo e(asset('assets/admin/uploads/' . $video->thumbnail)); ?>"
                                alt="<?php echo e($locale == 'ar' ? $video->title_ar : $video->title_en); ?>">
                            <div class="video-dim"></div>
                            <div class="video-play-btn"><i class="fas fa-play"></i></div>
                            <div class="video-overlay">
                                <div class="video-title">
                                    <?php echo e($locale == 'ar' ? $video->title_ar : $video->title_en); ?>

                                </div>
                                <?php if($video->duration): ?>
                                    <div class="video-duration"><?php echo e($video->duration); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            
            <div class="videos-grid reveal">
                <div class="video-card">
                    <div class="video-thumb">
                        <img src="https://images.unsplash.com/photo-1544025162-d76694265947?w=900&q=80" alt="">
                        <div class="video-dim"></div>
                        <div class="video-play-btn"><i class="fas fa-play"></i></div>
                        <div class="video-overlay">
                            <div class="video-title"><?php echo e(__('front.video_1_title')); ?></div>
                            <div class="video-duration">٨:٢٤</div>
                        </div>
                    </div>
                </div>
                <div class="video-card">
                    <div class="video-thumb">
                        <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=600&q=80" alt="">
                        <div class="video-dim"></div>
                        <div class="video-play-btn"><i class="fas fa-play"></i></div>
                        <div class="video-overlay">
                            <div class="video-title"><?php echo e(__('front.video_2_title')); ?></div>
                            <div class="video-duration">٤:١٢</div>
                        </div>
                    </div>
                </div>
                <div class="video-card">
                    <div class="video-thumb">
                        <img src="https://images.unsplash.com/photo-1529006557810-274b9b2fc783?w=600&q=80" alt="">
                        <div class="video-dim"></div>
                        <div class="video-play-btn"><i class="fas fa-play"></i></div>
                        <div class="video-overlay">
                            <div class="video-title"><?php echo e(__('front.video_3_title')); ?></div>
                            <div class="video-duration">٦:٥٠</div>
                        </div>
                    </div>
                </div>
                <div class="video-card">
                    <div class="video-thumb">
                        <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=600&q=80" alt="">
                        <div class="video-dim"></div>
                        <div class="video-play-btn"><i class="fas fa-play"></i></div>
                        <div class="video-overlay">
                            <div class="video-title"><?php echo e(__('front.video_4_title')); ?></div>
                            <div class="video-duration">٣:٣٠</div>
                        </div>
                    </div>
                </div>
                <div class="video-card">
                    <div class="video-thumb">
                        <img src="https://images.unsplash.com/photo-1551218808-94e220e084d2?w=600&q=80" alt="">
                        <div class="video-dim"></div>
                        <div class="video-play-btn"><i class="fas fa-play"></i></div>
                        <div class="video-overlay">
                            <div class="video-title"><?php echo e(__('front.video_5_title')); ?></div>
                            <div class="video-duration">٥:١٥</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>

    
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

    
    <section id="hours">
        <div class="hours-pattern"></div>
        <div class="hours-content">

            <div class="section-header reveal">
                <span class="section-label"><?php echo e(__('front.hours_label')); ?></span>
                <h2 class="section-title">
                    <?php echo e(__('front.hours_title')); ?> <span><?php echo e(__('front.hours_title_span')); ?></span>
                </h2>
                <div class="ornament-divider">
                    <div class="ornament-divider-center"></div>
                </div>
            </div>

            <div class="hours-grid">
                <?php if($workingHours->isNotEmpty()): ?>
                    
                    <?php $__currentLoopData = $workingHours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="hour-card <?php echo e($wh->is_ramadan ? 'hour-ramadan' : ''); ?>"
                            data-day="<?php echo e($wh->day_index); ?>"
                            <?php if($wh->is_ramadan): ?> style="background:rgba(206,173,106,0.04);" <?php endif; ?>>
                            <div class="hour-day">
                                <?php echo e($locale == 'ar' ? $wh->day_ar : $wh->day_en); ?>

                            </div>
                            <?php if($wh->open_time && $wh->close_time): ?>
                                <div class="hour-time"><?php echo e($wh->open_time); ?> – <?php echo e($wh->close_time); ?></div>
                            <?php else: ?>
                                <div class="hour-time">
                                    <?php echo e($locale == 'ar' ? 'أوقات خاصة' : 'Special Hours'); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($wh->note_ar || $wh->note_en): ?>
                                <div class="hour-time-sub">
                                    <?php echo e($locale == 'ar' ? $wh->note_ar : $wh->note_en); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    
                    <div class="hour-card" data-day="1">
                        <div class="hour-day"><?php echo e(__('front.mon_tue')); ?></div>
                        <div class="hour-time">11:00 – 23:00</div>
                        <div class="hour-time-sub"><?php echo e(__('front.lunch_dinner')); ?></div>
                    </div>
                    <div class="hour-card" data-day="3">
                        <div class="hour-day"><?php echo e(__('front.wed_thu')); ?></div>
                        <div class="hour-time">11:00 – 00:00</div>
                        <div class="hour-time-sub"><?php echo e(__('front.lunch_dinner')); ?></div>
                    </div>
                    <div class="hour-card" data-day="5">
                        <div class="hour-day"><?php echo e(__('front.friday')); ?></div>
                        <div class="hour-time">09:00 – 01:00</div>
                        <div class="hour-time-sub"><?php echo e(__('front.all_meals')); ?></div>
                    </div>
                    <div class="hour-card" data-day="6">
                        <div class="hour-day"><?php echo e(__('front.saturday')); ?></div>
                        <div class="hour-time">09:00 – 01:00</div>
                        <div class="hour-time-sub"><?php echo e(__('front.all_meals')); ?></div>
                    </div>
                    <div class="hour-card" data-day="0">
                        <div class="hour-day"><?php echo e(__('front.sunday')); ?></div>
                        <div class="hour-time">11:00 – 23:00</div>
                        <div class="hour-time-sub"><?php echo e(__('front.lunch_dinner')); ?></div>
                    </div>
                    <div class="hour-card" data-day="-1" style="background:rgba(206,173,106,0.04)">
                        <div class="hour-day"><?php echo e(__('front.ramadan')); ?></div>
                        <div class="hour-time"><?php echo e(__('front.special_hours')); ?></div>
                        <div class="hour-time-sub"><?php echo e(__('front.follow_social')); ?></div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="hours-note reveal">
                <p>
                    <?php echo e(__('front.reservations_note')); ?>

                    <strong><?php echo e($settingNav->phone ?? ''); ?></strong>
                </p>
            </div>

        </div>
    </section>

    
    <section id="contact">
        <div class="section-header reveal">
            <span class="section-label"><?php echo e(__('front.contact')); ?></span>
            <h2 class="section-title">
                <?php echo e(__('front.contact_title')); ?> <span><?php echo e(__('front.contact_title_span')); ?></span>
            </h2>
            <div class="ornament-divider">
                <div class="ornament-divider-center"></div>
            </div>
        </div>

        <div class="contact-inner">

            <div class="contact-info reveal-left">
                <h3><?php echo e(__('front.contact_heading')); ?></h3>

                <div class="contact-detail">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="contact-detail-title"><?php echo e(__('front.location')); ?></div>
                        <div class="contact-detail-value"><?php echo e($settingNav->address ?? ''); ?></div>
                    </div>
                </div>

                <div class="contact-detail">
                    <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                    <div>
                        <div class="contact-detail-title"><?php echo e(__('front.call')); ?></div>
                        <div class="contact-detail-value">
                            <a href="tel:<?php echo e($settingNav->phone ?? ''); ?>" style="color:inherit;text-decoration:none;">
                                <?php echo e($settingNav->phone ?? ''); ?>

                            </a>
                        </div>
                    </div>
                </div>

                <div class="contact-detail">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="contact-detail-title"><?php echo e(__('front.email')); ?></div>
                        <div class="contact-detail-value">
                            <a href="mailto:<?php echo e($settingNav->email ?? ''); ?>" style="color:inherit;text-decoration:none;">
                                <?php echo e($settingNav->email ?? ''); ?>

                            </a>
                        </div>
                    </div>
                </div>

                <?php if($settingNav->google_map ?? false): ?>
                    <div class="contact-detail">
                        <div class="contact-icon"><i class="fas fa-map"></i></div>
                        <div>
                            <div class="contact-detail-title"><?php echo e(__('front.map')); ?></div>
                            <div class="contact-detail-value">
                                <a href="<?php echo e($settingNav->google_map); ?>" target="_blank"
                                    style="color:var(--gold);text-decoration:none;">
                                    <?php echo e(__('front.open_map')); ?> ↗
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="contact-social">
                    <?php if($settingNav->instagram ?? false): ?>
                        <a href="<?php echo e($settingNav->instagram); ?>" target="_blank" class="social-btn">
                            <i class="fab fa-instagram"></i>
                        </a>
                    <?php endif; ?>
                    <?php if($settingNav->facebook ?? false): ?>
                        <a href="<?php echo e($settingNav->facebook); ?>" target="_blank" class="social-btn">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    <?php endif; ?>
                    <?php if($settingNav->twitter ?? false): ?>
                        <a href="<?php echo e($settingNav->twitter); ?>" target="_blank" class="social-btn">
                            <i class="fab fa-x-twitter"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="contact-form-box reveal-right">
                <span class="contact-form-title"><?php echo e(__('front.book_now')); ?></span>

                <?php if(session('success')): ?>
                    <div class="alert-success-saba">✓ <?php echo e(session('success')); ?></div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('contact.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group">
                            <label><?php echo e(__('front.name')); ?></label>
                            <input type="text" name="name" value="<?php echo e(old('name')); ?>"
                                placeholder="<?php echo e(__('front.name_placeholder')); ?>" required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="field-error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('front.phone')); ?></label>
                            <input type="tel" name="phone" value="<?php echo e(old('phone')); ?>" placeholder="+212 ..."
                                required>
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="field-error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo e(__('front.subject')); ?></label>
                        <input type="text" name="subject" value="<?php echo e(old('subject')); ?>"
                            placeholder="<?php echo e(__('front.subject_placeholder')); ?>" required>
                        <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="field-error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label><?php echo e(__('front.message')); ?></label>
                        <textarea name="message" placeholder="<?php echo e(__('front.message_placeholder')); ?>" required><?php echo e(old('message')); ?></textarea>
                        <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="field-error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <button type="submit" class="btn-primary"
                        style="width:100%;text-align:center;border:none;font-size:1rem;">
                        <span><?php echo e(__('front.send')); ?> ←</span>
                    </button>
                </form>
            </div>

        </div>
    </section>

    
    <?php $__env->startPush('scripts'); ?>
        <script>
            $(document).ready(function() {

                // ─── نمرر الـ route base من Laravel ───
                // هكذا نتجنب hard-coded URLs وتعمل مع locale prefix
                var productBaseUrl = '<?php echo e(url(app()->getLocale() . '/product')); ?>';
                var filterUrl = '<?php echo e(route('filter.products')); ?>';
                var locale = '<?php echo e($locale); ?>';

                // ─── Menu AJAX filter ───
                $('#menuTabs').on('click', '.menu-tab', function() {
                    $('#menuTabs .menu-tab').removeClass('active');
                    $(this).addClass('active');

                    var catId = $(this).data('category');
                    var $panel = $('#menuPanel');

                    $panel.html('<div class="menu-loading"><?php echo e(__('front.loading')); ?></div>');

                    $.ajax({
                        url: filterUrl,
                        type: 'GET',
                        data: {
                            category_id: catId
                        },
                        success: function(res) {
                            if (!res.products || !res.products.length) {
                                $panel.html(
                                    '<div class="menu-empty"><?php echo e(__('front.no_products')); ?></div>'
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
                                    '<span class="menu-item-tag"><?php echo e(__('front.featured_tag')); ?></span>' :
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
                                '<div class="menu-empty"><?php echo e(__('front.error_loading')); ?></div>'
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
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\saba\resources\views/user/home.blade.php ENDPATH**/ ?>