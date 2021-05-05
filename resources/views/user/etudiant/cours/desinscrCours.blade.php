@extends('modele')

@section('title','Désinscription cours')

@section('contents')
    <div class="container">
        <div class="row">
            <h4 class="col-md-8 col-md-offset-3">Désincription d'un cours</h4>

            <form class="form" action="{{route('user.etudiant.cours.destroyCoursInscr',['id'=>Auth::user()->id])}}" method="post">

                @method('delete')

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <select class="form-control" id="cid" name="cid">
                            @foreach($coursInscr as $c)
                                <option value="{{ $c->id }}" >{{ $c->intitule }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-8 col-md-offset-4">
                        <input class="btn btn-primary" type="submit" value="Désincription">
                        @csrf
                    </div>
                </div>

            </form>


            <p></p>
            <a href="{{route('user.etudiant.gestioninscr_home')}}">Retourner à la page d'accueil</a>

        </div>
    </div>


@endsection
