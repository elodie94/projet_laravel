@extends('modele')

@section('title','Planning par semaine')

@section('contents')

    <h4> Sélection de la date </h4>

    <form method="post" action="{{route('user.etudiant.planning.showSemaine',['id'=>Auth::user()->id])}}">

        <div class="form">
            <div class="col-md-2">
                <label for="date" class="form-label"> Sélection jour: </label>
                <input type="date" min="2021-03-06" max="2022-03-06"  class="form-control" name="date">
            </div>

            <div class="col">
                <button type="submit" class="btn btn-info mb-2">Valider</button>
            </div>
        </div>

        @csrf

    </form>
@endsection


