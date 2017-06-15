<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function model()
    {
        dump(User::with('prelevement')->get()) ;

    }
}
