@extends('modele')

@section('title','Liste des cours inscrits')

@section('contents')

    <h4>Liste des cours où je suis inscrit :</h4>

    @forelse($coursInscr as $cours)

            @if($loop->first)
                <ul>

                    @endif
                    <li>
                    Cours n°{{$loop->iteration}} : {{$cours->intitule}}
                    </li>
                    @if($loop->last)
                </ul>
            @endif

    @empty
        <p>Vous êtes inscrit dans aucun cours</p>
        <p> <a href="{{route('user.etudiant.cours.inscrCours',['id'=>Auth::user()->id])}}">S'inscrire dans un cours</a> </p>

    @endforelse
    {{$coursInscr->links()}}

    <a href="{{route('user.etudiant.gestioninscr_home')}}">Retourner sur la page principale</a>
@endsection
