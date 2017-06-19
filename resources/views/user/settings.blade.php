@extends('layouts.main')

@section('title')
User Setting
@endsection

@section('navbar')
    <div>
        <navigation></navigation>
    </div>

@endsection

@section('content')
    <br>
    <div class="row ">
        <div class="col">
            <div class="row pad-10 ">
                <div class="col-md-12 col-lg-4  col-sm-12">
                    @component('component.card.card')
                        @slot('header') <i class="fa fa-info"> </i>nformation @endslot
                        @slot('title') Configuration compte utilisateur @endslot
                        @slot('body')
                            <p><i class="fa fa-cog mr-2"></i> Pour que votre compte soit <b>actif</b> , il necessite un minimum de <u>configuration</u> au préalable</p>

                            <ul class="square">
                                <li>Il faut au minimum un <u>compte</u> banquaire de crée </li>
                                <li>Le solde du compte doit etre renseigner</li>
                            </ul>

                            <p><i class="fa fa-telegram mr-2"> </i> Une fois fait , vous pourrez commencer a <b>crée</b> des transactions sur se compte : </p>
                            <ul class="square">
                                <li>Débit d'un montant</li>
                                <li>Crédit d'un montant</li>
                                <li>Transfert d'un compte a un autre</li>
                            </ul>

                        @endslot
                        @slot('footer') <a href=""><b><i class="fa fa-angle-left"> </i> retour </b></a>@endslot
                    @endcomponent
                        <div class="hidden-lg-up"><hr></div>

                </div>

                <div class="col-md-12 col-lg-8 col-sm-12">
                    {{print_r($status)}}
                    {{var_dump($status)}}
                    <active_account :state="{{ +$status }}"></active_account>
                    {{--<not_active_account :status="{{$status}} "></not_active_account>--}}

                    <div class="row">
                        <div class="col">
                            @component('component.card.card')
                                @slot('header')
                                    <i class="fa fa-send mr-2"> </i> Bienvenue <b>{{auth()->user()->name}}</b> !  @endslot
                                @slot('title')
                                   <i class="fa fa-cog mr-2"> </i>Section configuration des comptes
                                @endslot
                                @slot('body')
                                        <accounts :accounts="{{$user->account}}"></accounts>
                                @endslot
                                @slot('footer') Ecrit par <u>Geoffrey Valero</u> dans la section <a href="">configuration</a>@endslot
                            @endcomponent
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>

@endsection

@section('footer')
    <h1>Footer</h1>
@endsection