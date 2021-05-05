@extends('modele')

@section('title','Séances par cours')

@section('contents')

    <h4> Séance(s)</h4>

    @forelse($seances as $seance)
        @if($loop->first)
            <ul>
                @endif

                <li>
                    Séance n°{{$loop->iteration}} : Date de début -- {{$seance->date_debut}} | Date de fin -- {{$seance->date_fin}}
                </li>

                @if($loop->last)
            </ul>
        @endif
    @empty
        <p>Il n'y a aucune séance</p>


    @endforelse
    {{$seances->links()}}

@endsection
