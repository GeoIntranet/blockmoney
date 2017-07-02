<?php

namespace App\Http\Controllers;

use App\Account;
use App\Soldes;
use Illuminate\Http\Request;

class ProtoController extends Controller
{

    public function updateSolde(Account $account)
    {
        $user = auth()->id();
        $solde = Soldes::lastSolde($user,$account->id)->first();


       $testGroup = Soldes::where('user_id',$user)->orderby('created_at','DESC')->get();
       var_dump($testGroup->toArray());


        $account = Account::Create([
            'nom' => 'tttttt',
            'description' => 'tttttttttttt',
            'user_id' => '1',
            'active' => 1,
        ]);

        var_dump($account->id);

       var_dump($testGroup->groupBy('account_id')->toArray());
    }
}
