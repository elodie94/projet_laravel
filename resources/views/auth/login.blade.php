@extends('modele')

@section('title','Login')

@section('contents')

    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <h4 >Connexion</h4>
                    <form method="post">


                            <div class="form-group">
                                <label for="login" class="form-label">Login:</label>
                                <input type="text" name="login" value="{{old('login')}}">
                            </div>
                            <div class="form-group">
                                <label for="mdp" class="form-label">MDP: </label>
                                <input type="password" name="mdp">
                            </div>


                        <input type="submit" value="Envoyer">
                        @csrf
                    </form>
            </div>
        </div>

    </div>

@endsection
