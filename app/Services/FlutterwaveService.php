<?php

namespace App\Services;

use App\Contracts\PaymentGatewayContract;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FlutterwaveService implements PaymentGatewayContract
{

    private $httpClient, $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://api.flutterwave.com/v3';
        $this->httpClient = Http::withToken(config("settings.raveSecretKey"));
    }

    public function initialize(array $params)
    {
        $payload = [
            'tx_ref' => Str::uuid(),
            'amount' => $params['amount'],
            'payment_options' => 'card',
            'redirect_url' => route('deposit'),
            'currency' => 'NGN',
            'customer' => [
                'name' => $params['user']->name,
                'email' => $params['user']->email,
                'phone_number' => $params['user']->phone_number
            ],
            'customizations' => [
                "title" => "Test run",
                "description" => "Middle out isn't free. Pay the price",
                "logo" => "https://res.cloudinary.com/oiniks/image/upload/v1603047172/oiniks/customers/profile_pictures/d2b8c8f0-1172-11eb-bd6d-655773ed91d4.jpg",
            ],
        ];

        $response = $this->httpClient->post($this->baseUrl . '/payments', $payload);
        return $transaction = json_decode($response, true);
    }

    public function getBanks()
    {
        $response = $this->httpClient->get($this->baseUrl . '/banks/NG');
        return json_decode($response, true);
    }

    public function verifyTransaction(string $transactionId)
    {
        $response = $this->httpClient->get($this->baseUrl . '/transactions/' . $transactionId . '/verify');
        return json_decode($response, true);
    }

}
