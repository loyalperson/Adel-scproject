<x-default-layout>
    @section('title')
        Web Scraper
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('scraper.index') }}
    @endsection

    <div class="container">
        <h1>Web Scraper</h1>
        <form action="{{ route('scraper.search') }}" method="GET">
            @csrf
            <div class="form-group">
                <label for="query">Search Query</label>
                <input type="text" class="form-control" id="query" name="query" required>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
</x-default-layout>