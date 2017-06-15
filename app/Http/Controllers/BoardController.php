<?php

namespace App\Http\Controllers;

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BoardController extends Controller
{

    /**
     * BoardController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        return view('layouts.app');
    }

    /**
     *
     */
    public function calendar()
    {
        return view('calendar');
    }

    /**
     *
     */
    public function movement()
    {
        
    }
}
