@extends('modele')

@section('title','Gestion inscription cours')

@section('contents')


    <div class="container">
        <div class="row justify-content-md-center">

            <div class="col col-md-1"></div>


            <div class="col-md-auto">
                <h3> Gestion cours de vos cours {{Auth::user()->login}} </h3>
                <p><h6> - Gestion des cours:</h6></p>

                <div class="list-group">

                    <a href="{{route('user.etudiant.cours.indexCoursInscr',['id'=>Auth::user()->id])}}" class="list-group-item list-group-item-action list-group-item-light">Liste de mes cours</a>
                    <a href="{{route('user.etudiant.cours.rechercheCours')}}" class="list-group-item list-group-item-action list-group-item-info">Rechercher un cours</a>
                    <a href="{{route('user.etudiant.cours.inscrCours',['id'=>Auth::user()->id])}}" class="list-group-item list-group-item-action list-group-item-info">S'inscrire dans un cours</a>
                    <a href="{{route('user.etudiant.cours.desinscrCours',['id'=>Auth::user()->id])}}" class="list-group-item list-group-item-action list-group-item-danger">Se désinscrire d'un cours</a>


                </div>
            </div>

        </div>
    </div>
@endsection
