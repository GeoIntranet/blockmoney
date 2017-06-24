<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Lib\User\UserAccountSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Account;

/**
 * Class AccountController
 * @package App\Http\Controllers
 */
class AccountController extends Controller
{
    /**
     * @var UserAccountSetting
     */
    private $userSetting;

    /**
     * AccountController constructor.
     */
    public function __construct(UserAccountSetting $userSetting)
    {

        $this->userSetting = $userSetting;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'nom' => 'required',
            'description' => 'required | min:3 | max:20',
        ]);

        $account = Account::Create([
            'nom' => request('nom'),
            'description' => request('description'),
            'user_id' => auth()->id(),
            'active' => 1,
        ]);

        $status = $this->userSetting->check();


        return [
            'message' => 'account created',
            'id' => $account->id,
            'userAccountActive' => $status,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return [
            'account' => Account::find($id)
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'nom' => 'required',
            'description' => 'required | min:3 | max:20',
        ]);

        $account = Account::find($id)->update([
            'nom' => $request->input('nom'),
            'description' => $request->input('description'),
        ]);
        $status = $this->userSetting->check();
        return [
            'message' => 'account edité',
            'userAccountActive' => $status,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::find($id);

        if( $account->user_id == auth()->id() )
            $account->update(['active' => 0])
            ;

        $status = $this->userSetting->check();

        return [
            'status' => 'deleted',
            'userAccountActive' => $status
        ];
    }



}
