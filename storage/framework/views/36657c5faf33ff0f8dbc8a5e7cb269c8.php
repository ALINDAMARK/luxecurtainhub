

<?php $__env->startSection('content'); ?>
<section class="admin-page-header admin-page-header-row">
    <div>
        <div class="admin-kicker"><?php echo e($config['title']); ?></div>
        <h1><?php echo e($config['title']); ?> Manager</h1>
        <p>Create, update, and remove website content from this section.</p>
    </div>
    <a class="admin-button-link" href="<?php echo e(route('admin.create', $section)); ?>">Add New</a>
</section>

<?php if(session('success')): ?>
    <div class="admin-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<section class="admin-panel">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <?php $__currentLoopData = $config['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e(str_replace('_', ' ', ucfirst($column))); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <?php $__currentLoopData = $config['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td>
                                <?php if(is_bool($item->{$column} ?? null)): ?>
                                    <?php echo e($item->{$column} ? 'Yes' : 'No'); ?>

                                <?php else: ?>
                                    <?php echo e($item->{$column} ?? '-'); ?>

                                <?php endif; ?>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <td>
                            <a href="<?php echo e(route('admin.edit', [$section, $item->id])); ?>">Edit</a>
                            <form action="<?php echo e(route('admin.destroy', [$section, $item->id])); ?>" method="POST" class="admin-inline-form" onsubmit="return confirm('Delete this item?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="<?php echo e(count($config['columns']) + 1); ?>" class="admin-empty">No records yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MARK ARINDA\Desktop\LuxeCurtainHub\resources\views/admin/resource-index.blade.php ENDPATH**/ ?>