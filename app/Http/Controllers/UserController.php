<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Lib\User\UserAccountSetting;
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
            ->with([
                'account',
            ])
            ->first()
        ;
        $status = $this->setting->check();

        return view('user.settings',compact(['user','status']));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
