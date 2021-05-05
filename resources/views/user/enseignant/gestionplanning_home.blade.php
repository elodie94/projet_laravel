@extends('modele')

@section('title','Gestion inscription cours')

@section('contents')


    <div class="container">
        <div class="row justify-content-md-center">

            <div class="col col-md-1"></div>


            <div class="col-md-auto">
                <h3> Gestion de votre planning {{Auth::user()->login}} </h3>
                <p><h6> - Gestion du planning :</h6></p>

                <div class="list-group">

                    <a href="{{route('user.enseignant.planning.create',['id'=>Auth::user()->id])}}" class="list-group-item list-group-item-action list-group-item-light">Nouvelle séance</a>
                    <a href="" class="list-group-item list-group-item-action list-group-item-info">Mettre à jour une séance de cours</a>
                    <a href="" class="list-group-item list-group-item-action list-group-item-info">Supprimer une séance</a>
                    <a href="" class="list-group-item list-group-item-action list-group-item-danger">Se désinscrire d'un cours</a>


                </div>
            </div>

        </div>
    </div>
@endsection
