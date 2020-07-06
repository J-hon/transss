<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WithdrawalController extends Controller
{
    public function showWithdrawalForm()
    {
        return view('pages.withdrawal');
    }

    public function withdrawal(Request $request)
    {
//        $country = 'NG';
//        $public_key = 'FLWPUBK_TEST-dde17d76e98d0b408155a5035cb9b587-X';
//
//        return Http::get('https://api.ravepay.co/v2/banks/'.$country)->json();


    }
}
