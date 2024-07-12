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
    <?php $__env->startSection('title'); ?>
        Web Scraper
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('breadcrumbs'); ?>
        <?php echo e(Breadcrumbs::render('scraper.index')); ?>

    <?php $__env->stopSection(); ?>

    <div class="container">
        <h1>Web Scraper</h1>
        <form action="<?php echo e(route('scraper.search')); ?>" method="GET">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="query">Search Query</label>
                <input type="text" class="form-control" id="query" name="query" required>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
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
<?php endif; ?><?php /**PATH /home/scanlolo/public_html/scproject.muthallath.com/resources/views/pages/apps/scraper/index.blade.php ENDPATH**/ ?>