@extends('modele')

@section('title','Planning intégral')

@section('contents')
    <ul>
    @foreach($cours as $c)

        <li>
            {{$c->intitule}} :

            @foreach($c->planning()->get() as $seance)
               date de debut -- {{$seance->date_debut}} | date de fin -- {{$seance->date_fin}}
            @endforeach
        </li>



    @endforeach
        </ul>

@endsection
