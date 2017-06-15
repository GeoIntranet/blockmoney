<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {

    }

    public function index()
    {
        return redirect()->action('UserController@profil',Auth::user()->id);
    }

    public function profil($id)
    {
        // check account
        $user = auth()
            ->user()
            ->with([
                'account',
                'prelevement',
            ])
            ->first()
        ;

        // check recursive prelevement

        // check categorie user

        //dump($user);
        return view('user.settings');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
