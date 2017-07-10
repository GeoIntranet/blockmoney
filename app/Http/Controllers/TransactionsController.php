<?php

namespace App\Http\Controllers;

use App\Recursive;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * @var \App\Recursive
     */
    private $recursive;

    /**
     * TransactionsController constructor.
     */
    public function __construct(Recursive $recursive)
    {

        $this->recursive = $recursive;
    }

    public function getDate()
    {
        $date = Carbon::now();
        $firstOfYear = $date->copy()->firstOfYear();
        $firstOfMonth = $date->copy()->firstOfMonth();
        $isFirst = $date->copy()->format('Y-m-d') == $firstOfMonth->copy()->format('Y-m-d') ;

        $dayOfWeek = $date->dayOfWeek;
        $monthOfYear = $date->month;

        $weekState = [
            1 => $date->isMonday(),
            2 => $date->isThursday(),
            3 => $date->isWednesday(),
            4 => $date->isTuesday(),
            5 => $date->isFriday(),
            6 => $date->isSaturday(),
            7 => $date->isSunday(),
        ];

        $monthState = [
            1 => $date->copy()->format('Y-m-d') == $firstOfMonth->copy()->format('Y-m-d'),
            2 => $date->copy()->format('Y-m-d') == $firstOfMonth->copy()->addDay(4)->format('Y-m-d'),
            3 => $date->copy()->format('Y-m-d') == $firstOfMonth->copy()->addDay(9)->format('Y-m-d'),
            4 => $date->copy()->format('Y-m-d') == $firstOfMonth->copy()->addDay(14)->format('Y-m-d'),
            5 => $date->copy()->format('Y-m-d') == $firstOfMonth->copy()->addDay(19)->format('Y-m-d'),
            6 => $date->copy()->format('Y-m-d') == $firstOfMonth->copy()->addDay(24)->format('Y-m-d'),
            7 => $date->copy()->format('Y-m-d') == $date->copy()->lastOfMonth()->format('Y-m-d'),
        ];


        $firstYear_temp = $firstOfYear->copy();
        $yearState=[];
        for($i=1 ; $i <=12 ; $i++ )
        {
            $yearState[$i] = ( $i == 1 )
                ?
                $date->copy()->format('Y-m-d') == $firstYear_temp->format('Y-m-d')
                :
                $date->copy()->format('Y-m-d') == $firstYear_temp->addMonth(1)->format('Y-m-d');
        }

        //var_dump($firstOfYear);
        //var_dump($date);
        //var_dump($firstOfMonth);
        //var_dump($isFirst);
        //var_dump($dayOfWeek);
        //var_dump($monthOfYear);

        var_dump($monthState);
        var_dump($weekState);
        var_dump($yearState);

        return view('home');

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
