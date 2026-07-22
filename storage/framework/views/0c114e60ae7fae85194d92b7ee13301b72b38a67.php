<?php $__env->startPush('styles'); ?>
<style>
    .contact-page-hero {
        min-height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        padding: 160px 24px 90px
    }

    .contact-page-content {
        position: relative;
        z-index: 10;
        text-align: center;
        max-width: 520px;
        margin: 0 auto
    }

    .contact-page-content .hero-logo-big {
        width: 190px
    }

    .contact-page-title {
        font-family: 'Amiri', serif;
        font-size: clamp(2rem, 4.5vw, 2.8rem);
        color: #fff;
        margin: 6px 0 14px;
        opacity: 0;
        animation: fadeInUp .8s .7s forwards
    }

    .contact-page-title span {
        color: var(--gold)
    }

    .contact-page-desc {
        font-size: .95rem;
        color: rgba(245, 237, 216, .7);
        line-height: 1.9;
        margin-bottom: 40px;
        opacity: 0;
        animation: fadeInUp .8s .85s forwards
    }

    .contact-social-row {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
        margin-bottom: 46px;
        opacity: 0;
        animation: fadeInUp .8s 1s forwards
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: flex-start;
        gap: 14px;
        width: 270px;
        padding: 9px 20px 9px 9px;
        background: rgba(206, 173, 106, .05);
        border: 1px solid rgba(206, 173, 106, .22);
        border-radius: 14px;
        backdrop-filter: blur(6px);
        text-decoration: none;
        color: var(--text-light);
        transition: all .3s
    }

    [dir="rtl"] .social-link {
        padding: 9px 9px 9px 20px
    }

    .social-link:hover {
        transform: translateY(-2px);
        background: rgba(206, 173, 106, .12);
        border-color: rgba(206, 173, 106, .5);
        box-shadow: 0 10px 30px rgba(0, 0, 0, .35)
    }

    .social-link .social-btn {
        width: 46px;
        height: 46px;
        font-size: 1.2rem;
        border-radius: 50%;
        border: 1px solid rgba(206, 173, 106, .35);
        background: rgba(0, 0, 0, .15);
        flex-shrink: 0
    }

    .social-link:hover .social-btn {
        background: var(--gold);
        color: var(--dark-brown)
    }

    .social-link-name {
        font-size: .95rem;
        font-weight: 600;
        letter-spacing: .5px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap
    }

    .social-link-name.is-number {
        direction: ltr
    }

    .contact-menu-btn {
        opacity: 0;
        animation: fadeInUp .8s 1.15s forwards;
        margin-bottom: 40px
    }

    .contact-menu-btn .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 17px 50px
    }

    @media (max-width:480px) {
        .contact-page-hero {
            padding: 140px 18px 70px
        }

        .social-link {
            width: 230px;
            padding: 7px 16px 7px 7px
        }

        [dir="rtl"] .social-link {
            padding: 7px 7px 7px 16px
        }

        .social-link .social-btn {
            width: 40px;
            height: 40px;
            font-size: 1.05rem
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $settingNav = $setting ?? \App\Models\Setting::first();
    $banner     = \App\Models\Banner::first();
    $bannerUrl  = $banner ? asset('assets/admin/uploads/' . $banner->photo) : '';
?>

<section class="contact-page-hero">
    <div class="hero-banner-img" <?php if(!empty($bannerUrl)): ?> style="background-image:url('<?php echo e($bannerUrl); ?>')" <?php endif; ?>></div>
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

    <div class="contact-page-content">
        <img src="<?php echo e($settingNav && $settingNav->logo
                ? asset('assets/admin/uploads/' . $settingNav->logo)
                : asset('assets_front/images/main_logo.png')); ?>"
            alt="<?php echo e(__('front.site_name')); ?>" class="hero-logo-big">

        <h1 class="contact-page-title"><?php echo e(__('front.contact_page_title')); ?> <span><?php echo e(__('front.contact_page_title_span')); ?></span></h1>
        <p class="contact-page-desc"><?php echo e(__('front.contact_page_desc')); ?></p>

        
        <div class="contact-social-row">
            <?php if(!empty($settingNav->instagram)): ?>
                <a href="<?php echo e($settingNav->instagram); ?>" target="_blank" rel="noopener" class="social-link" aria-label="Instagram">
                    <span class="social-btn"><i class="fab fa-instagram"></i></span>
                    <span class="social-link-name">sabamoroc</span>
                </a>
            <?php endif; ?>
            <?php if(!empty($settingNav->facebook)): ?>
                <a href="<?php echo e($settingNav->facebook); ?>" target="_blank" rel="noopener" class="social-link" aria-label="Facebook">
                    <span class="social-btn"><i class="fab fa-facebook-f"></i></span>
                    <span class="social-link-name">Sab'a Restaurants</span>
                </a>
            <?php endif; ?>
            <?php if(!empty($settingNav->twitter)): ?>
                <a href="<?php echo e($settingNav->twitter); ?>" target="_blank" rel="noopener" class="social-link" aria-label="X">
                    <span class="social-btn"><i class="fab fa-x-twitter"></i></span>
                    <span class="social-link-name">X</span>
                </a>
            <?php endif; ?>
            <?php if(!empty($settingNav->whatsapp_number)): ?>
                <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $settingNav->whatsapp_number)); ?>" target="_blank" rel="noopener" class="social-link" aria-label="WhatsApp">
                    <span class="social-btn"><i class="fab fa-whatsapp"></i></span>
                    <span class="social-link-name is-number"><?php echo e($settingNav->whatsapp_number); ?></span>
                </a>
            <?php endif; ?>
             
            <?php if(!empty($settingNav->phone)): ?>
                <a href="tel:<?php echo e($settingNav->phone); ?>" class="social-link" aria-label="<?php echo e(__('front.call')); ?>">
                    <span class="social-btn"><i class="fas fa-phone-alt"></i></span>
                    <span class="social-link-name is-number"><?php echo e($settingNav->phone); ?></span>
                </a>
            <?php endif; ?>

            <?php if(!empty($settingNav->google_map)): ?>
                <a href="<?php echo e($settingNav->google_map); ?>" target="_blank" rel="noopener" class="social-link" aria-label="<?php echo e(__('front.location')); ?>">
                    <span class="social-btn"><i class="fas fa-map-marker-alt"></i></span>
                    <span class="social-link-name"><?php echo e(__('front.find_on_map')); ?></span>
                </a>
            <?php endif; ?>
        </div>
 
        
        <div class="contact-menu-btn">
            <a href="<?php echo e(route('menu')); ?>" class="btn-primary"><span><i class="fas fa-utensils"></i> <?php echo e(__('front.explore_menu')); ?></span></a>
        </div>

      
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\saba\resources\views/user/contact-us.blade.php ENDPATH**/ ?>