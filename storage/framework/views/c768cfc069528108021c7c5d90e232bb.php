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
        Results
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('breadcrumbs'); ?>
        <?php echo e(Breadcrumbs::render('scraper.result')); ?>

    <?php $__env->stopSection(); ?>
    <body style="overflow-x: auto;">
        <div class="container">
            <h1>Search Results</h1>
            <a href="<?php echo e(route('scraper.index')); ?>" class="btn btn-secondary">Back to Search</a>
            <button id="exportBtn" class="btn btn-primary">Export to Excel</button>
            <select id="dateFilter" class="duringdate" onchange="filterTable()">
                <option value="">All times</option>
                <option value="1days">Last 24 hours</option>
                <option value="3days">Last three days</option>
                <option value="1week">Last week</option>
                <option value="1months">Last month</option>
            </select>
            <select id="locationSelect" class="cities" onchange="filterTable()">
                <option value="">All cities</option>
                <option value="الرياض">Riyadh</option>
                <option value="الشرقيه">Eastern Region</option>
                <option value="جده">Jeddah</option>
                <option value="مكه">Makkah</option>
                <option value="ينبع">Yanbu</option>
                <option value="حفر الباطن">Hafar Al Batin</option>
                <option value="المدينة">Madinah</option>
                <option value="الطايف">Taif</option>
                <option value="تبوك">Tabouk</option>
                <option value="القصيم">Qassim</option>
                <option value="حائل">Hail</option>
                <option value="أبها">Abha</option>
                <option value="عسير">Aseer</option>
                <option value="الباحة">Bahah</option>
                <option value="جيزان">Jazan</option>
                <option value="نجران">Najran</option>
                <option value="الجوف">Jouf</option>
                <option value="عرعر">Arar</option>
                <option value="الكويت">Kuwait</option>
                <option value="الإمارات">UAE</option>
                <option value="البحرين">Bahrain</option>
            </select>
            <div class="result">
                <?php echo str_replace('href="', 'target="_blank" href="' . 'https://haraj.com.sa' . '/', $htmlContent); ?>

                <?php echo $htmlContent; ?>

            </div>
        </div>
    </body>
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
    document.getElementById('exportBtn').addEventListener('click', function() {
        var htmlContent = <?php echo json_encode($htmlContent); ?>;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo e(route("scraper.export")); ?>', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?php echo e(csrf_token()); ?>');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var blob = new Blob([xhr.responseText], { type: 'text/csv' });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'export.csv';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        };
        xhr.send(JSON.stringify({ htmlContent: htmlContent }));
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Attach click event listener to all favorite buttons
        var favoriteButtons = document.querySelectorAll('.favourite-btn');
        favoriteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Deactivate the button
                button.disabled = true;
                // Find the parent table row (tr element)
                var row = button.closest('tr');
                // Get the HTML content of the row
                var rowHtml = row.outerHTML;
                
                // Send AJAX request to Laravel backend
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/scraper/history/favourites/store', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', '<?php echo e(csrf_token()); ?>');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        console.log("SUCCESS");
                    }
                };
                xhr.send(JSON.stringify({ row_html: rowHtml }));
            });
        });
    });  
    
    function filterTable() {
        var locationSelect = document.getElementById("locationSelect");
        var dateFilter = document.getElementById("dateFilter").value;
        var selectedLocation = locationSelect.value;
        var table = document.getElementById("dataTable");
        var rows = table.getElementsByTagName("tr");
        
        // Reset display for all rows
        for (var i = 0; i < rows.length; i++) {
            rows[i].style.display = "";
        }

        var now = new Date();

        // Function to parse the date in the format "YYYY-MM-DD"
        function parseDate(dateString) {
            var parts = dateString.split("-");
            return new Date(parts[0], parts[1] - 1, parts[2]);
        }

        // Function to check if a date is within the given range
        function isWithinRange(date, days) {
            var timeDiff = now - date;
            var dayInMillis = 1000 * 60 * 60 * 24;
            return timeDiff <= days * dayInMillis;
        }

        // Calculate the number of days for each filter option
        var days;
        switch (dateFilter) {
            case "1days":
                days = 1;
                break;
            case "3days":
                days = 3;
                break;
            case "1week":
                days = 7;
                break;
            case "1months":
                days = 30;
                break;
            default:
                days = Infinity;
        }

        if (selectedLocation == "") {
            // Reset display for all rows
            for (var i = 1; i < rows.length; i++) {
                rows[i].style.display = "";
            }
        }
        else {
            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var locationCell = row.cells[6];
                var dateCell = row.querySelector('[data-class="created-date"]');
                if (locationCell && dateCell) {
                    var location = locationCell.innerText;
                    var date = parseDate(dateCell.innerText);

                    if ((location === selectedLocation && (isWithinRange(date, days) || days === Infinity))) {
                        console.log("HELLO");
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            }
        }
    }
</script><?php /**PATH /home/scanlolo/public_html/scproject.muthallath.com/resources/views/pages/apps/scraper/result.blade.php ENDPATH**/ ?>