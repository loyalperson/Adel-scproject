<x-default-layout>

    @section('title')
        Tickets List
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('tickets.tickets-list.index') }}
    @endsection

    <h1>Tickets List</h1>

    @foreach ($tickets as $ticket)
        <div class="my-10 card-body align-items-end pt-0 rounded" style="background-color: #f1416c;">
            <p class="mx-2"><strong>Ticket:</strong> {{ $ticket->ticket }}</p>
            <p class="mx-2"><strong>Name:</strong> {{ $ticket->name }}</p>
            <p class="mx-2"><strong>Email:</strong> {{ $ticket->email }}</p>
            <p class="mx-2"><strong>WhatsApp:</strong> {{ $ticket->whatsapp }}</p>
        </div>
    @endforeach

</x-default-layout>