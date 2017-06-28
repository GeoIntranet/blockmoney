<?php

namespace App\Http\Controllers;

use App\Account;
use App\Recursive;
use Illuminate\Http\Request;

class RecursivesController extends Controller
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
        var_dump(Account::find($request->all()['account'])->user_id);
        var_dump(auth()->id());
        var_dump($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recursive  $recursives
     * @return \Illuminate\Http\Response
     */
    public function show(Recursive $recursives)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recursive  $recursives
     * @return \Illuminate\Http\Response
     */
    public function edit(Recursive $recursives)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recursive  $recursives
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recursive $recursives)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recursive  $recursives
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recursive $recursives)
    {
        //
    }
}
