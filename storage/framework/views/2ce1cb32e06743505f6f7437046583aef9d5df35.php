
<footer>
    <div class="footer-top">
        <div class="footer-brand">
            <img src="<?php echo e($settingNav && $settingNav->logo ? asset('assets/admin/uploads/'.$settingNav->logo) : asset('assets_front/images/main_logo.png')); ?>" alt="سبأ" class="footer-brand-logo">
            <p><?php echo e(__('front.footer_about')); ?></p>
            <div class="footer-social">
                <?php if($settingNav->instagram): ?><a href="<?php echo e($settingNav->instagram); ?>" target="_blank" class="social-btn"><i class="fab fa-instagram"></i></a><?php endif; ?>
                <?php if($settingNav->facebook): ?><a href="<?php echo e($settingNav->facebook); ?>" target="_blank" class="social-btn"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
                <?php if($settingNav->twitter): ?><a href="<?php echo e($settingNav->twitter); ?>" target="_blank" class="social-btn"><i class="fab fa-x-twitter"></i></a><?php endif; ?>
            </div>
        </div>
        <div class="footer-col">
            <h4><?php echo e(__('front.quick_links')); ?></h4>
            <ul>
                <li><a href="#about"><?php echo e(__('front.about')); ?></a></li>
                <li><a href="#best"><?php echo e(__('front.featured')); ?></a></li>
                <li><a href="<?php echo e(route('menu')); ?>"><?php echo e(__('front.menu')); ?></a></li>
                <li><a href="#videos"><?php echo e(__('front.videos')); ?></a></li>
                <li><a href="#hours"><?php echo e(__('front.hours')); ?></a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4><?php echo e(__('front.services')); ?></h4>
            <ul>
                <li><a href="#contact"><?php echo e(__('front.table_booking')); ?></a></li>
                <li><a href="#"><?php echo e(__('front.delivery')); ?></a></li>
                <li><a href="#"><?php echo e(__('front.events')); ?></a></li>
                <li><a href="#"><?php echo e(__('front.catering')); ?></a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4><?php echo e(__('front.contact')); ?></h4>
            <ul>
                <li><a href="#"><?php echo e($settingNav->address ?? ''); ?></a></li>
                <li><a href="tel:<?php echo e($settingNav->phone ?? ''); ?>"><?php echo e($settingNav->phone ?? ''); ?></a></li>
                <li><a href="mailto:<?php echo e($settingNav->email ?? ''); ?>"><?php echo e($settingNav->email ?? ''); ?></a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p class="footer-copy">© <?php echo e(date('Y')); ?> <span><?php echo e(__('front.site_name')); ?></span> · <?php echo e(__('front.all_rights')); ?></p>
        <div class="footer-ornament">⬡ سبأ ⬡</div>
    </div>
</footer>
<?php /**PATH C:\xampp\htdocs\saba\resources\views/user/includes/footer.blade.php ENDPATH**/ ?>