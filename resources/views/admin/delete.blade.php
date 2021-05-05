@extends('modele')

@section('title','Refuser la création de compte')

@section('contents')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-3">

                <ul>
                    <li>nom: {{$user->nom}}</li>
                    <li>prénom: {{$user->prenom}}</li>
                    <li>login: {{$user->login}}</li>
                    <li>formation : {{$formation}} </li>
                </ul>
                <p></p>



                <div class="panel panel-default">
                    <div class="panel-heading">Supprimer l'utilisateur</div>

                    <div class="panel-body">

                        <form class="form-horizontal" action="{{route('admin.destroy',['id'=>$user->id])}}" method="post">
                            @method('delete')
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <input class="btn btn-primary" type="submit" value="Supprimer">
                                    @csrf
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <p></p>
                <a href="{{route('admin.home')}}">Retourner à la page d'accueil</a>
            </div>
        </div>
    </div>


@endsection
