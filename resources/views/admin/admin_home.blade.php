@extends('modele')

@section('title','Page administrateur')

@section('contents')
    <p><h3>Bienvenue sur la page admin : {{Auth::user()->login}} </h3></p>

    <div class="row">
        <div class="col">
            <p><h5> - Gestion des utilisateurs :</h5></p>

            <div class="list-group">

                <a href="{{route('admin.users.indexvu')}}" class="list-group-item list-group-item-action list-group-item-primary">Demandes de comptes</a>

            </div>
        </div>

        <div class="col">
            <p><h5> - Gestion des cours :</h5></p>

            <div class="list-group">
                <a href="{{route('admin.cours.index')}}" class="list-group-item list-group-item-action list-group-item-info">Voir la liste de cours</a>
                <a href="{{route('admin.cours.rechercheCours')}}" class="list-group-item list-group-item-action list-group-item-info">Rechercher un cours</a>
                <a href="{{route('admin.cours.create')}}" class="list-group-item list-group-item-action list-group-item-info">Ajouter un nouveau cours</a>
                <a href="" class="list-group-item list-group-item-action list-group-item-info">Modifier un cours</a>
                <a href="{{route('assoPCform')}}" class="list-group-item list-group-item-action list-group-item-info">Associer un enseignant à un cours</a>
            </div>
        </div>

        <div class="col">
            <p><h5> - Gestion des formations :</h5></p>

            <div class="list-group">
                <a href="{{route('admin.formations.index')}}" class="list-group-item list-group-item-action list-group-item-secondary">Voir la liste des formations</a>
                <a href="{{route('admin.formations.create')}}" class="list-group-item list-group-item-action list-group-item-secondary">Ajouter une formation</a>
            </div>
        </div>

    </div>
@endsection
