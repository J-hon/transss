<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function transaction()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)->paginate(10);

        return view('pages.transaction')->with('transactions', $transactions);
    }
}
