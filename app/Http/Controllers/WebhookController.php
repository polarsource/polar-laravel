<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessWebhookJob;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // verify the payload authenticity

        // Send payload to job for processing
        ProcessWebhookJob::dispatch($request->all());

        return response()->json(['success' => true]);
    }
}