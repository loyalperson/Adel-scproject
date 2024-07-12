<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\PermissionsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Favorite;
use Exception;

class FavouritesController extends Controller
{
    //
    public function index(PermissionsDataTable $dataTable)
    {
        $email = auth()->user()->email;
        $customer = Customer::where('email', $email)->first();
        if ($customer){
            $favourites = $customer->favourites;
            return $dataTable->render('pages/apps.scraper.favourites.index', compact('favourites'));
        }
        else return redirect()->route('dashboard')->with('error', 'You are not a customer');
    }

    public function store(Request $request)
    {
        $favourited = $request->input('row_html');

        $email = auth()->user()->email;
        $customer = Customer::where('email', $email)->first();

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    
        if ($customer->favourites()->create([
            'customer_id' => $customer->id,
            'html_content' => $favourited,
        ])) {
            return response()->json(['message' => 'Favorite saved successfully'], 201);
        }
        
        return response()->json(['error' => 'Failed to save favorite'], 500);
        
    }

    public function remove(Request $request) {
        $favouriteId = $request->input('favourite_id');

        $email = auth()->user()->email;
        $customer = Customer::where('email', $email)->first();

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        $favourite = Favorite::where('id', $favouriteId)->where('customer_id', $customer->id)->first();

        if (!$favourite) {
            return response()->json(['error' => 'Favourite not found'], 404);
        }
        
        $favourite->delete();
        return response()->json(['success' => 'Favourite removed successfully']);
    }
}