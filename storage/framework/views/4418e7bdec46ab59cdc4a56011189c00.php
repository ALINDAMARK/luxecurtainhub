<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Admin Panel'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
</head>
<body class="admin-shell">
    <aside class="admin-sidebar">
        <div>
            <div class="admin-brand">LuxeCurtain Hub</div>
            <div class="admin-subtitle">Administration</div>
        </div>
        <nav class="admin-nav">
            <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
            <a href="<?php echo e(route('admin.index', 'products')); ?>">Products</a>
            <a href="<?php echo e(route('admin.index', 'blog-posts')); ?>">Blog Posts</a>
            <a href="<?php echo e(route('admin.index', 'success-stories')); ?>">Success Stories</a>
            <a href="<?php echo e(route('admin.index', 'site-images')); ?>">Site Images</a>
            <a href="<?php echo e(route('admin.index', 'orders')); ?>">Orders</a>
            <a href="<?php echo e(route('admin.index', 'consultations')); ?>">Consultations</a>
        </nav>
        <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="admin-logout">Logout</button>
        </form>
    </aside>

    <main class="admin-main">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html>
<?php /**PATH C:\Users\MARK ARINDA\Desktop\LuxeCurtainHub\resources\views/admin/layout.blade.php ENDPATH**/ ?>