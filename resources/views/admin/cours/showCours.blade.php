@extends('modele')

@section('title','Cours recherché')

@section('contents')
    <div>

        <h4>Cours recherché :</h4>

        @foreach($cours as $c)
            <p>{{$c->intitule}} {{$c->formation()->select('intitule')->first()}}</p>
        @endforeach

        <p><a href="{{route('admin.cours.rechercheCours')}}">Rechercher un autre cours</a></p>
    </div>


    <a href="{{route('admin.home')}}">Retourner sur la page principale</a>
@endsection
