<x-default-layout>
    @section('title')
        Customer Details
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('customers.customers-details.index') }}
    @endsection

    <div class="container">
        <div class="row">
            <!-- Customer Details Section -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('path/to/profile/image.jpg') }}" class="rounded-circle mb-3" alt="Profile Image">
                        <h3>{{ $customer->name }}</h3>
                        <p class="text-muted">{{ $customer->email }}</p>
                        <p class="text-muted">{{ $customer->whatsapp }}</p>

                        <div class="d-flex justify-content-between my-4">
                            <div class="text-center">
                                <h5 class="mb-0">{{ $customer->earnings }}</h5>
                                <small class="text-muted">Earnings</small>
                            </div>
                            <div class="text-center">
                                <h5 class="mb-0">{{ $customer->tasks }}</h5>
                                <small class="text-muted">Tasks</small>
                            </div>
                            <div class="text-center">
                                <h5 class="mb-0">{{ $customer->hours }}</h5>
                                <small class="text-muted">Hours</small>
                            </div>
                        </div>

                        <a href="#" class="btn btn-primary">Edit</a>
                    </div>

                    <div class="card-footer">
                        <h6 class="mb-0">Details</h6>
                        <p class="text-muted">Account ID: {{ $customer->id }}</p>
                        <p class="text-muted">Billing Email: {{ $customer->billing_email }}</p>
                        <p class="text-muted">Billing Address: {{ $customer->billing_address }}</p>
                        <p class="text-muted">Language: {{ $customer->language }}</p>
                        <p class="text-muted">Upcoming Invoice: {{ $customer->upcoming_invoice }}</p>
                        <p class="text-muted">Tax ID: {{ $customer->tax_id }}</p>
                        <p class="text-muted">Created At: {{ $customer->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Records Section -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Payment Records</h5>
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
                            Add Payment
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Invoice No.</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer->payments as $payment)
                                    <tr>
                                        <td>{{ $payment->invoice_no }}</td>
                                        <td>
                                            <span class="badge bg-{{ $payment->status == 'Successful' ? 'success' : ($payment->status == 'Pending' ? 'warning' : 'danger') }}">
                                                {{ $payment->status }}
                                            </span>
                                        </td>
                                        <td>${{ number_format($payment->amount, 2) }}</td>
                                        <td>{{ $payment->created_at->format('d M Y, h:i A') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li><a class="dropdown-item" href="#">Edit</a></li>
                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Payment Methods Section -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title">Payment Methods</h5>
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addPaymentMethodModal">
                            Add Payment Method
                        </button>
                    </div>
                    <div class="card-body">
                        {{ $customer->{ 'payment-method' } }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Payment Modal -->
    <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal content here -->
            </div>
        </div>
    </div>

    <!-- Add Payment Method Modal -->
    <div class="modal fade" id="addPaymentMethodModal" tabindex="-1" aria-labelledby="addPaymentMethodModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal content here -->
            </div>
        </div>
    </div>


</x-default-layout>