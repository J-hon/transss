<?php

namespace App\Http\Controllers;

use App\Contracts\PaymentGatewayContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RaveController extends Controller
{

    public $flutterwaveService;

    public function __construct(PaymentGatewayContract $flutterwaveService)
    {
        $this->flutterwaveService = $flutterwaveService;
    }

    public function index()
    {
        $user = Auth::user();
        return view('pages.deposit')->with('user', $user);
    }

    public function initialize(Request $request)
    {
        $params = $request->all();
        $params['user'] = Auth::user();
        $initialize = $this->flutterwaveService->initialize($params);

        return redirect($initialize['data']['link']);
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

        if ($data->status = "successful")
        {
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
