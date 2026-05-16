

<?php $__env->startSection('content'); ?>
<section class="grid-section">
    <h1>Our Curtain Collection</h1>
    <p style="margin:.75rem 0 2rem;max-width:720px;line-height:1.8;color:var(--ash);">A simple gallery of the curtain products we have made. Browse the images, fabrics, and styles, then contact us if you want something similar for your space.</p>
    <div class="card-grid">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="card">
                <img src="<?php echo e($product['image_url'] ?? 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg'); ?>" alt="<?php echo e($product['name']); ?>" style="width:100%;height:260px;object-fit:cover;border-radius:16px;margin-bottom:1rem;">
                <h3><?php echo e($product['name']); ?></h3>
                <p><?php echo e($product['category']); ?></p>
                <?php if(!empty($product['description'])): ?>
                    <p style="margin-top:.75rem;line-height:1.8;color:var(--ash);"><?php echo e($product['description']); ?></p>
                <?php endif; ?>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MARK ARINDA\Desktop\LuxeCurtainHub\resources\views/products.blade.php ENDPATH**/ ?>