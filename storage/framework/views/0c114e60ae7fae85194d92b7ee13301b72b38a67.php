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
        justify-content: center;
        gap: 14px;
        margin-bottom: 46px;
        opacity: 0;
        animation: fadeInUp .8s 1s forwards
    }

    .contact-social-row .social-btn {
        width: 68px;
        height: 68px;
        font-size: 1.7rem;
        border-radius: 50%;
        border: 1px solid rgba(206, 173, 106, .35)
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

    .contact-divider-sm {
        width: 70px;
        height: 1px;
        background: linear-gradient(to right, transparent, var(--gold-dark), transparent);
        margin: 0 auto 40px;
        opacity: 0;
        animation: fadeInUp .8s 1.3s forwards
    }

    .contact-quick-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 34px;
        opacity: 0;
        animation: fadeInUp .8s 1.45s forwards
    }

    .contact-phone {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: var(--text-light)
    }

    .contact-phone-icon {
        width: 48px;
        height: 48px;
        border: 1px solid rgba(206, 173, 106, .4);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold);
        font-size: 1.05rem;
        transition: all .3s
    }

    .contact-phone:hover .contact-phone-icon {
        background: var(--gold);
        color: var(--dark-brown)
    }

    .contact-phone-text {
        text-align: <?php echo e(app()->getLocale() == 'ar' ? 'right' : 'left'); ?>

    }

    .contact-phone-label {
        font-size: .65rem;
        letter-spacing: 3px;
        color: var(--gold);
        text-transform: uppercase;
        margin-bottom: 3px
    }

    .contact-phone-value {
        font-size: 1.15rem;
        font-weight: 700;
        letter-spacing: 1px;
        display: inline-block
    }

    .contact-phone-value.is-number {
        direction: ltr
    }

    @media (max-width:480px) {
        .contact-page-hero {
            padding: 140px 18px 70px
        }

        .contact-social-row .social-btn {
            width: 58px;
            height: 58px;
            font-size: 1.4rem
        }

        .contact-quick-row {
            flex-direction: column;
            gap: 22px
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
                <a href="<?php echo e($settingNav->instagram); ?>" target="_blank" rel="noopener" class="social-btn" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <?php endif; ?>
            <?php if(!empty($settingNav->facebook)): ?>
                <a href="<?php echo e($settingNav->facebook); ?>" target="_blank" rel="noopener" class="social-btn" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <?php endif; ?>
            <?php if(!empty($settingNav->twitter)): ?>
                <a href="<?php echo e($settingNav->twitter); ?>" target="_blank" rel="noopener" class="social-btn" aria-label="X"><i class="fab fa-x-twitter"></i></a>
            <?php endif; ?>
            <?php if(!empty($settingNav->whatsapp_number)): ?>
                <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $settingNav->whatsapp_number)); ?>" target="_blank" rel="noopener" class="social-btn" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
            <?php endif; ?>
        </div>

        
        <div class="contact-menu-btn">
            <a href="<?php echo e(route('menu')); ?>" class="btn-primary"><span><i class="fas fa-utensils"></i> <?php echo e(__('front.explore_menu')); ?></span></a>
        </div>

        <div class="contact-divider-sm"></div>

        
        <div class="contact-quick-row">
            <?php if(!empty($settingNav->phone)): ?>
                <a href="tel:<?php echo e($settingNav->phone); ?>" class="contact-phone">
                    <span class="contact-phone-icon"><i class="fas fa-phone-alt"></i></span>
                    <span class="contact-phone-text">
                        <span class="contact-phone-label"><?php echo e(__('front.call')); ?></span>
                        <span class="contact-phone-value is-number"><?php echo e($settingNav->phone); ?></span>
                    </span>
                </a>
            <?php endif; ?>

            <?php if(!empty($settingNav->google_map)): ?>
                <a href="<?php echo e($settingNav->google_map); ?>" target="_blank" rel="noopener" class="contact-phone">
                    <span class="contact-phone-icon"><i class="fas fa-map-marker-alt"></i></span>
                    <span class="contact-phone-text">
                        <span class="contact-phone-label"><?php echo e(__('front.location')); ?></span>
                        <span class="contact-phone-value"><?php echo e(__('front.open_map')); ?></span>
                    </span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\saba\resources\views/user/contact-us.blade.php ENDPATH**/ ?>