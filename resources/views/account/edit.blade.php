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
    <div class="row mb-4">
        <div class="col">
            <div class="row pad-10 ">
                <div class="col-md-12 col-lg-4  col-sm-12">
                    @component('component.card.card')
                        @slot('header') Liste des comptes @endslot
                    @endcomponent
                    <div class="hidden-lg-up"><hr></div>
                </div>

                <div class="col-md-12 col-lg-8 col-sm-12">
                    <div class="row">
                        <div class="col">
                            @component('component.card.card')

                                @slot('header') COMPTE - {{$account->description}}  @endslot

                                @slot('title') <i class="fa fa-cog mr-2"></i> Configuration de ce compte @endslot

                                    @slot('body')
                                        <general_account  :account="{{$account}}" :solde="{{$solde}}" ></general_account>
                                        <list_virement :virement="{{$recursives->where('action',1)}}"></list_virement>
                                        <list_prelevement :prelevement="{{$recursives->where('action',0)}}"></list_prelevement>
                                    @endslot

                                @slot('footer') <a href="{{ URL::previous() }}"><b><i class="fa fa-angle-left"> </i> retour </b></a> @endslot

                            @endcomponent
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('footer')
    <h1>Footer</h1>
@endsection