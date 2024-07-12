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
        Favourites
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('breadcrumbs'); ?>
        <?php echo e(Breadcrumbs::render('scraper.history.favourites')); ?>

    <?php $__env->stopSection(); ?>

    <div class="container" style="overflow-x: auto;">
        <h1>Search Results</h1>
        <a href="<?php echo e(route('scraper.index')); ?>" class="btn btn-secondary">Back to Search</a>
        <button id="exportBtn" class="btn btn-primary">Export to Excel</button>
        <div class="result">
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Remove From Favourites</th>
                            <th>Post Title</th>
                            <th>Image URL</th>
                            <th>Page URL</th>
                            <th>Description</th>
                            <th>Replies</th>
                            <th>Location</th>
                            <th>Whatsapp</th>
                            <th>Username</th>
                            <th>Post Time</th>
                            <th>Created Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $favourites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $favourite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php echo str_replace(
                                    ['favourite-btn', 'Favourite', '<button'], 
                                    ['delete-btn', 'Delete', '<button data-favourite-id="'.$favourite->id.'"'], 
                                    $favourite->html_content); ?>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
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
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Attach click event listener to all favorite buttons
        var favoriteButtons = document.querySelectorAll('.delete-btn');
        favoriteButtons.forEach(function(button) {
            button.disabled = false;
            button.addEventListener('click', function() {
                console.log("favouriteId");
                var row = button.closest('tr');
                var favouriteId = button.getAttribute('data-favourite-id');
                // Send AJAX request to Laravel backend to remove from favorites
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo e(route("scraper.history.favourites.remove")); ?>', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', '<?php echo e(csrf_token()); ?>');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        console.log("REMOVED FROM FAVORITES");
                        row.remove();
                    }
                    else {
                        var response = JSON.parse(xhr.responseText);
                    }
                };
                xhr.send(JSON.stringify({ favourite_id: favouriteId }));
            });
        });
    });
</script><?php /**PATH /home/scanlolo/public_html/scproject.muthallath.com/resources/views/pages/apps/scraper/favourites/index.blade.php ENDPATH**/ ?>