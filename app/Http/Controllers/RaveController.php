<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Rave;

class RaveController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('pages.deposit')->with('user', $user);
    }

    /**
     * Initialize Rave payment process
     * @return void
     */

    public function initialize()
    {
        //This initializes payment and redirects to the payment gateway
        Rave::initialize(route('callback'));
    }

    /**
     * Obtain Rave callback information
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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
