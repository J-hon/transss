<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Wallet;

class PagesController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $user_wallet = Wallet::where('user_id', $user->id)->get();
        return view('pages.wallet')->with('user', $user)->with('user_wallet', $user_wallet);
    }
}
