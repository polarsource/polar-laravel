<?php

namespace App\Handler;

use Illuminate\Http\Request;
use Spatie\WebhookClient\Exceptions\WebhookFailed;
use Spatie\WebhookClient\WebhookConfig;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;

class PolarSignature implements SignatureValidator
{
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        $signingSecret = base64_encode($config->signingSecret);
        $wh = new \StandardWebhooks\Webhook($signingSecret);

        return boolval( $wh->verify($request->getContent(), array(
            "webhook-id" => $request->header("webhook-id"),
            "webhook-signature" => $request->header("webhook-signature"),
            "webhook-timestamp" => $request->header("webhook-timestamp"),
        )));
    }
}