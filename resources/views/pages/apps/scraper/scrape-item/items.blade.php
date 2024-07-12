<div class="container">
    <p>{{ $totalRows }} number of rows.</p>
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
                @foreach ($post_titles as $i => $post_title)
                <tr data-row-id="{{ $i }}">
                    <td><button class="favourite-btn">Favourite</button></td>
                    <td>{{ $post_title }}</td>
                    <td><img src="{{ $image_urls[$i] }}" alt="Image"></td>
                    <td><a href="{{ $page_urls[$i] }}" target="_blank"><button>URL</button></a></td>
                    <td>{{ $descriptions[$i] }}</td>
                    <td>
                        <p>{{ $replies[$i] }}</p>
                    </td>
                    <td data-class="location">{{ $locations[$i] }}</td>
                    <td>Whatsapp</td>
                    <td>{{ $usernames[$i] }}</td>
                    <td>{{ $updated_at[$i] }}</td>
                    <td>Post Time</td>
                    <td data-class="created-date">{{ $created_dates[$i] }}</td>
                </tr>
                @endforeach