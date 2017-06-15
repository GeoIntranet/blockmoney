<?php

namespace App\Http\Controllers;

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transactions)
    {
        //
    }

    public function getTransactionsIntervalle($date = null)
    {
        $dateSession = $date = null ? new Carbon(session('calendarDate')) : new Carbon($date) ;

        $transactions =
            Transaction::where('user_id',auth()->id())
                ->whereBetween('date',[$dateSession->firstOfMonth()->toDateTimeString(),$dateSession->lastOfMonth()->toDateTimeString()])
                ->get()
                ->groupBy('date')
        ;

        return [
            'transaction' => $transactions ,
            'session' => $dateSession ,
        ];
    }
}
