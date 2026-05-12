<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Admin Login'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
</head>
<body class="admin-login-page">
    <form class="admin-login-card" action="<?php echo e(route('admin.login.attempt')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="admin-login-kicker">Admin Access</div>
        <h1>Manage LuxeCurtain Hub</h1>
        <p>Enter the admin key to manage products, articles, orders, stories, and site images.</p>

        <label for="admin_key">Admin Key</label>
        <input id="admin_key" name="admin_key" type="password" placeholder="Enter admin key" value="<?php echo e(old('admin_key')); ?>">
        <?php $__errorArgs = ['admin_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="admin-error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <button type="submit" class="admin-button">Enter Dashboard</button>
        <div class="admin-note">Default scaffold key: luxe-curtain-admin unless ADMIN_PANEL_KEY is set.</div>
    </form>
</body>
</html>
<?php /**PATH C:\Users\MARK ARINDA\Desktop\LuxeCurtainHub\resources\views/admin/login.blade.php ENDPATH**/ ?>