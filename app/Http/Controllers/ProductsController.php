<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    public function handle(Request $request)
    {
        // Change from sandbox-api.polar.sh -> api.polar.sh when ready to go live
        // And don't forget to update the .env file with the correct POLAR_API_KEY, POLAR_ORGANIZATION_ID and POLAR_WEBHOOK_SECRET
        $data = Http::withToken(env('POLAR_API_KEY'))->get('https://sandbox-api.polar.sh/v1/products', [
            'organization_id' => env('POLAR_ORGANIZATION_ID'),
            'is_archived' => false,
        ]);

        $products = $data->json();

        return view('products', ['products' => $products['items']]);
    }
}
