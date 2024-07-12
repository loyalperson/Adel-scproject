<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\PermissionsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PermissionsDataTable $dataTable)
    {

        $customer = Customer::find(1);
        $payments = $customer->payments;

        return $dataTable->render('pages/apps.customers.customers-details.index', compact('customer'));
    }

    public function show($id)
    {
        $customer = Customer::with(['payments'])->findOrFail($id);

        return view('pages/apps/customers/customers-details/index', compact('customer'));
    }
}