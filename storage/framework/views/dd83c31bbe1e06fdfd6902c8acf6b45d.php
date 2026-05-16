

<?php $__env->startSection('content'); ?>
<section class="admin-page-header admin-page-header-row">
    <div>
        <div class="admin-kicker"><?php echo e($config['title']); ?></div>
        <h1><?php echo e($item ? 'Edit' : 'Create'); ?> <?php echo e($config['title']); ?></h1>
    </div>
    <a class="admin-button-link" href="<?php echo e(route('admin.index', $section)); ?>">Back to List</a>
</section>

<?php if($errors->any()): ?>
    <div class="admin-error-box">
        Please fix the highlighted fields and try again.
    </div>
<?php endif; ?>

<section class="admin-panel">
    <form action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data" class="admin-form-grid">
        <?php echo csrf_field(); ?>
        <?php if($method !== 'POST'): ?>
            <?php echo method_field($method); ?>
        <?php endif; ?>

        <?php $__currentLoopData = $config['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="admin-field admin-field-<?php echo e($field['type']); ?>">
                <label for="<?php echo e($field['name']); ?>"><?php echo e($field['label']); ?></label>

                <?php if($field['type'] === 'textarea'): ?>
                    <textarea id="<?php echo e($field['name']); ?>" name="<?php echo e($field['name']); ?>"><?php echo e(old($field['name'], data_get($item, $field['name']))); ?></textarea>
                <?php elseif($field['type'] === 'select'): ?>
                    <select id="<?php echo e($field['name']); ?>" name="<?php echo e($field['name']); ?>">
                        <option value="">Select...</option>
                        <?php $__currentLoopData = $field['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value); ?>" <?php if(old($field['name'], data_get($item, $field['name'])) == $value): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                <?php elseif($field['type'] === 'checkbox'): ?>
                    <div class="admin-checkbox-row">
                        <input id="<?php echo e($field['name']); ?>" name="<?php echo e($field['name']); ?>" type="checkbox" value="1" <?php if(old($field['name'], data_get($item, $field['name'], false))): echo 'checked'; endif; ?>>
                        <span>Enabled</span>
                    </div>
                <?php elseif($field['type'] === 'file'): ?>
                    <input type="file" name="image_file" id="image_file" accept="image/*">
                    <?php if($item && data_get($item, 'image_url')): ?>
                        <img src="<?php echo e(data_get($item, 'image_url')); ?>" alt="Current image" class="admin-preview">
                    <?php endif; ?>
                <?php else: ?>
                    <input
                        id="<?php echo e($field['name']); ?>"
                        name="<?php echo e($field['name']); ?>"
                        type="<?php echo e($field['type']); ?>"
                        value="<?php echo e(old($field['name'], data_get($item, $field['name']))); ?>"
                        <?php if(!empty($field['step'])): ?> step="<?php echo e($field['step']); ?>" <?php endif; ?>
                    >
                <?php endif; ?>

                <?php $__errorArgs = [$field['name']];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="admin-field-error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php if($field['type'] === 'file'): ?>
                    <?php $__errorArgs = ['image_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="admin-field-error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="admin-form-actions">
            <button type="submit" class="admin-button">Save</button>
        </div>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MARK ARINDA\Desktop\LuxeCurtainHub\resources\views/admin/resource-form.blade.php ENDPATH**/ ?>