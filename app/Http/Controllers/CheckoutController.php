<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function handle(Request $request)
    {
        $productPriceId = $request->query('priceId', '');
        // Polar will replace {CHECKOUT_ID} with the actual checkout ID upon a confirmed checkout
        $confirmationUrl = $request->getSchemeAndHttpHost() . '/confirmation?checkout_id={CHECKOUT_ID}';

        // Change from sandbox-api.polar.sh -> api.polar.sh when ready to go live
        // And don't forget to update the .env file with the correct POLAR_ORGANIZATION_ID and POLAR_WEBHOOK_SECRET
        $result = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('POLAR_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://sandbox-api.polar.sh/v1/checkouts/custom/', [
            'organization_id' => env('POLAR_ORGANIZATION_ID'),
            'product_price_id' => $productPriceId,
            'success_url' => $confirmationUrl,
            'payment_processor' => 'stripe',
        ]);

        $data = $result->json();

        $checkoutUrl = $data['url'];

        return redirect($checkoutUrl);
    }
}