@extends('modele')

@section('title','Planning intégral')

@section('contents')
    <ul>
    @foreach($cours as $c)

        <li>
            {{$c->intitule}} :

            <ul>
            @foreach($c->planning()->get() as $seance)
                <li>
                    date de debut -- {{$seance->date_debut}} | date de fin -- {{$seance->date_fin}}
                </li>
            @endforeach
            </ul>
        </li>



    @endforeach
        </ul>

@endsection
