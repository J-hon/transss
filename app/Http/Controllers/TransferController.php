<?php

namespace App\Http\Controllers;

use App\Transaction;
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

    private function updateDB($type, $user, $amount)
    {
        if ($type === 'deduct')
        {
            $user->wallet->balance -= $amount;
            $user->wallet->save();
        }
        elseif ($type === 'add') {
            $user->wallet->balance += $amount;
            $user->wallet->save();
        }
    }

    private function saveTransactionDetails($type, $userFrom, $userTo, $amount)
    {
        $transaction = new Transaction;
        $transaction->narration = $type.' to '. $userTo->name;
        $transaction->type = $type;
        $transaction->amount = $amount;
        $transaction->user_id = $userFrom->id;

        $transaction->save();
    }


    public function transfer(Request $request)
    {
        $userFrom = Auth::user();
        $amount = $request->amount;

        // Check if the ID of the customer to transfer to is not the same as the currently logged in user.
        if (!($userFrom->phone_number == $request->customer))
        {
            // Get the wallet of the destination customer
            $userTo = User::where('phone_number', $request->customer)->firstOrFail();

            if ($userTo)
            {
                // Ensure user has enough balance in their wallet to transfer
                if ($userFrom->wallet->balance >= $amount)
                {

                    // Ensure amount isn't greater than 100000
                    if ($amount < 100000)
                    {
                        try {
                            DB::beginTransaction();

                            // subtract input funds from sender
                            $this->updateDB('deduct', $userFrom, $amount);

                            // add funds to recipient
                            $this->updateDB('add', $userTo, $amount);

                            // Insert transaction details in Transactions table
                            $this->saveTransactionDetails('Transfer', $userFrom, $userTo, $amount);

                            DB::commit();

                            Session::flash('success', 'Transfer successful :)');
                            return redirect()->route('home');
                        }
                        catch (\Throwable $exception) {
                            DB::rollBack();
                            throw $exception;
                        }
                    }

                    Session::flash('fail', 'Oops!!! You cant transfer more than 100,000 :(');
                    return redirect()->route('home');
                }

                Session::flash('fail', 'Oops!!! Insufficient funds :(');
                return redirect()->route('home');
            }

            Session::flash('fail', "Oops!!! Customer doesn't exist! :(");
            return redirect()->route('home');
        }

        Session::flash('fail', "You can't transfer funds to self. :(");
        return redirect()->route('home');
    }
}
