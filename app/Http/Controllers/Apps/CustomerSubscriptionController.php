<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerSubscriptionController extends Controller
{
    //
    public function index()
    {
        return view('pages/apps.subscription.index');
    }
}

