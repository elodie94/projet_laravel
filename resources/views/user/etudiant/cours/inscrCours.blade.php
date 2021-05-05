@extends('modele')

@section('title','Inscription cours')

@section('contents')

    <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Inscription cours</h4>

        <form method="post" action="{{route('user.etudiant.cours.storeInscrCours',['id'=> Auth::user()->id])}}">
            <div class="row g-3">

                <div class="col-6">
                    Choix du cours
                    <select class="form-control" id="cours_id" name="cours_id">
                        <option value="">Choisir le cours ↓</option>
                        @foreach($cours as $c)
                            <option value="{{$c->id}}">{{ $c->intitule}}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <p></p>
            <input type="submit" value="Envoyer">
            @csrf
        </form>
    </div>

    <a href="{{route('user.etudiant.gestioninscr_home')}}">Retourner sur la page de gestion de cours</a>

@endsection
