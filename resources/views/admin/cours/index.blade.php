@extends('modele')

@section('title','Liste des cours')

@section('contents')

    @forelse($c as $cours)

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
        <p>Il n'y a pas de cours</p>

    @endforelse
    {{$c->links()}}

    <a href="{{route('admin.home')}}">Retourner sur la page principale</a>
@endsection
