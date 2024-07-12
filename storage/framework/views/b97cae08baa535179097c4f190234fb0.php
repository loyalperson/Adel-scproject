<?php if (isset($component)) { $__componentOriginala6488acc797ee40bc55ed6344dee8ea1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6488acc797ee40bc55ed6344dee8ea1 = $attributes; } ?>
<?php $component = App\View\Components\AuthLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('auth-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AuthLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="<?php echo e(route('dashboard')); ?>" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">
                Sign In
            </h1>
            <!--end::Title-->

            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">
                Your Social Campaigns
            </div>
            <!--end::Subtitle--->
        </div>
        <!--begin::Heading-->

        <!--begin::Login options-->
        <div class="row g-3 mb-9">
            <!--begin::Col-->
            <div class="col-md-6">
                <!--begin::Google link--->
                <a href="<?php echo e(url('/auth/redirect/google')); ?>?redirect_uri=<?php echo e(url()->current()); ?>" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                    <img alt="Logo" src="<?php echo e(image('svg/brand-logos/google-icon.svg')); ?>" class="h-15px me-3"/>
                    Sign in with Google
                </a>
                <!--end::Google link--->
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6">
                <!--begin::Google link--->
                <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                    <img alt="Logo" src="<?php echo e(image('svg/brand-logos/apple-black.svg')); ?>" class="theme-light-show h-15px me-3"/>
                    <img alt="Logo" src="<?php echo e(image('svg/brand-logos/apple-black-dark.svg')); ?>" class="theme-dark-show h-15px me-3"/>
                    Sign in with Apple
                </a>
                <!--end::Google link--->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Login options-->

        <!--begin::Separator-->
        <div class="separator separator-content my-14">
            <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
        </div>
        <!--end::Separator-->

        <!--begin::Input group--->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" value="demo@demo.com"/>
            <!--end::Email-->
        </div>

        <!--end::Input group--->
        <div class="fv-row mb-3">
            <!--begin::Password-->
            <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" value="demo"/>
            <!--end::Password-->
        </div>
        <!--end::Input group--->

        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>

            <!--begin::Link-->
            <a href="<?php echo e(route('password.request')); ?>" class="link-primary">
                Forgot Password ?
            </a>
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                <?php echo $__env->make('partials/general/_button-indicator', ['label' => 'Sign In'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </button>
        </div>
        <!--end::Submit button-->

        <!--begin::Sign up-->
        <div class="text-gray-500 text-center fw-semibold fs-6">
            Not a Member yet?

            <a href="<?php echo e(route('register')); ?>" class="link-primary">
                Sign up
            </a>
        </div>
        <!--end::Sign up-->
    </form>
    <!--end::Form-->

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6488acc797ee40bc55ed6344dee8ea1)): ?>
<?php $attributes = $__attributesOriginala6488acc797ee40bc55ed6344dee8ea1; ?>
<?php unset($__attributesOriginala6488acc797ee40bc55ed6344dee8ea1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6488acc797ee40bc55ed6344dee8ea1)): ?>
<?php $component = $__componentOriginala6488acc797ee40bc55ed6344dee8ea1; ?>
<?php unset($__componentOriginala6488acc797ee40bc55ed6344dee8ea1); ?>
<?php endif; ?>
<?php /**PATH /home/scanlolo/public_html/scproject.muthallath.com/resources/views/pages/auth/login.blade.php ENDPATH**/ ?>