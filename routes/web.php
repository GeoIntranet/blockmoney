<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('welcome'); });

Auth::routes();


Route::group(['middleware' =>'auth'], function () {
    // Configuration du budget pour utilisateur donné
        Route::get('user/logout', 'UserController@logout');
        Route::get('configuration/user', 'UserController@index');
        Route::get('configuration/user/{id}', 'UserController@profil');

    //gestion calendrier  - POUR PROTO -
        Route::get('configuration/calendar', 'CalendarController@index');
        Route::get('configuration/calendar/session', 'CalendarController@getSession');
        Route::post('configuration/calendar/set/session', 'CalendarController@setSession');

    //  gestion de la recherche autocomplete
        Route::post('/search', 'SearchController@handle');
    //-------------------------------------------------------------
});


// Il faut absolument que l'utilisateur ai sont profil de crée
Route::group(['middleware' =>'app'], function () {

    // Page d'aceuil du budget de l'utilisateur connecter
        Route::get('/home', 'BoardController@home');

        Route::get('/home/calendar', 'BoardController@calendar');
        Route::get('/calendar/session', 'CalendarController@getSession');
        Route::post('/calendar/set/session', 'CalendarController@setSession');

        Route::get('/home/movements', 'BoardController@movement');
        Route::get('/home/movement/session', 'TransactionsController@getTransactionsIntervalle');
        Route::get('/home/movement/session/{date}', 'TransactionsController@getTransactionsIntervalle');
    //-------------------------------------------------------------

    // section gestion d'un compte banquaire
        Route::resource('home/account', 'AccountController');
    //-------------------------------------------------------------

    // section gestion d'un compte banquaire
    Route::resource('home/recursives', 'RecursivesController');
    //-------------------------------------------------------------

    // section gestion d'un debit
        Route::resource('home/move/debit', 'DebitController');
    //-------------------------------------------------------------

    // section gestion d'un credit
        Route::resource('home/move/credit', 'CreditController');
    //-------------------------------------------------------------



});

