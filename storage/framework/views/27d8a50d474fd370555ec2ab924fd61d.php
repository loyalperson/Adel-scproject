<?php if (isset($component)) { $__componentOriginal1c2e2f4f77e507b499e79defc0d48b7e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1c2e2f4f77e507b499e79defc0d48b7e = $attributes; } ?>
<?php $component = App\View\Components\DefaultLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('default-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\DefaultLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/web-scraper.css')); ?>">
    <?php $__env->startSection('title'); ?>
        Scraping History
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('breadcrumbs'); ?>
        <?php echo e(Breadcrumbs::render('scraper.history')); ?>

    <?php $__env->stopSection(); ?>

    <h1>Scraping History</h1>

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <?php echo getIcon('magnifier', 'fs-3 position-absolute ms-5'); ?>

                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search scrape" id="mySearchInput"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal-->
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('user.add-user-modal', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2973734180-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?></livewire:user.add-user-modal>
                <!--end::Modal-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-striped" id="users-table">
                    <thead>
                        <tr>
                            <th>Query</th>
                            <th>Search ID</th>
                            <th>Time Searched</th>
                            <th>Link to Scraped Page</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $searches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($search->query); ?></td>
                                <td><?php echo e($search->id); ?></td>
                                <td><?php echo e($search->created_at); ?></td>
                                <td>
                                    <a href="<?php echo e(route('scraper.history.details', $search->id)); ?>" class="text-dark fw-bold text-hover-primary">LINK HERE</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1c2e2f4f77e507b499e79defc0d48b7e)): ?>
<?php $attributes = $__attributesOriginal1c2e2f4f77e507b499e79defc0d48b7e; ?>
<?php unset($__attributesOriginal1c2e2f4f77e507b499e79defc0d48b7e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1c2e2f4f77e507b499e79defc0d48b7e)): ?>
<?php $component = $__componentOriginal1c2e2f4f77e507b499e79defc0d48b7e; ?>
<?php unset($__componentOriginal1c2e2f4f77e507b499e79defc0d48b7e); ?>
<?php endif; ?><?php /**PATH /home/scanlolo/public_html/scproject.muthallath.com/resources/views/pages/apps/scraper/history.blade.php ENDPATH**/ ?>