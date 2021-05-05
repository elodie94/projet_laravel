@extends('modele')

@section('contents')


    <main role="main">
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-3"> Bienvenue sur School 2.0!</h1>
                <p>
                    Le site School 2.0 permet aux élèves et enseignants d'avoir accès à leurs plannings ainsi que de les gérer.
                    L'élève va pouvoir choisir ses cours par rapport à la formation choisi.
                    L'enseignant pourra gérer les plages horaires des cours qu'il enseigne.
                </p>
                <p><a class="btn btn-primary btn-lg" href="{{route('login')}}" role="button">Connexion &raquo;</a></p>
            </div>
        </div>

    </main>
@endsection
