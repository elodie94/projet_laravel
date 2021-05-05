@extends('modele')

@section('title','Confirmation de compte')

@section('contents')

    <ul>
        <li>nom: {{$user->nom}}</li>
        <li>prénom: {{$user->prenom}}</li>
        <li>login: {{$user->login}}</li>
        <li>formation : {{$formation}} </li>
    </ul>
    <p></p>


    <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Validation de l'utilisateur</h4>

        <form action="{{route('updateType',['id'=>$user->id])}}" method="post">
            @method('put')

            <input type="submit" class="btn btn-primary" value="Valider">
            <a href="{{route('admin.users.indexvu')}}" class="btn btn-danger active" role="button" aria-pressed="true">Annuler</a>
            @csrf
        </form>
    </div>

    <a href="{{route('admin.home')}}">Retourner à la page d'accueil</a>

@endsection
