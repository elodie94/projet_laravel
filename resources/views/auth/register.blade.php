@extends('modele')

@section('title','Enregistrement')

@section('contents')

    <div class="container">
        <div class="row justify-content-md-center">

            <div class="col col-md-2"></div>

            <div class="col-md-auto">
                <h4 class="mb-3">Création compte</h4>

                <form method="post">

                        <div class="form-group">
                            <label for="nom" class="form-label">Nom:</label>
                            <input type="text" name="nom" value="{{old('nom')}}">
                        </div>

                        <div class="form-group">
                            <label for="prenom" class="form-label">Prénom:</label>
                            <input type="text" name="prenom" value="{{old('prenom')}}">
                        </div>

                        <div class="form-group">
                            <label for="login" class="form-label">Login:</label>
                            <input type="text" name="login" value="{{old('login')}}">
                        </div>

                        <div class="form-group">
                            <label for="formation_id"> Sélectionner la Formation</label>
                            <select class="form-control" id="formation_id" name="formation_id">
                                <option value="" selected> Pas de formation </option>
                                @foreach($formations as $formation)
                                    <option value="{{$formation->id}}" >{{ $formation->intitule }}</option>
                                @endforeach
                            </select>
                        </div>

                        <p></p>

                        <div class="form-group">
                            <label for="mdp" class="form-label">MDP: </label>
                            <input type="password" name="mdp">
                        </div>

                        <div class="form-group">
                            <label for="mdp_confirmation" class="form-label">Confirmation MDP: </label>
                            <input type="password" name="mdp_confirmation">
                        </div>



                    <input type="submit" value="Envoyer">
                    @csrf
                </form>

                <a href="{{route('main')}}">Retourner à la page d'accueil</a>
            </div>
        </div>
    </div>



@endsection
