<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WithdrawalController extends Controller
{

    public function showWithdrawalForm()
    {
        return view('pages.withdrawal');
    }

    private function saveTransactionDetails($type, $user, $amount)
    {
        $transaction = new Transaction;
        $transaction->narration = $type;
        $transaction->type = $type;
        $transaction->amount = $amount;
        $transaction->user_id = $user->id;

        $transaction->save();
    }

    public function withdrawal(Request $request)
    {

        $user = Auth::user();
        $amount = $request->amount;

        // Ensure user has enough to withdraw desired amount from wallet
        if ($user->wallet->balance >= $amount)
        {
            // Ensure amount to be withdrawn is NOT less than 500
            if (!($amount < 500))
            {

                try {

                    DB::beginTransaction();

                    // reduce balance in wallet
                    TransferController::updateDB('deduct', $user, $amount);

                    // Insert transaction details in Transactions table
                    $this->saveTransactionDetails('Withdraw', $user, $amount);

                    DB::commit();

                    Session::flash('message', 'Withdrawal successful :)');
                    return redirect()->route('dashboard');
                }
                catch (\Throwable $exception) {
                    DB::rollBack();
                    throw $exception;
                }
            }

            Session::flash('message', 'Oops!!! Amount must be ₦500 and above : (');
            return redirect()->route('dashboard');
        }

        Session::flash('message', 'Oops!!! Insufficient funds to withdraw : (');
        return redirect()->route('dashboard');
    }
}
