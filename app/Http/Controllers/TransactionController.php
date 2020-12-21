<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function transaction()
    {
        $user = Auth::user();
        $data['transactions'] = $user->transactions;

        return view('pages.transaction')->with($data);
    }
}
