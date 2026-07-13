
<?php
    $settingNav  = $setting ?? cache()->remember('site_setting', 3600, fn() => \App\Models\Setting::first());
    $current     = LaravelLocalization::getCurrentLocale();
    $supported   = LaravelLocalization::getSupportedLocales();
    $currentName = $supported[$current]['native'] ?? strtoupper($current);
?>

<nav id="navbar">
    <a href="<?php echo e(route('home')); ?>" class="nav-logo">
        <img src="<?php echo e($settingNav && $settingNav->logo ? asset('assets/admin/uploads/'.$settingNav->logo) : asset('assets_front/images/main_logo.png')); ?>" alt="سبأ">
    </a>
    <ul class="nav-links">
        <li><a href="<?php echo e(route('home')); ?>#about"><?php echo e(__('front.about')); ?></a></li>
        <li><a href="<?php echo e(route('home')); ?>#best"><?php echo e(__('front.featured')); ?></a></li>
        <li><a href="<?php echo e(route('menu')); ?>"><?php echo e(__('front.menu')); ?></a></li>
        <li><a href="<?php echo e(route('home')); ?>#videos"><?php echo e(__('front.videos')); ?></a></li>
        <li><a href="<?php echo e(route('home')); ?>#hours"><?php echo e(__('front.hours')); ?></a></li>
        <li><a href="<?php echo e(route('home')); ?>#contact"><?php echo e(__('front.contact')); ?></a></li>
        
        <li class="lang-dropdown-wrap">
            <button class="nav-lang lang-dropdown-btn" aria-haspopup="listbox" aria-expanded="false">
                <?php echo e($currentName); ?><svg class="lang-chevron" viewBox="0 0 10 6" width="10" height="6" fill="none"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <ul class="lang-dropdown-menu" role="listbox">
                <?php $__currentLoopData = $supported; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale => $props): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($locale !== $current): ?>
                        <li role="option">
                            <a hreflang="<?php echo e($locale); ?>" href="<?php echo e(LaravelLocalization::getLocalizedURL($locale, null, [], true)); ?>"><?php echo e($props['native']); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>
    </ul>
    
    <div class="nav-mobile-lang lang-dropdown-wrap">
        <button class="lang-dropdown-btn" aria-haspopup="listbox" aria-expanded="false">
            <?php echo e($currentName); ?><svg class="lang-chevron" viewBox="0 0 10 6" width="10" height="6" fill="none"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <ul class="lang-dropdown-menu" role="listbox">
            <?php $__currentLoopData = $supported; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale => $props): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($locale !== $current): ?>
                    <li role="option">
                        <a hreflang="<?php echo e($locale); ?>" href="<?php echo e(LaravelLocalization::getLocalizedURL($locale, null, [], true)); ?>"><?php echo e($props['native']); ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    
    <button class="nav-hamburger" id="navHamburger" aria-label="Menu" onclick="toggleDrawer()">
        <span></span><span></span><span></span>
    </button>
</nav>


<div class="nav-drawer-overlay" id="drawerOverlay" onclick="toggleDrawer()"></div>
<div class="nav-drawer" id="navDrawer">
    <button class="nav-drawer-close" onclick="toggleDrawer()" aria-label="Close">✕</button>
    <a href="<?php echo e(route('home')); ?>" class="nav-drawer-logo">
        <img src="<?php echo e($settingNav && $settingNav->logo ? asset('assets/admin/uploads/'.$settingNav->logo) : asset('assets_front/images/main_logo.png')); ?>" alt="سبأ">
    </a>
    <ul class="nav-drawer-links">
        <li><a href="<?php echo e(route('home')); ?>#about"   onclick="toggleDrawer()"><?php echo e(__('front.about')); ?></a></li>
        <li><a href="<?php echo e(route('home')); ?>#best"    onclick="toggleDrawer()"><?php echo e(__('front.featured')); ?></a></li>
        <li><a href="<?php echo e(route('menu')); ?>"         onclick="toggleDrawer()"><?php echo e(__('front.menu')); ?></a></li>
        <li><a href="<?php echo e(route('home')); ?>#videos"  onclick="toggleDrawer()"><?php echo e(__('front.videos')); ?></a></li>
        <li><a href="<?php echo e(route('home')); ?>#hours"   onclick="toggleDrawer()"><?php echo e(__('front.hours')); ?></a></li>
        <li><a href="<?php echo e(route('home')); ?>#contact" onclick="toggleDrawer()"><?php echo e(__('front.contact')); ?></a></li>
        
        <li class="lang-dropdown-wrap drawer-lang-wrap">
            <button class="nav-drawer-lang lang-dropdown-btn" aria-haspopup="listbox" aria-expanded="false">
                <?php echo e($currentName); ?><svg class="lang-chevron" viewBox="0 0 10 6" width="10" height="6" fill="none"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <ul class="lang-dropdown-menu drawer-lang-menu">
                <?php $__currentLoopData = $supported; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale => $props): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($locale !== $current): ?>
                        <li>
                            <a onclick="toggleDrawer()" hreflang="<?php echo e($locale); ?>" href="<?php echo e(LaravelLocalization::getLocalizedURL($locale, null, [], true)); ?>"><?php echo e($props['native']); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>
    </ul>
</div>

<script>
function toggleDrawer() {
    document.getElementById('navDrawer').classList.toggle('open');
    document.getElementById('drawerOverlay').classList.toggle('open');
    document.body.classList.toggle('drawer-open');
}

(function () {
    function closeAll() {
        document.querySelectorAll('.lang-dropdown-menu.open').forEach(function (m) {
            m.classList.remove('open');
            var btn = m.closest('.lang-dropdown-wrap').querySelector('.lang-dropdown-btn');
            if (btn) btn.setAttribute('aria-expanded', 'false');
        });
    }

    document.addEventListener('click', closeAll);

    document.querySelectorAll('.lang-dropdown-wrap').forEach(function (wrap) {
        var btn  = wrap.querySelector('.lang-dropdown-btn');
        var menu = wrap.querySelector('.lang-dropdown-menu');
        if (!btn || !menu) return;
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            var isOpen = menu.classList.contains('open');
            closeAll();
            if (!isOpen) {
                menu.classList.add('open');
                btn.setAttribute('aria-expanded', 'true');
            }
        });
    });
}());
</script>
<?php /**PATH C:\xampp\htdocs\saba\resources\views/user/includes/navbar.blade.php ENDPATH**/ ?>