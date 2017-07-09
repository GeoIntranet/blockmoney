<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;

class CategoriesController extends Controller
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
     * @param  \App\Categorie  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorie  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categories)
    {
        //
    }

    public function seedIcone()
    {
        $icones = collect([]);

        $icones->push(
            [
                'name' => 'Cinéma',
                'icone' => 'fa-film',
                'value' => '#xf008',
            ] );

        $icones->push(
            [
                'name' => 'Autoroute',
                'icone' => 'fa-road',
                'value' => '#xf018',
            ]);

        $icones->push(
            [
                'name' => 'Fourniture',
                'icone' => 'fa-pencil',
                'value' => '#xf040',
            ]);

        $icones->push(
            [
                'name' => 'Cadeau',
                'icone' => 'fa-gift',
                'value' => '#xf06b',
            ]);

        $icones->push(
            [
                'name' => 'Avion',
                'icone' => 'fa-plane',
                'value' => '#xf072',
            ]);

        $icones->push(
            [
                'name' => 'Courses',
                'icone' => 'fa-shopping-cart',
                'value' => '#xf07a',
            ]);

        $icones->push(
            [
                'name' => 'Telephone',
                'icone' => 'fa-phone',
                'value' => '#xf095',
            ]);

        $icones->push(
            [
                'name' => 'Paiement Carte',
                'icone' => 'fa-credit-card',
                'value' => '#xf09d',
            ]);

        $icones->push(
            [
                'name' => 'Réparation',
                'icone' => 'fa-wrench',
                'value' => '#xf0ad',
            ]);


        $icones->push(
            [
                'name' => 'Retrait Liquide',
                'icone' => 'fa-money',
                'value' => '#xf0d6',
            ]);

        $icones->push(
            [
                'name' => 'Eléctricité',
                'icone' => 'fa-lightbulb-o',
                'value' => '#xf0eb',
            ]);

        $icones->push(
            [
                'name' => 'Medecin',
                'icone' => 'fa-user-md',
                'value' => '#xf0f0',
            ]);

        $icones->push(
            [
                'name' => 'Café',
                'icone' => 'fa-coffee',
                'value' => '#xf0f4',
            ]);

        $icones->push(
            [
                'name' => 'Restaurant',
                'icone' => 'fa-cultery',
                'value' => '#xf0f5',
            ]);

        $icones->push(
            [
                'name' => 'Bar',
                'icone' => 'fa-beer',
                'value' => '#xf0fc',
            ]);

        $icones->push(
            [
                'name' => 'Train',
                'icone' => 'fa-train',
                'value' => '#xf238',
            ]);

        $icones->push(
            [
                'name' => 'Abonement',
                'icone' => 'fa-newspaper-o',
                'value' => '#xf1ea',
            ]);


        $icones->push(
            [
                'name' => 'Voiture',
                'icone' => 'fa-car',
                'value' => '#xf1b9',
            ]);


        $icones->push(
            [
                'name' => 'Appartement',
                'icone' => 'fa-home',
                'value' => '#xf1ad',
            ]);

        $icones->push(
            [
                'name' => 'Television',
                'icone' => 'fa-television',
                'value' => '#xf26c ',
            ]);

        $icones->push(
            [
                'name' => 'Abonement',
                'icone' => 'fa-newspaper-o',
                'value' => '#xf1ea',
            ]);

        $icones->push(
            [
                'name' => 'Assurance vie',
                'icone' => 'fa-heartbeat',
                'value' => '#xf21e ',
            ]);

        $icones->push(
            [
                'name' => 'Impot',
                'icone' => 'fa-institution',
                'value' => '#xf19c',
            ]);

        $icones->push(
            [
                'name' => 'Internet',
                'icone' => 'fa-cloud-download',
                'value' => '#xf0ed',
            ]);

        $icones->push(
            [
                'name' => 'Eau',
                'icone' => 'fa-bath',
                'value' => '#xf2cd',
            ]);

        $icones->push(
            [
                'name' => 'Projet',
                'icone' => 'fa-star',
                'value' => '#xf005',
            ]);


        var_dump($icones);

    }
}
