@extends('modele')

@section('title','Recherche de cours')

@section('contents')
    <div class="col-md-7 col-lg-8">

        <form action="{{route('user.etudiant.cours.resultRecherche',['id'=>Auth::user()->id])}}" method="post">

            <div class="form">
                <div class="col-4">
                    <label for="cours">Recherche d'un cours</label>
                    <input type="text" class="form-control mb-2" id="cours" name="cours" placeholder="nom du cours">
                </div>

                <div class="col">
                    <button type="submit" class="btn btn-info mb-2">Recherche</button>
                </div>

            </div>

            @csrf
        </form>

        <a href="{{route('user.etudiant.gestioninscr_home')}}">Retourner sur la page principale</a>
    </div>

@endsection
