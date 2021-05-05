@extends('modele')

@section('title','Nouvelle séance')

@section('contents')

    <div class="col-md-offset-3 col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">Nouvelle séance</div>
            <div class="panel-body">

                <form method="post" action="{{route('user.enseignant.planning.store',['id'=>Auth::user()->id])}}">

                    <div>
                    Intitulé du cours:
                    <select class="form-control" id="cid" name="cid">
                        @foreach($cours as $c)
                            <option value="{{ $c->id }}" >{{ $c->intitule }}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="col-md-4">
                        <label for="date" class="form-label">jour de cours: </label>
                        <input type="date" min="2021-03-06" max="2022-03-06"  class="form-control" name="date">
                    </div>

                    <div class="col-md-4">
                        <label for="heureDebut" class="form-label">début de cours: </label>
                        <input type="time" min="07:00" max="20:00" step="1800" class="form-control" name="heureDebut">
                        <small>horaire entre 07:00 et 20:00</small>
                    </div>

                    <div class="col-md-4">
                        <label for="heureFin" class="form-label">fin de cours: </label>
                        <input type="time" min="07:00" max="20:00" step="1800" class="form-control" name="heureFin">
                        <small>horaire entre 07:00 et 20:00</small>
                    </div>

                <p></p>
                <input type="submit" value="Envoyer">
                @csrf
            </form>
            </div>
        </div>


    <a href="{{route('admin.cours.index')}}">Retourner à la liste de cours</a>

    </div>
@endsection
