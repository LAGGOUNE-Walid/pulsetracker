<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <img src="<?php echo e($blog->cover); ?>" class="card-img-top" alt="<?php echo e($blog->cover_alt); ?>">
                <br/>
                <br/>
                <?php echo \Str::markdown($blog->content); ?>

                <br/>
                <small class="float-end"><?php echo e($blog->created_at); ?></small>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/blog.blade.php ENDPATH**/ ?>