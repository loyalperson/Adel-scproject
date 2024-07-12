<div class="container">
    <p><?php echo e($totalRows); ?> number of rows.</p>
    <div class="table-responsive">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
                <tr>
                    <th>Favourite</th>
                    <th>Post Title</th>
                    <th>Image URL</th>
                    <th>Page URL</th>
                    <th>Description</th>
                    <th>Replies</th>
                    <th>Location</th>
                    <th>Whatsapp</th>
                    <th>Username</th>
                    <th>Updated At</th>
                    <th>Post Time</th>
                    <th>Created Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $post_titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $post_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr data-row-id="<?php echo e($i); ?>">
                    <td><button class="favourite-btn">Favourite</button></td>
                    <td><?php echo e($post_title); ?></td>
                    <td><img src="<?php echo e($image_urls[$i]); ?>" alt="Image"></td>
                    <td><a href="<?php echo e($page_urls[$i]); ?>" target="_blank"><button>URL</button></a></td>
                    <td><?php echo e($descriptions[$i]); ?></td>
                    <td>
                        <p><?php echo e($replies[$i]); ?></p>
                    </td>
                    <td data-class="location"><?php echo e($locations[$i]); ?></td>
                    <td>Whatsapp</td>
                    <td><?php echo e($usernames[$i]); ?></td>
                    <td><?php echo e($updated_at[$i]); ?></td>
                    <td>Post Time</td>
                    <td data-class="created-date"><?php echo e($created_dates[$i]); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home/scanlolo/public_html/scproject.muthallath.com/resources/views/pages/apps/scraper/scrape-item/items.blade.php ENDPATH**/ ?>