<?php

namespace App\Http\Controllers;

use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showTransferForm()
    {
        return view('pages.transfer');
    }

    public function transfer(Request $request)
    {
        $userFrom = Auth::user();

        // Check if the ID of the customer to transfer to is not the same as the currently logged in user.
        if (!($userFrom->wallet->customerID == $request->customer))
        {
            // Get the wallet of the destination customer
            $transfer = User::where('customerID', $request->customer)->firstOrFail();

//            exit($transfer);

            if ($transfer)
            {
                // Ensure user has enough balance in their wallet to transfer
                if ($userFrom->wallet->balance >= $request->amount)
                {
                    try {
                        DB::beginTransaction();

                        // subtract input funds from sender
                        $userFrom->wallet->balance -= $request->amount;
                        $userFrom->wallet->save();

                        // add funds to recipient
                        $transfer->wallet->balance += $request->amount;
                        $transfer->save();

                        DB::commit();

                        Session::flash('success', 'Transfer successful :)');
                        return redirect()->route('home');
                    }
                    catch (\Throwable $exception)
                    {
                        DB::rollBack();
                        throw $exception;
                    }
                }
                Session::flash('fail', 'Insufficient funds :(');
                return redirect()->route('home');
            }
            Session::flash('fail', "Unfortunately, customer doesn't exist! :(");
            return redirect()->route('home');
        }

        Session::flash('fail', "You can't transfer funds to self. :(");
        return redirect()->route('home');
    }
}
