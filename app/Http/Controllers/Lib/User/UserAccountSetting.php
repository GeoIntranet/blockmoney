<?php
namespace App\Http\Controllers\Lib\User;

use App\Account;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserAccountSetting
{

    /**
     * @var Account
     */
    private $account;

    /**
     * UserAccountSetting constructor.
     * @param Account $account
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function check()
    {
        return $this->account->where('user_id',auth::id())->active()->count() > 0 ? true : false;
    }
}