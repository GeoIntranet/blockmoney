<?php namespace App\Http\Controllers\Lib\Recursives;

use Carbon\Carbon;

class jobRecursivesManager extends constantRecusives
{
    public $now;
    public $firstDayOfYear;
    public $firstDayOfMonth;
    public $isFirstDayOfMonth;
    public $hour;
    public $dayOfWeek;
    public $monthOfYear;


    /**
     * 8h / Journalier
     * 9H / Semaine
     * 10H / Mois
     * 12H / Année
     * jobRecursivesManager constructor.
     */
    public function __construct()
    {
        $this->now = Carbon::now();
    }

    public function initForHandle()
    {
        $this->initDate();

        $weekState = $this->initWeek();

        $monthState = $this->initMonth();

        $yearState = $this->initYear();


        var_dump($monthState);
        var_dump($weekState);
        var_dump($yearState);
        var_dump($this);

        return $this;
    }

    public function searchTransactions()
    {
        return $this;
    }

    public function makeTransaction()
    {
        return $this;
    }

    private function initDate()
    {
        $this->hour = $this->now->hour;

        $this->firstDayOfYear = $this->now->copy()->firstOfYear();
        $this->firstDayOfMonth = $this->now->copy()->firstOfMonth();
        $this->isFirstDayOfMonth = $this->now->copy()->format('Y-m-d') == $this->firstDayOfMonth->copy()->format('Y-m-d');

        $this->dayOfWeek = $this->now->dayOfWeek;
        $this->monthOfYear = $this->now->month;
    }

    /**
     * @return array
     */
    private function initWeek()
    {
        $weekState = [
            1 => $this->now->isMonday(),
            2 => $this->now->isThursday(),
            3 => $this->now->isWednesday(),
            4 => $this->now->isTuesday(),
            5 => $this->now->isFriday(),
            6 => $this->now->isSaturday(),
            7 => $this->now->isSunday(),
        ];
        return $weekState;
    }

    /**
     * @return array
     */
    private function initMonth()
    {
        $monthState = [
            1 => $this->now->copy()->format('Y-m-d') == $this->firstDayOfMonth->copy()->format('Y-m-d'),
            2 => $this->now->copy()->format('Y-m-d') == $this->firstDayOfMonth->copy()->addDay(4)->format('Y-m-d'),
            3 => $this->now->copy()->format('Y-m-d') == $this->firstDayOfMonth->copy()->addDay(9)->format('Y-m-d'),
            4 => $this->now->copy()->format('Y-m-d') == $this->firstDayOfMonth->copy()->addDay(14)->format('Y-m-d'),
            5 => $this->now->copy()->format('Y-m-d') == $this->firstDayOfMonth->copy()->addDay(19)->format('Y-m-d'),
            6 => $this->now->copy()->format('Y-m-d') == $this->firstDayOfMonth->copy()->addDay(24)->format('Y-m-d'),
            7 => $this->now->copy()->format('Y-m-d') == $this->now->copy()->lastOfMonth()->format('Y-m-d'),
        ];
        return $monthState;
    }

    /**
     * @return array
     */
    private function initYear()
    {
        $firstYear_temp = $this->firstDayOfYear->copy();
        $yearState = [];
        for ($i = 1; $i <= 12; $i++) {
            $yearState[$i] = ($i == 1)
                ?
                $this->now->copy()->format('Y-m-d') == $firstYear_temp->format('Y-m-d')
                :
                $this->now->copy()->format('Y-m-d') == $firstYear_temp->addMonth(1)->format('Y-m-d');
        }
        return $yearState;
    }


}