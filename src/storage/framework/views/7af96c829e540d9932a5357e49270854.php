<?php $__env->startSection('content'); ?>
    <div class="col m-5">
        <div class="p-5 mt-5" style="border: 1px solid #737272; border-radius: 10px;">
            <h3>Usage: &nbsp; <a class="btn btn-outline-success" role="button" style="color: white;"
                    href="<?php echo e(url('/#pricing')); ?>">Upgrade your account</a></h3>
            <div class="mt-5">
                <div class="row gy-5">
                    <div class="col col-6">
                        Current plan
                    </div>
                    <div class="col col-6">
                        <b>
                            <?php if($user->subscribedToPrice(config('stripe-subscriptions.plans.pro.price_id'), config('stripe-subscriptions.plans.pro.product_id'))): ?>
                                PRO
                                <?php $plan = config('stripe-subscriptions.plans.pro'); ?>
                            <?php elseif($user->subscribedToPrice(config('stripe-subscriptions.plans.enterprise.price_id'), config('stripe-subscriptions.plans.enterprise.product_id'))): ?>
                                ENTERPRISE
                                <?php $plan = config('stripe-subscriptions.plans.enterprise'); ?>
                            <?php else: ?>
                                FREE
                                <?php $plan = config('stripe-subscriptions.plans.free'); ?>
                            <?php endif; ?>
                        </b>
                    </div>
                    <div class="col col-6">
                        Applications <?php echo e($user->apps_count); ?>/<?php echo e($plan['size']['apps'] ?? 'UNLIMITED'); ?>

                    </div>
                    <div class="col col-6">
                        <div class="progress">
                            <?php
                                if ($plan['size']['apps']) {
                                    $plansPercentage = ($user->apps_count / $plan['size']['apps']) * 100;
                                } else {
                                    $plansPercentage = 0;
                                }

                            ?>
                            <div class="progress-bar" role="progressbar" style="width: <?php echo e($plansPercentage); ?>%"
                                aria-valuenow="<?php echo e($plansPercentage); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col col-6">
                        Devices <?php echo e($user->devices_count); ?>/<?php echo e($plan['size']['devices'] ?? 'UNLIMITED'); ?>

                    </div>
                    <div class="col col-6">
                        <div class="progress">
                            <?php
                                if ($plan['size']['devices']) {
                                    $devicesPercentage = ($user->devices_count / $plan['size']['devices']) * 100;
                                } else {
                                    $devicesPercentage = 0;
                                }
                            ?>
                            <div class="progress-bar" role="progressbar" style="width: <?php echo e($devicesPercentage); ?>%"
                                aria-valuenow="<?php echo e($devicesPercentage); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col col-6">
                        Messages this month
                        <?php echo e(number_format($user->currentUsage->messages_sent ?? 0)); ?>/<?php echo e($plan['size']['messages_per_month'] ? number_format($plan['size']['messages_per_month']) : 'UNLIMITED'); ?>

                    </div>
                    <div class="col col-6">
                        <div class="progress">
                            <?php
                                if (
                                    $plan['size']['messages_per_month'] and
                                    $user->currentUsage->messages_sent
                                ) {
                                    $messagesPercentage =
                                        ($user->locationsCounts->first()->messages_sent /
                                            $plan['size']['messages_per_month']) *
                                        100;
                                } else {
                                    $messagesPercentage = 0;
                                }
                            ?>
                            <div class="progress-bar" role="progressbar" style="width: <?php echo e($messagesPercentage); ?>%"
                                aria-valuenow="<?php echo e($messagesPercentage); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/dashboard/index.blade.php ENDPATH**/ ?>