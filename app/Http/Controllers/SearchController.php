<?php

namespace App\Http\Controllers;

use App\Account;
use App\Transaction;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function handle(Request $request)
    {
        $result = [];

        if (preg_match('/'.$request->input('search').'/','compte'))
        {
            $result['module'] = 1;
            $result['titre'] = 'Compte';
            $result['data'] = Account::where('user_id',auth()->id())->get();
        }

        elseif(preg_match('/'.$request->input('search').'/','transaction'))
        {
            $result['module'] = 2;
            $result['titre'] = 'Transaction';
            $result['data'] = Transaction::where('user_id',auth()->id())->latest()->get();
        }
        else{
            $result['module'] = 999;
            $result['titre'] = 'Erreur lors de la recherche';
            $result['data'] = '';
        }

        return $result;
    }


}
