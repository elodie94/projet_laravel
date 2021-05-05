@extends('modele')

@section('title','Liste des utilisateurs')

@section('contents')

    @forelse($users as $user)
        <ul>
            @if($loop->first)
                <li>
            @endif
                    Utilisateur n°{{$loop->iteration}} : {{$user->nom}} - {{$user->prenom}}
            @if($loop->last)
                </li>
            @endif
        </ul>
    @empty
        <p>Il n'y a pas d'utilisateur</p>

    @endforelse
    {{$users->links()}}
@endsection
