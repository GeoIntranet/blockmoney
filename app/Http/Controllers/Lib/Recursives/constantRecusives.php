<?php namespace App\Http\Controllers\Lib\Recursives;

class constantRecusives
{
    public $constantPeriode =
        [
            'Jour' => 1,
            'Semaine' => 2,
            'Mois' => 3,
            'Année' => 4,
        ];

    public $map =
        [
            1 => 'constantDay',
            2 => 'constantWeek',
            3 => 'constantMonth',
            4 => 'constantYear',
        ];

    public $constantDay =
        [
            '8h' => 1,
            '10h' => 2,
            '12h' => 3,
            '14h' => 4,
            '16h' => 5,
            '18h' => 6,
            '20h' => 7,
        ];

    public $constantWeek =
        [
            'Lundi' => 1,
            'Mardi' => 2,
            'Mercredi' => 3,
            'Jeudi' => 4,
            'Vendredi' => 5,
            'Samedi' => 6,
            'Dimanche' => 7,
        ];

    public $constantMonth =
        [
            '1er jour' => 1,
            '5ème jour' => 2,
            '10ème jour' => 3,
            '15ème jour' => 4,
            '20ème jour' => 5,
            '25ème jour' => 6,
            'Dernier jour' => 7,

        ];

    public $constantYear =
        [
            'Janvier' => 1,
            'Fevrier' => 2,
            'Mars' => 3,
            'Avril' => 4,
            'Mai' => 5,
            'Juin' => 6,
            'Juillet' => 7,
            'Aout' => 8,
            'Septembre' => 9,
            'Octobre' => 10,
            'Novembre' => 11,
            'Decembre' => 12,
        ];


}