@extends('modele')

@section('title','Demande de compte')

@section('contents')

    @forelse($users as $user)

            @if($loop->first)
                <ul>
                    @endif
                <li>
                    Utilisateur n°{{$loop->iteration}} - nom: {{$user->nom}} - prénom: {{$user->prenom}} - login: {{$user->login}} Choix: <a href="{{route('editType',['id'=>$user->id])}}">Accepter</a> <a href="{{route('admin.delete',['id'=>$user->id])}}">Refuser</a>
                </li>
                @if($loop->last)
                </ul>
            @endif

    @empty
        <p>Il n'y a pas de demande de creation de compte</p>

    @endforelse
    {{$users->links()}}
@endsection
