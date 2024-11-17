<?php $__env->startSection('title', 'Pulsetracker blog'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <div class="row">
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 mb-5">
                    <div class="card h-100 p-1 rounded" style="background-color: #1c1c1c;">
                        <img src="<?php echo e($blog->cover); ?>" class="card-img-top rounded" style="height: 60%;" alt="<?php echo e($blog->cover_alt); ?>">
                        <div class="card-body" style="height: 40%;">
                            <h5><a href="<?php echo e(url('blogs/blog/'.$blog->slug)); ?>" class="card-title" style="text-decoration: none;"><?php echo e($blog->title); ?></a></h5>
                            <h6><small class="float-end"><?php echo e($blog->created_at->format("Y-m-d")); ?></small></h6>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php echo e($blogs->links()); ?>

    </div>

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/blogs.blade.php ENDPATH**/ ?>