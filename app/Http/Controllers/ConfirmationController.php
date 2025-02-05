<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ConfirmationController extends Controller
{
    public function handle(Request $request)
    {
        // Change from sandbox-api.polar.sh -> api.polar.sh when ready to go live
        // And don't forget to update the .env file with the correct POLAR_WEBHOOK_SECRET
        $data = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('POLAR_API_KEY'),
            'Content-Type' => 'application/json',
        ])->get('https://sandbox-api.polar.sh/v1/checkouts/custom/' . $request->query('checkout_id'));

        $checkout = $data->json();

        Log::info(json_encode($checkout, JSON_PRETTY_PRINT));

        return view('confirmation', ['checkout' => $checkout]);
    }
}
