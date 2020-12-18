<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function transaction()
    {
        $user = Auth::user();
        $data['transactions'] = Transaction::where('user_id', $user->id)->latest()->paginate(10);

        return view('pages.transaction')->with($data);
    }
}
