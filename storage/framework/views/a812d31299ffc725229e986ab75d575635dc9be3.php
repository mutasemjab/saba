<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 fw-bold">
            <i class="fas fa-utensils me-2 text-warning"></i>
            <?php echo e(__('messages.products')); ?>

        </h4>
        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> <?php echo e(__('messages.add_product')); ?>

        </a>
    </div>



    
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th width="50">#</th>
                        <th width="70"><?php echo e(__('messages.photo')); ?></th>
                        <th><?php echo e(__('messages.product')); ?></th>
                        <th><?php echo e(__('messages.category')); ?></th>
                        <th width="90"><?php echo e(__('messages.price')); ?></th>
                        <th width="90"><?php echo e(__('messages.featured')); ?></th>
                        <th width="160"><?php echo e(__('messages.actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-center text-muted small"><?php echo e($loop->iteration); ?></td>

                        <td class="text-center">
                            <img src="<?php echo e(asset('assets/admin/uploads/'.$item->photo)); ?>"
                                 width="52" height="52"
                                 style="object-fit:cover;border-radius:6px;border:1px solid #dee2e6"
                                 onerror="this.src='https://via.placeholder.com/52x52?text=IMG'">
                        </td>

                        <td>
                            <div class="fw-semibold"><?php echo e(app()->getLocale()=='ar' ? $item->name_ar : $item->name_en); ?></div>
                            <small class="text-muted"><?php echo e(app()->getLocale()=='ar' ? $item->name_en : $item->name_ar); ?></small>
                        </td>

                        <td>
                            <?php if($item->category): ?>
                                <span class="badge bg-secondary">
                                    <?php echo e(app()->getLocale()=='ar' ? $item->category->name_ar : $item->category->name_en); ?>

                                </span>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <?php if($item->price): ?>
                                <span class="fw-semibold text-success"><?php echo e($item->price); ?></span>
                                <small class="text-muted d-block"><?php echo e(app()->getLocale()=='ar' ? ($item->price_unit_ar??'درهم') : ($item->price_unit_en??'MAD')); ?></small>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <?php if($item->is_featured == 1): ?>
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-star me-1"></i><?php echo e(__('messages.yes')); ?>

                                </span>
                            <?php else: ?>
                                <span class="badge bg-light text-muted"><?php echo e(__('messages.no')); ?></span>
                            <?php endif; ?>
                        </td>


                        <td class="text-center">
                            <a href="<?php echo e(route('products.edit', $item->id)); ?>"
                               class="btn btn-sm btn-outline-warning" title="<?php echo e(__('messages.edit')); ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?php echo e(route('products.destroy', $item->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        title="<?php echo e(__('messages.delete')); ?>"
                                        onclick="confirmDelete(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="fas fa-box-open fa-2x mb-2 d-block"></i>
                            <?php echo e(__('messages.no_data')); ?>

                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($products->hasPages()): ?>
        <div class="card-footer"><?php echo e($products->links()); ?></div>
        <?php endif; ?>
    </div>

</div>

<?php $__env->startPush('scripts'); ?>
<script>
function confirmDelete(btn) {
    if (confirm('<?php echo e(__("messages.are_you_sure")); ?>')) {
        btn.closest('form').submit();
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\saba\resources\views/admin/products/index.blade.php ENDPATH**/ ?>