@extends('modele')

@section('title','Modification mot de passe')

@section('contents')


    <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Modification mot de passe</h4>

            <form action="{{route('updateMdp',['id'=>$user->id])}}" method="post">
                @method('put')

                <div class="row g-3">
                    <div class="col-12">
                        Ancien mot de passe : <input type="password" name="old_mdp" value="{{old('old_password')}}">
                    </div>
                    <div class="col-12">
                        nouveau mot de passe : <input type="password" name="new_mdp" value="{{old('new_mdp')}}">
                    </div>

                    <div class="col-12">
                        Confirmation MDP: <input type="password" name="confirm_newmdp">
                    </div>
                </div>

                <input type="submit" value="Modifier">
                @csrf
            </form>
    </div>

    <a href="{{route('main')}}">Retourner à la page d'accueil</a>

@endsection
