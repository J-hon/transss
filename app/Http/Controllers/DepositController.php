<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{

    private static function saveTransactionDetails($type, $user, $amount)
    {
        $transaction = new Transaction;
        $transaction->narration = $type;
        $transaction->type = $type;
        $transaction->amount = $amount;
        $transaction->user_id = $user->id;

        $transaction->save();
    }

    public static function deposit($amount)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $userWallet = Wallet::find($user->id);

            if ($userWallet) {
                $userWallet->balance += $amount;
                $userWallet->save();
            }

            // Insert transaction details in Transactions table
            self::saveTransactionDetails('Deposit', $user, $amount);

            DB::commit();

        }
        catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
