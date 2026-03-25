
<?php
    $settingNav = $setting ?? \App\Models\Setting::first();
    $current    = LaravelLocalization::getCurrentLocale();
    $target     = $current === 'ar' ? 'en' : 'ar';
    $supported  = LaravelLocalization::getSupportedLocales();
    $targetName = $target === 'ar'
        ? ($supported[$target]['native'] ?? 'العربية')
        : ($supported[$target]['native'] ?? 'English');
    $targetUrl  = LaravelLocalization::getLocalizedURL($target, null, [], true);
?>

<nav id="navbar">
    <a href="<?php echo e(route('home')); ?>" class="nav-logo">
        <img src="<?php echo e($settingNav && $settingNav->logo ? asset('assets/admin/uploads/'.$settingNav->logo) : asset('assets_front/images/main_logo.png')); ?>" alt="سبأ">
    </a>
    <ul class="nav-links">
        <li><a href="#about"><?php echo e(__('front.about')); ?></a></li>
        <li><a href="#best"><?php echo e(__('front.featured')); ?></a></li>
        <li><a href="#menu"><?php echo e(__('front.menu')); ?></a></li>
        <li><a href="#videos"><?php echo e(__('front.videos')); ?></a></li>
        <li><a href="#hours"><?php echo e(__('front.hours')); ?></a></li>
        <li><a href="#contact"><?php echo e(__('front.contact')); ?></a></li>
        <li><a class="nav-lang" hreflang="<?php echo e($target); ?>" href="<?php echo e($targetUrl); ?>"><?php echo e($targetName); ?></a></li>
    </ul>
    <a href="#contact" class="nav-reserve"><?php echo e(__('front.book_table')); ?></a>
</nav><?php /**PATH C:\xampp\htdocs\saba\resources\views/user/includes/navbar.blade.php ENDPATH**/ ?>