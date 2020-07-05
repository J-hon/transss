<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Wallet;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $user_wallet = Wallet::where('user_id', $user->id)->get();
        return view('pages.welcome')->with('user', $user)->with('user_wallet', $user_wallet);
    }
}
