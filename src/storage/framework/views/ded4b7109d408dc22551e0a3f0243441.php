<aside id="cookies-policy" class="cookies cookies--no-js" data-text="<?php echo e(json_encode(__('cookieConsent::cookies.details'))); ?>">
    <div class="cookies__alert">
        <div class="cookies__container">
            <div class="cookies__wrapper">
                <h2 class="cookies__title"><?php echo app('translator')->get('cookieConsent::cookies.title'); ?></h2>
                <div class="cookies__intro">
                    <p><?php echo app('translator')->get('cookieConsent::cookies.intro'); ?></p>
                    <?php if($policy): ?>
                        <p><?php echo app('translator')->get('cookieConsent::cookies.link', ['url' => $policy]); ?></p>
                    <?php endif; ?>
                </div>
                <div class="cookies__actions">
                    <?php echo Whitecube\LaravelCookieConsent\Facades\Cookies::renderButton(action: 'accept.essentials', label: __('cookieConsent::cookies.essentials'), attributes: ['class' => 'cookiesBtn cookiesBtn--essentials']); ?>
                    <?php echo Whitecube\LaravelCookieConsent\Facades\Cookies::renderButton(action: 'accept.all', label: __('cookieConsent::cookies.all'), attributes: ['class' => 'cookiesBtn cookiesBtn--accept']); ?>
                </div>
            </div>
        </div>
            <a href="#cookies-policy-customize" class="cookies__btn cookies__btn--customize">
                <span><?php echo app('translator')->get('cookieConsent::cookies.customize'); ?></span>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M14.7559 11.9782C15.0814 11.6527 15.0814 11.1251 14.7559 10.7996L10.5893 6.63297C10.433 6.47669 10.221 6.3889 10 6.38889C9.77899 6.38889 9.56703 6.47669 9.41075 6.63297L5.24408 10.7996C4.91864 11.1251 4.91864 11.6527 5.24408 11.9782C5.56951 12.3036 6.09715 12.3036 6.42259 11.9782L10 8.40074L13.5774 11.9782C13.9028 12.3036 14.4305 12.3036 14.7559 11.9782Z" fill="#2C2E30"/>
                </svg>
            </a>
        <div class="cookies__expandable cookies__expandable--custom" id="cookies-policy-customize">
            <form action="<?php echo e(route('cookieconsent.accept.configuration')); ?>" method="post" class="cookies__customize">
                <?php echo csrf_field(); ?>
                <div class="cookies__sections">
                    <?php $__currentLoopData = $cookies->getCategories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="cookies__section">
                        <label for="cookies-policy-check-<?php echo e($category->key()); ?>" class="cookies__category">
                            <?php if($category->key() === 'essentials'): ?>
                                <input type="hidden" name="categories[]" value="<?php echo e($category->key()); ?>" />
                                <input type="checkbox" name="categories[]" value="<?php echo e($category->key()); ?>" id="cookies-policy-check-<?php echo e($category->key()); ?>" checked="checked" disabled="disabled" />
                            <?php else: ?>
                                <input type="checkbox" name="categories[]" value="<?php echo e($category->key()); ?>" id="cookies-policy-check-<?php echo e($category->key()); ?>" />
                            <?php endif; ?>
                            <span class="cookies__box">
                                <strong class="cookies__label"><?php echo e($category->title); ?></strong>
                            </span>
                            <?php if($category->description): ?>
                                <p class="cookies__info"><?php echo e($category->description); ?></p>
                            <?php endif; ?>
                        </label>

                        <div class="cookies__expandable" id="cookies-policy-<?php echo e($category->key()); ?>">
                            <ul class="cookies__definitions">
                                <?php $__currentLoopData = $category->getCookies(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cookie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="cookies__cookie">
                                    <p class="cookies__name"><?php echo e($cookie->name); ?></p>
                                    <p class="cookies__duration"><?php echo e(\Carbon\CarbonInterval::minutes($cookie->duration)->cascade()); ?></p>
                                    <?php if($cookie->description): ?>
                                        <p class="cookies__description"><?php echo e($cookie->description); ?></p>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <a href="#cookies-policy-<?php echo e($category->key()); ?>" class="cookies__details"><?php echo app('translator')->get('cookieConsent::cookies.details.more'); ?></a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="cookies__save">
                    <button type="submit" class="cookiesBtn__link"><?php echo app('translator')->get('cookieConsent::cookies.save'); ?></button>
                </div>
            </form>
        </div>
    </div>
</aside>



<script data-cookie-consent>
    <?php echo file_get_contents(LCC_ROOT . '/dist/script.js'); ?>

</script>
<style data-cookie-consent>
    <?php echo file_get_contents(LCC_ROOT . '/dist/style.css'); ?>

</style>
<?php /**PATH /var/www/html/vendor/whitecube/laravel-cookie-consent/resources/views/cookies.blade.php ENDPATH**/ ?>