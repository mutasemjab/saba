<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>مطاعم سبأ | Sab'a Restaurants</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Cinzel+Decorative:wght@400;700;900&family=Tajawal:wght@300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets_front/CSS/main_styles.css')); ?>">

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>

    
    <div id="preloader">
        <?php $settingGlobal = $setting ?? \App\Models\Setting::first(); ?>
        <img src="<?php echo e($settingGlobal && $settingGlobal->logo
            ? asset('assets/admin/uploads/' . $settingGlobal->logo)
            : asset('assets_front/images/main_logo.png')); ?>"
            alt="سبأ" class="preloader-logo">
        <div class="preloader-bar">
            <div class="preloader-fill"></div>
        </div>
    </div>

    <div class="cursor" id="cursor"></div>
    <div class="cursor-ring" id="cursorRing"></div>
    <?php echo $__env->make('user.includes.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>
    <!-- Footer -->
    <?php echo $__env->make('user.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Preloader
        window.addEventListener('load', () => setTimeout(() => document.getElementById('preloader').classList.add('done'),
            2000));

        // Cursor
        const cursor = document.getElementById('cursor'),
            ring = document.getElementById('cursorRing');
        let mx = 0,
            my = 0,
            rx = 0,
            ry = 0;
        document.addEventListener('mousemove', e => {
            mx = e.clientX;
            my = e.clientY;
            cursor.style.transform = `translate(${mx-6}px,${my-6}px)`;
        });
        (function animRing() {
            rx += (mx - rx) * .12;
            ry += (my - ry) * .12;
            ring.style.transform = `translate(${rx-20}px,${ry-20}px)`;
            requestAnimationFrame(animRing);
        })();

        // Navbar
        window.addEventListener('scroll', () => document.getElementById('navbar').classList.toggle('scrolled', window
            .scrollY > 60));

        // Particles
        const pc = document.getElementById('particles');
        if (pc)
            for (let i = 0; i < 20; i++) {
                const p = document.createElement('div');
                p.className = 'particle';
                const s = Math.random() * 3 + 2;
                p.style.cssText =
                    `width:${s}px;height:${s}px;left:${Math.random()*100}%;animation-duration:${Math.random()*14+10}s;animation-delay:${Math.random()*10}s;`;
                pc.appendChild(p);
            }

        // Reveal
        const obs = new IntersectionObserver(entries => entries.forEach(e => e.isIntersecting && e.target.classList.add(
            'visible')), {
            threshold: .1
        });
        document.querySelectorAll('.reveal,.reveal-left,.reveal-right').forEach(el => obs.observe(el));

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const t = document.querySelector(a.getAttribute('href'));
                if (t) {
                    e.preventDefault();
                    t.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\saba\resources\views/layouts/front.blade.php ENDPATH**/ ?>