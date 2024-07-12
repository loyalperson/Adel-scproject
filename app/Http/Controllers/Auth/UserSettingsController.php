<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailUpdated;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Exception;

class UserSettingsController extends Controller
{
    public function index()
    {
        $email = auth()->user()->email;
        $customer = Customer::where('email', $email)->first();

        if ($customer) {
            return view('pages/apps.user-settings.index-customer', ['customer' => $customer]);
        }
        else {
            return view('pages/apps.user-settings.index-no-customer');
        }
        
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            "whatsapp" => 'nullable|string|max:10',
            "payment-method" => 'nullable|string|max:255'
        ]);

        /** @var \App\Models\User $user **/
        $user = Auth::user();

        //get old email for use for customer validation
        $email = $user->email;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        
        $user->save();

        //update customer as well, if the client is a customer
        $customer = Customer::where('email', $email)->first();
        if ($customer) {
            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            $customer->whatsapp = $request->input('whatsapp');
            $customer->{'payment-method'} = $request->input('payment-method');

            $customer->save();
        }

        Mail::to($user->email)->send(new EmailUpdated($user));

        return redirect()->route('user.settings')->with('success', 'Settings updated successfully.');
    }
}
