<x-default-layout>
    <link rel="stylesheet" href="{{ asset('assets/css/web-scraper.css') }}">
    @section('title')
        Scraping History
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('scraper.history') }}
    @endsection

    <h1>Scraping History</h1>

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
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
                <livewire:user.add-user-modal></livewire:user.add-user-modal>
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
                        @foreach ($searches as $search)
                            <tr>
                                <td>{{ $search->query }}</td>
                                <td>{{ $search->id }}</td>
                                <td>{{ $search->created_at }}</td>
                                <td>
                                    <a href="{{ route('scraper.history.details', $search->id) }}" class="text-dark fw-bold text-hover-primary">LINK HERE</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

</x-default-layout>