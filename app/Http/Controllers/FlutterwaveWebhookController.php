<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class FlutterwaveWebhookController extends BaseController
{

    public function receive()
    {
        if ((strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') == true)
        {
            exit();
        }

        // Retrieve the request's body
        $body = @file_get_contents("php://input");

        // retrieve the signature sent in the request header's.
        $signature = (isset($_SERVER['HTTP_VERIF_HASH']) ? $_SERVER['HTTP_VERIF_HASH'] : '');
        if (!$signature)
        {
            // only a post with Flutterwave signature header gets our attention
            exit();
        }

        $local_signature = config("settings.secretHash");
        if ($signature !== $local_signature)
        {
            // silently forget this ever happened
            exit();
        }

        $response = \GuzzleHttp\json_decode($body, true);
        if ($response['event'] == 'charge.completed' && strtolower($response['data']['status']) == 'successful')
        {
            Log::info('Payment Successful');
        }
        else {
            Log::info('Payment unsuccessful');
        }

        http_response_code(200);
        exit();
    }

}
