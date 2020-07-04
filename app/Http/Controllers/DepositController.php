<?php

namespace App\Http\Controllers;

use App\Wallet;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function deposit($amount)
    {
        $user = Auth::user();
        $userWallet = Wallet::find($user->id);

        if ($userWallet) {
            $userWallet->balance += $amount;
            $userWallet->save();
        }
    }
}
