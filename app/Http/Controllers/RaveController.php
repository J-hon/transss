<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class RaveController extends Controller
{

    private $httpClient, $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://api.flutterwave.com/v3';
        $this->httpClient = Http::withToken('FLWSECK_TEST-00561c960fb9aff50b5a21b0cc7405c1-X');
    }

    public function index()
    {
        $user = Auth::user();
        return view('pages.deposit')->with('user', $user);
    }

    public function initialize(Request $request)
    {
        $user = Auth::user();
        $payload = [
            'tx_ref' => Str::uuid(),
            'amount' => $request->amount,
            'payment_options' => 'card',
            'redirect_url' => route('deposit'),
            'currency' => 'NGN',
            'customer' => [
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $user->phone_number
            ],
            'customizations' => [
                "title" => "Test run",
                "description" => "Middle out isn't free. Pay the price",
                "logo" => "https://res.cloudinary.com/oiniks/image/upload/v1603047172/oiniks/customers/profile_pictures/d2b8c8f0-1172-11eb-bd6d-655773ed91d4.jpg",
            ],
        ];

        $response = $this->httpClient->post($this->baseUrl . '/payments', $payload);
        $transaction = json_decode($response, true);
        $redirectUrl = $transaction['data']['link'];

        return redirect($redirectUrl);
    }

    public function verifyTransaction(string $transactionId)
    {
        $response = $this->httpClient->get($this->baseUrl . '/transactions/' . $transactionId . '/verify');
        return json_decode($response, true);
    }

    /**
     * Obtain Rave callback information
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function callback(Request $request)
    {
        $body = $request->all();
        $data = json_decode($body['resp'])->data->transactionobject;

        if ($data->status = "successful") {
            // transaction was successful...
            DepositController::deposit($data->amount);

            Session::flash('message', 'Deposit successful.');
            return redirect('/dashboard');
        }
        else {
            Session::flash('message', 'Deposit unsuccessful.');
            return redirect('/dashboard');
        }
    }
}
