<?php $__env->startSection('content'); ?>
<div class="container">

    <h3 class="mb-4"><?php echo e(__('messages.edit_category')); ?></h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="<?php echo e(route('categories.update', $category->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="form-group">
                    <label><?php echo e(__('messages.category')); ?> (EN)</label>
                    <input type="text" name="name_en" class="form-control" value="<?php echo e($category->name_en); ?>" required>
                </div>

                <div class="form-group">
                    <label><?php echo e(__('messages.category')); ?> (AR)</label>
                    <input type="text" name="name_ar" class="form-control" value="<?php echo e($category->name_ar); ?>" required>
                </div>

                <button class="btn btn-primary mt-3"><?php echo e(__('messages.update')); ?></button>
            </form>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\saba\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>