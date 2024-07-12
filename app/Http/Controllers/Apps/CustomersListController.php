<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\PermissionsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PermissionsDataTable $dataTable)
    {
        $customers = Customer::all();

        return $dataTable->render('pages/apps.customers.customers-list.index', compact('customers'));
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.customers-list.index')->with('success', 'Customer deleted successfully.');
    }
}