<x-default-layout>

    @section('title')
        Submit Ticket
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('tickets.submit-ticket.index') }}
    @endsection

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card card-flush" style="background-color: #F1416C; height: 75vh;">
        <div class="d-flex align-items-center h-100" style="position: relative;">
            <form action="{{ route('send.ticket') }}" method="POST" class="w-50 form-group mb-3 mx-5">
                @csrf
                <input type="text" class="form-control form-control-lg ps-10 rounded-pill mb-5" name="name" placeholder="Name" style="background-color: white; width: 50%">
                <input type="text" class="form-control form-control-lg ps-10 rounded-pill mb-5" name="email" placeholder="Email" style="background-color: white; width: 50%">
                <input type="text" class="form-control form-control-lg ps-10 rounded-pill mb-5" name="whatsapp" placeholder="Whatsapp" style="background-color: white; width: 50%">
                <input type="text" class="form-control form-control-lg ps-10 rounded-pill" name="ticket" placeholder="How can we help?" style="background-color: white; width: 100%">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>

</x-default-layout>