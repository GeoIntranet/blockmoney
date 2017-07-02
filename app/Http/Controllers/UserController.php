<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Lib\User\UserAccountSetting;
use App\Soldes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @var UserAccountSetting
     */
    private $setting;

    /**
     * UserController constructor.
     */
    public function __construct(UserAccountSetting $setting)
    {

        $this->setting = $setting;
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
            ->with([ 'account'])
            ->first()
        ;

        $solde = Soldes::where('user_id',$id)->orderby('created_at','DESC')->get();
        $solde = $solde->groupBy('account_id');


        $status = $this->setting->check();

        return view('user.settings',compact(['user','status','solde']));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
