@extends('modele')

@section('contents')

    <p> Bonjour {{Auth::user()->type}} : {{Auth::user()->login}} </p>

    @if(Auth::user()->type == 'null' || Auth::user()->type== null)
        <p>Attente de la confirmation de l'administrateur pour avoir accès au site</p>
    @endif
@endsection
