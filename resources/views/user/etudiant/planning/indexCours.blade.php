@extends('modele')

@section('title','Planning par cours')

@section('contents')

    <h4>Liste des cours où je suis inscrit :</h4>

    @forelse($cours as $c)

            @if($loop->first)
                <ul>
                    @endif
                <li>
                    Cours n°{{$loop->iteration}} : {{$c->intitule}} <a class="button is-primary" href="{{route('user.etudiant.planning.showCours',['id'=>$c->id])}}"> Voir les séances </a>
                </li>
                @if($loop->last)
                </ul>
            @endif

    @empty
        <p>Vous êtes inscrit dans aucun cours</p>
        <p> <a href="{{route('user.etudiant.cours.inscrCours',['id'=>Auth::user()->id])}}">S'inscrire dans un cours</a> </p>

    @endforelse
    {{$cours->links()}}

    <a href="{{route('user.etudiant.gestioninscr_home')}}">Retourner sur la page principale</a>
@endsection
