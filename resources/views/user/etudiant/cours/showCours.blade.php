@extends('modele')

@section('title','Cours recherché')

@section('contents')
    <div>

    <h4>Cours recherché :</h4>

        <p>{{$cours->intitule}}</p>

        <p><a href="{{route('user.etudiant.cours.rechercheCours',['id'=>Auth::user()->id])}}">Rechercher un autre cours</a></p>
    </div>


    <a href="{{route('user.etudiant.gestioninscr_home')}}">Retourner sur la page principale</a>
@endsection
