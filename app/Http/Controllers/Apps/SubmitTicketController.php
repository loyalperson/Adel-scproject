<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\UsersAssignedRoleDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SubmitTicketController extends Controller
{
    public function index()
    {
        // Logic to handle ticket submission
        return view('pages/apps.tickets.submit-ticket.index');
    }
}