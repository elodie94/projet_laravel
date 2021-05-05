@extends('modele')

@section('title','Liste des cours')

@section('contents')

    @forelse($formations as $formation)

            @if($loop->first)
                <ul>
                    @endif
                <li>
                    Formation n°{{$loop->iteration}} : {{$formation->intitule}}
                </li>
                @if($loop->last)
                </ul>
            @endif

    @empty
        <p>Il n'y a pas de formation</p>

    @endforelse
    {{$formations->links()}}
@endsection
