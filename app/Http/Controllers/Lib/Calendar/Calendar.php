<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 04/10/2016
 * Time: 12:20
 */

namespace App\Http\Controllers\Lib\Calendar;


use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class Calendar extends CalendarTool
{


    protected $now;
    protected $firstOfMonthSelected;
    protected $lastOfMonthSelected;
    protected $numberOfWeeks;
    protected $numberOfDays;
    protected $tableOfCalender;
    protected $structure;

    /**
     * CalenderGestion constructor.
     */
    public function __construct(Carbon $carbon )
    {
        $this->now = $carbon::now();
    }

    public function resetDate()
    {
        session()->forget('calendarDate');
    }

    public function generate($date = null)
    {
        $dt = $this->fillDate($date);

        $this->firstOfMonthSelected = $dt->copy()->firstOfMonth();
        $this->lastOfMonthSelected = $dt->copy()->EndOfMonth();
        $this->numberOfDays = $this->lastOfMonthSelected->copy()->day;

         $this->generateTable();

        $this->fillTable();

        return $this->reindex();;
    }

    public function generateTable()
    {
        $start = $this->firstOfMonthSelected;
        $end = $this->lastOfMonthSelected;

        $row = 1;
        $col = 1;

        for($i = $start ; $i < $end ; $i->addday(1))
        {
            $dayOfWeek = $i->dayOfWeek;

            $this->tableOfCalender[$row][$dayOfWeek] =$i->format('Y-m-d');

            if($dayOfWeek == 0)
            {
                $col = 1;
                $row++; }
            else
            {
                $col++;
            }
        }
    }

    public function getTableCalender()
    {
        return $this->tableOfCalender;
    }

    public function fillTable()
    {
        foreach ($this->getTableCalender() as $weekIndex => $weekValue)
        {
            $this->fillWeek($weekIndex , collect($weekValue));
        }
    }

    public function fillWeek($weekIndex , $weekValue)
    {
        $keys = array(1,2,3,4,5,6,0);

        $this->tableOfCalender[$weekIndex] = array_fill_keys($keys, '-');
        
        foreach ($keys as $key)
        {
            $this->Assign($weekIndex, $weekValue, $key);
        }
    }

    /**
     * @param $weekIndex
     * @param $weekValue
     * @param $key
     */
    public function Assign($weekIndex, $weekValue, $key)
    {
        if (isset($weekValue[$key]))
        {
            $this->tableOfCalender[$weekIndex][$key] = $weekValue[$key];
        }
    }

    private function fillDate($date)
    {
        if($date == null ) return $this->now ;
        if(is_object($date)) return $date;
        return new Carbon($date) ;
    }
    /**
     * @param string $dateSelected
     */
    public function setDateSelected()
    {
        $this->dateSelected = $this->getSelectedDate();
    }

    private function reindex()
    {
        $calendar = [];
        foreach ($this->getTableCalender() as $weekindex => $week) {
            foreach ($week as $day => $date) {
                $calendar[$weekindex][]=$date;
            }
        }
        return $calendar;
    }


}