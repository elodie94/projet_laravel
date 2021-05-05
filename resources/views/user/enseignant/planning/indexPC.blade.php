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
        <p>aucun cours</p>


    @endforelse
    {{$cours->links()}}

@endsection
