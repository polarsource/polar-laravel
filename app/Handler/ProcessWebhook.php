<?php

namespace App\Handler;

use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class ProcessWebhook extends ProcessWebhookJob
{
    public function handle()
    {
        $decoded = json_decode($this->webhookCall, true);
        $data = $decoded['payload'];

        switch ($data['type']) {
            case "checkout.created":
                // Handle the checkout created event
                break;
            case "checkout.updated":
                // Handle the checkout updated event
                break;
            case "subscription.created":
                // Handle the subscription created event
                break;
            case "subscription.updated":
                // Handle the subscription updated event
                break;
            case "subscription.active":
                // Handle the subscription active event
                break;
            case "subscription.revoked":
                // Handle the subscription revoked event
                break;
            case "subscription.canceled":
                // Handle the subscription canceled event
                break;
            default:
                // Handle unknown event
                Log::info($data['type']);
                break;
        }

        //Acknowledge you received the response
        http_response_code(200);
    }
}