@extends('modele')

@section('title','Affichage du planning')

@section('contents')

    <div class="container">
        <div class="row justify-content-md-center">

            <div class="col col-md-1"></div>


            <div class="col-md-auto">
                <h3> Vos séances de cours {{Auth::user()->login}} </h3>
                <p><h6> - Affichage du planning :</h6></p>

                <div class="list-group">

                    <a href="{{route('user.enseignant.planning.indexIntegrale',['id'=>Auth::user()->id])}}" class="list-group-item list-group-item-action list-group-item-light">Intégrale</a>
                    <a href="{{route('user.enseignant.planning.indexPC',['id'=>Auth::user()->id])}}" class="list-group-item list-group-item-action list-group-item-info">Par cours</a>
                    <a href="{{route('user.enseignant.planning.indexSemaine')}}" class="list-group-item list-group-item-action list-group-item-info">Par semaine</a>


                </div>
            </div>

        </div>
    </div>

@endsection
