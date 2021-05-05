@extends('modele')

@section('title','Séances par semaine')

@section('contents')

    <h4> Séance(s) :</h4>

    @forelse($seances as $seance)

        @if($loop->first)
            <ul>
                @endif
                <li>
                    Séance n°{{$loop->iteration}}: {{$seance->cours->intitule}} Date de début {{$seance->date_debut}} -- Date de fin {{$seance->date_fin}}
                </li>
                @if($loop->last)
            </ul>
        @endif

    @empty
        <p>Il n'y a aucune séance</p>


    @endforelse
    {{$seances->links()}}

@endsection
