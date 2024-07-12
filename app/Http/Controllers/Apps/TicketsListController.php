<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\UsersAssignedRoleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TicketsListController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();

        // Logic to handle ticket submission
        return view('pages/apps.tickets.tickets-list.index', compact('tickets'));
    }
}