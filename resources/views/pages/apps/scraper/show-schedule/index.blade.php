<x-default-layout>
    @section('title')
        Web Scraper
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('scraper.show-schedule') }}
    @endsection

    <div class="card">
        <h1>Scheduled Tasks</h1>
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search customer" id="mySearchInput"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add user-->
                    <a href="{{ route('scraper.scheduler') }}">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal">
                            {!! getIcon('plus', 'fs-2', '', 'i') !!}
                            Schedule Scrape
                        </button>
                    </a>
                    <!--end::Add user-->
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
                            <th>Task ID</th>
                            <th>Query</th>
                            <th>Schedule Times</th>
                            <th>Frequency</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($scheduledSearches as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->query }}</td>
                                <td>{{ implode(', ', $task->schedule_times) }}</td>
                                <td>{{ ucfirst($task->frequency) }}</td>
                                <td>{{ $task->created_at }}</td>
                                <td>
                                    <!-- Action buttons -->
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                    <form action="{{ route('scraper.scheduler.destroy', $task->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                    <form action="{{ route('scraper.scheduler.item.toggle-active', $task->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button id="toggleButton" class="btn btn-sm btn-primary {{ $task->isActive ? 'btn-primary' : 'btn-danger' }}" onclick="toggleButton()">
                                            {{ $task->isActive ? 'Start' : 'Stop' }}
                                        </button>
                                    </form>
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

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            document.getElementById('mySearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['users-table'].search(this.value).draw();
            });
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_user').modal('hide');
                    window.LaravelDataTables['users-table'].ajax.reload();
                });
            });
            $('#kt_modal_add_user').on('hidden.bs.modal', function () {
                Livewire.dispatch('new_user');
            });
        </script>
    @endpush

</x-default-layout>

<script>
        function toggleButton() {
            const button = document.getElementById('toggleButton');
            if (button.innerText === "Start") {
                button.innerText = "Stop";
                button.classList.remove('btn-primary');
                button.classList.add('btn-danger');
            } else {
                button.innerText = "Start";
                button.classList.remove('btn-danger');
                button.classList.add('btn-primary');
            }
        }
</script>