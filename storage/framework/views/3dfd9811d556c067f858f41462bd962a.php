

<?php $__env->startSection('content'); ?>
<section class="admin-page-header">
    <div>
        <div class="admin-kicker">Dashboard</div>
        <h1>Website Control Center</h1>
        <p>Review orders, manage published content, and update site images from one place.</p>
    </div>
</section>

<section class="admin-stats-grid">
    <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="admin-stat-card">
            <span><?php echo e(ucfirst($label)); ?></span>
            <strong><?php echo e($value); ?></strong>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</section>

<section class="admin-two-column">
    <div class="admin-panel">
        <h2>Content Areas</h2>
        <div class="admin-resource-links">
            <?php $__currentLoopData = $resources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($resource['route']); ?>"><?php echo e($resource['label']); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="admin-panel">
        <h2>Recent Orders</h2>
        <?php if($recentOrders->isEmpty()): ?>
            <p class="admin-empty">No orders yet.</p>
        <?php else: ?>
            <div class="admin-list">
                <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="admin-list-item">
                        <strong><?php echo e($order->full_name); ?></strong>
                        <span><?php echo e($order->product_name); ?> · <?php echo e($order->status); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="admin-panel">
    <h2>Recent Consultations</h2>
    <?php if($recentConsultations->isEmpty()): ?>
        <p class="admin-empty">No consultation requests yet.</p>
    <?php else: ?>
        <div class="admin-list">
            <?php $__currentLoopData = $recentConsultations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="admin-list-item">
                    <strong><?php echo e($inquiry->full_name); ?></strong>
                    <span><?php echo e($inquiry->space_type); ?> · <?php echo e($inquiry->email); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MARK ARINDA\Desktop\LuxeCurtainHub\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>