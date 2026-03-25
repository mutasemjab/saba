<?php $__env->startSection('content'); ?>
<div class="container">

    <h2><?php echo e(__('messages.categories')); ?></h2>

    <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-primary mb-3">
        <?php echo e(__('messages.add_category')); ?>

    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th><?php echo e(__('messages.category')); ?></th>
                <th width="150"><?php echo e(__('messages.actions')); ?></th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e(app()->getLocale() == 'ar' ? $item->name_ar : $item->name_en); ?></td>
                <td>
                    <a href="<?php echo e(route('categories.edit', $item->id)); ?>" class="btn btn-sm btn-warning"><?php echo e(__('messages.edit')); ?></a>
                    <form action="<?php echo e(route('categories.destroy', $item->id)); ?>" method="POST" style="display:inline-block">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button onclick="return confirm('<?php echo e(__('messages.are_you_sure')); ?>')" class="btn btn-sm btn-danger">
                            <?php echo e(__('messages.delete')); ?>

                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\saba\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>