<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $settingNav = $setting ?? \App\Models\Setting::first();
    $locale     = app()->getLocale();
    $current    = LaravelLocalization::getCurrentLocale();
    $target     = $current==='ar' ? 'en' : 'ar';
    $supported  = LaravelLocalization::getSupportedLocales();
    $targetName = $target==='ar' ? ($supported[$target]['native']??'العربية') : ($supported[$target]['native']??'English');
    $targetUrl  = LaravelLocalization::getLocalizedURL($target, null, [], true);
?>


<nav id="navbar" class="scrolled">
    <a href="<?php echo e(route('home')); ?>" class="nav-logo">
        <img src="<?php echo e($settingNav&&$settingNav->logo ? asset('assets/admin/uploads/'.$settingNav->logo) : asset('assets_front/images/main_logo.png')); ?>" alt="سبأ">
    </a>
    <ul class="nav-links">
        <li><a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a></li>
        <li><a href="<?php echo e(route('home')); ?>#about"><?php echo e(__('front.about')); ?></a></li>
        <li><a href="<?php echo e(route('menu')); ?>" style="color:var(--gold)"><?php echo e(__('front.menu')); ?></a></li>
        <li><a href="<?php echo e(route('home')); ?>#contact"><?php echo e(__('front.contact')); ?></a></li>
        <li><a class="nav-lang" hreflang="<?php echo e($target); ?>" href="<?php echo e($targetUrl); ?>"><?php echo e($targetName); ?></a></li>
    </ul>
    <a href="<?php echo e(route('home')); ?>#contact" class="nav-reserve"><?php echo e(__('front.book_table')); ?></a>
</nav>


<div class="menu-hero">
    <div class="menu-hero-bg"></div>
    <div class="menu-hero-content reveal">
        <span class="section-label"><?php echo e(__('front.menu_label')); ?></span>
        <h1><?php echo e(__('front.menu_page_title')); ?> <span><?php echo e(__('front.menu_page_title_span')); ?></span></h1>
        <div class="breadcrumb">
            <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
            <span class="sep">›</span>
            <span><?php echo e(__('front.menu')); ?></span>
            <?php if($activeCategory): ?>
                <span class="sep">›</span>
                <span><?php echo e($locale==='ar' ? $activeCategory->name_ar : $activeCategory->name_en); ?></span>
            <?php endif; ?>
        </div>
    </div>
</div>


<div class="menu-page">

    
    <aside>
        <div class="sidebar-title"><?php echo e(__('front.categories')); ?></div>
        <ul class="sidebar-list">
            <li>
                <a href="<?php echo e(route('menu')); ?>" class="<?php echo e(!$categoryId ? 'active' : ''); ?>">
                    <?php echo e(__('front.all')); ?>

                    <span class="cat-count"><?php echo e(\App\Models\Product::count()); ?></span>
                </a>
            </li>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e(route('menu', ['category_id'=>$cat->id])); ?>" class="<?php echo e($categoryId==$cat->id ? 'active' : ''); ?>">
                    <?php echo e($locale==='ar' ? $cat->name_ar : $cat->name_en); ?>

                    <span class="cat-count"><?php echo e($cat->products_count); ?></span>
                </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </aside>

    
    <div>
        <div class="products-top">
            <div class="products-title">
                <?php if($activeCategory): ?>
                    <?php echo e($locale==='ar' ? $activeCategory->name_ar : $activeCategory->name_en); ?>

                <?php else: ?>
                    <?php echo e(__('front.all')); ?> <span><?php echo e(__('front.dishes')); ?></span>
                <?php endif; ?>
            </div>
            <div class="products-count"><?php echo e($products->count()); ?> <?php echo e(__('front.item')); ?></div>
        </div>

        <div class="products-grid">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('product.show', $p->id)); ?>" class="prod-card">
                <div class="prod-card-img">
                    <img src="<?php echo e(asset('assets/admin/uploads/'.$p->photo)); ?>"
                         alt="<?php echo e($locale==='ar' ? $p->name_ar : $p->name_en); ?>">
                    <?php if($p->is_featured==1): ?>
                        <div class="prod-card-badge"><?php echo e(__('front.featured_tag')); ?></div>
                    <?php endif; ?>
                </div>
                <div class="prod-card-body">
                    <div class="prod-card-cat"><?php echo e($locale==='ar' ? ($p->category->name_ar??'') : ($p->category->name_en??'')); ?></div>
                    <div class="prod-card-name"><?php echo e($locale==='ar' ? $p->name_ar : $p->name_en); ?></div>
                    <div class="prod-card-desc"><?php echo e($locale==='ar' ? \Str::limit($p->description_ar,95) : \Str::limit($p->description_en,95)); ?></div>

                    
                    <?php if($p->options->isNotEmpty()): ?>
                        <div class="prod-card-options">
                            <?php $__currentLoopData = $p->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="prod-card-opt-row">
                                <span class="prod-card-opt-name"><?php echo e($locale==='ar' ? $opt->name_ar : $opt->name_en); ?></span>
                                <?php if($opt->price): ?>
                                <span class="prod-card-opt-price">
                                    <?php echo e(number_format($opt->price, 0)); ?>

                                    <?php echo e($locale==='ar' ? ($opt->price_unit_ar ?? 'درهم') : ($opt->price_unit_en ?? 'MAD')); ?>

                                </span>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="prod-card-footer">
                            <?php if($p->price??false): ?>
                                <div class="prod-card-price"><?php echo e($p->price); ?> <?php echo e($locale==='ar' ? ($p->price_unit_ar??'درهم') : ($p->price_unit_en??'MAD')); ?></div>
                            <?php else: ?>
                                <div></div>
                            <?php endif; ?>
                            <div class="prod-card-arrow"><?php echo e(__('front.view_details')); ?> ←</div>
                        </div>
                    <?php endif; ?>

                    
                    <?php if($p->options->isNotEmpty()): ?>
                    <div style="margin-top:10px;text-align:left">
                        <span class="prod-card-arrow"><?php echo e(__('front.view_details')); ?> ←</span>
                    </div>
                    <?php endif; ?>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="no-products"><?php echo e(__('front.no_products')); ?></div>
            <?php endif; ?>
        </div>
    </div>

</div>


<footer>
    <div class="footer-top">
        <div class="footer-brand">
            <img src="<?php echo e($settingNav&&$settingNav->logo ? asset('assets/admin/uploads/'.$settingNav->logo) : asset('assets_front/images/main_logo.png')); ?>" alt="سبأ" class="footer-brand-logo">
            <p><?php echo e(__('front.footer_about')); ?></p>
            <div class="footer-social">
                <?php if($settingNav->instagram??false): ?><a href="<?php echo e($settingNav->instagram); ?>" target="_blank" class="social-btn"><i class="fab fa-instagram"></i></a><?php endif; ?>
                <?php if($settingNav->facebook??false): ?><a href="<?php echo e($settingNav->facebook); ?>" target="_blank" class="social-btn"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
                <?php if($settingNav->twitter??false): ?><a href="<?php echo e($settingNav->twitter); ?>" target="_blank" class="social-btn"><i class="fab fa-x-twitter"></i></a><?php endif; ?>
            </div>
        </div>
        <div class="footer-col">
            <h4><?php echo e(__('front.quick_links')); ?></h4>
            <ul>
                <li><a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a></li>
                <li><a href="<?php echo e(route('menu')); ?>"><?php echo e(__('front.menu')); ?></a></li>
                <li><a href="<?php echo e(route('home')); ?>#about"><?php echo e(__('front.about')); ?></a></li>
                <li><a href="<?php echo e(route('home')); ?>#contact"><?php echo e(__('front.contact')); ?></a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4><?php echo e(__('front.contact')); ?></h4>
            <ul>
                <li><a href="#"><?php echo e($settingNav->address??''); ?></a></li>
                <li><a href="tel:<?php echo e($settingNav->phone??''); ?>"><?php echo e($settingNav->phone??''); ?></a></li>
                <li><a href="mailto:<?php echo e($settingNav->email??''); ?>"><?php echo e($settingNav->email??''); ?></a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p class="footer-copy">© <?php echo e(date('Y')); ?> <span><?php echo e(__('front.site_name')); ?></span> · <?php echo e(__('front.all_rights')); ?></p>
        <div class="footer-ornament">⬡ سبأ ⬡</div>
    </div>
</footer>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\saba\resources\views/user/menu.blade.php ENDPATH**/ ?>