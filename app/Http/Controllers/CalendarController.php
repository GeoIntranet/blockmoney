<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Lib\Calendar\Calendar;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{

    private $calendar;
    public $selected;

    /**
     * CalendarController constructor.
     */
    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
        $this->selected = '';

    }

    public function synchronousDate()
    {
        if( ! session()->has('calendarDate') )
            session(['calendarDate' => carbon::now()->format('Y-m-d')]);
        ;
        return session('calendarDate');
    }

    public function index()
    {
        $this->selected = $this->synchronousDate();

        return view('calendar',
        [
            'now' => Carbon::now(),
            'dateSent' => new Carbon($this->selected),
            'calender_' => $this->generate() ,
            'transaction' => Transaction::where('user_id',Auth::user()->id)->get()->groupBy('date'),
        ]);

    }

    public function addMonth()
    {
        $this->selected = $this->synchronousDate();
        $this->selected =
            (new Carbon($this->selected))
                ->addMonth('1')
                ->format('Y-m-d')
        ;
        $this->update();

        if(request()->wantsJson()){
            return [
                'dates' => ($this->calendar->generate($this->selected)) ,
                'selected' => (new Carbon($this->selected))->format('Y-m-d'),
                'transaction' => Transaction::where('user_id',Auth::user()->id)->get()->groupBy('date'),
            ];
        }
    }

    public function subMonth()
    {
        $this->selected = $this->synchronousDate();
        $this->selected =
            (new Carbon($this->selected))
                ->subMonth('1')
                ->format('Y-m-d')
        ;
        $this->update();

        if(request()->wantsJson()){
            return [
                'dates' => $this->calendar->generate($this->selected) ,
                'selected' => (new Carbon($this->selected))->format('Y-m-d'),
                'transaction' => Transaction::where('user_id',Auth::user()->id)->get()->groupBy('date'),
            ];
        }
    }

    public function addYear()
    {
        $this->selected = $this->synchronousDate();
        $this->selected =
            (new Carbon($this->selected))
                ->addYear('1')
                ->format('Y-m-d')
        ;
        $this->update();

        if(request()->wantsJson()){
            return [
                'dates' => $this->calendar->generate($this->selected) ,
                'selected' => (new Carbon($this->selected))->format('Y-m-d'),
                'transaction' => Transaction::where('user_id',Auth::user()->id)->get()->groupBy('date'),
            ];
        }
    }

    public function selectDate($date)
    {
        $this->selected = $this->synchronousDate();
        $this->selected =
            (new Carbon($date) ) ->format('Y-m-d')
        ;
        $this->update();

        if(request()->wantsJson()){
            return [
                'dates' => $this->calendar->generate($this->selected) ,
                'selected' => (new Carbon($this->selected))->format('Y-m-d'),
                'transaction' => Transaction::where('user_id',Auth::user()->id)->get()->groupBy('date'),
            ];
        }

    }

    /**
     * enleve une année a la date selectionné
     */

    public function subYear()
    {
        $this->selected = $this->synchronousDate();
        $this->selected =
            (new Carbon($this->selected))
                ->subYear('1')
                ->format('Y-m-d')
        ;
        $this->update();

        if(request()->wantsJson()){
            return [
                'dates' => $this->calendar->generate($this->selected) ,
                'selected' => (new Carbon($this->selected))->format('Y-m-d'),
                'transaction' => Transaction::where('user_id',Auth::user()->id)->get()->groupBy('date'),
            ];
        }

        return redirect()->back();
    }

    /**
     * recherche de la dates selectionne
     */
    private function getSelectedDate()
    {
        $this->selected;
    }

    /**
     * Generate calendar content
     * @return mixed
     */
    public function generate()
    {
        $this->selected = $this->synchronousDate();

        if(request()->wantsJson()){
            return [
                'dates' => $this->calendar->generate($this->selected) ,
                'selected' => (new Carbon($this->selected))->format('Y-m-d'),
                'transaction' => Transaction::where('user_id',Auth::user()->id)->get()->groupBy('date'),
            ];
        }

        return $this->calendar->generate($this->selected) ;
    }

    private function ajaxCheck()
    {
        if(request()->wantsJson()){
            $this->ajaxResponse();
        }
    }
    public function resetDate()
    {
        session()->forget('calendarDate');
        $this->selected = $this->synchronousDate();

        if(request()->wantsJson()){
            return [
                'dates' => $this->calendar->generate($this->selected) ,
                'selected' => (new Carbon($this->selected))->format('Y-m-d') ,
                'transaction' => Transaction::where('user_id',Auth::user()->id)->get()->groupBy('date'),
            ];
        }

        return $this->calendar->generate($this->selected) ;
    }

    public function update()
    {
        session(['calendarDate' => $this->selected]);
    }

    private function ajaxResponse()
    {
        return [
            'calendar' => $this->calendar->generate($this->selected) ,
            'selected' => new Carbon($this->selected),
            'transaction' => Transaction::where('user_id',Auth::user()->id)->get()->groupBy('date'),
        ];
    }

    public function getSession()
    {
        return $this->synchronousDate();
    }

    public function setSession(Request $request)
    {
        session(['calendarDate' => $request->input('date')]);
    }
}
