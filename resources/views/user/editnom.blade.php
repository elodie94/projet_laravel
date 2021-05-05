@extends('modele')

@section('title','Modification Nom/prénom')

@section('contents')

    <p>Modification Nom/prénom</p>

    <form action="{{route('updatenom',['id'=>$user->id])}}" method="post">
        @method('put')

        Nom: <input type="text" name="new_nom" value="{{old('nom')}}">
        Prénom: <input type="text" name="new_prenom" value="{{old('prenom')}}">

        <input type="submit" value="Modifier">
        @csrf
    </form>

@endsection
