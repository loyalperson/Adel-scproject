<x-default-layout>
    @section('title')
        Favourites
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('scraper.history.favourites') }}
    @endsection

    <div class="container" style="overflow-x: auto;">
        <h1>Search Results</h1>
        <a href="{{ route('scraper.index') }}" class="btn btn-secondary">Back to Search</a>
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
                        @foreach($favourites as $favourite)
                            <tr>
                                {!! str_replace(
                                    ['favourite-btn', 'Favourite', '<button'], 
                                    ['delete-btn', 'Delete', '<button data-favourite-id="'.$favourite->id.'"'], 
                                    $favourite->html_content) 
                                !!}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-default-layout>

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
                xhr.open('POST', '{{ route("scraper.history.favourites.remove") }}', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
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
</script>