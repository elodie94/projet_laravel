@extends('modele')

@section('title','Nouvelle formation')

@section('contents')

    <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Ajout d'une nouvelle formation</h4>

        <form method="post" action="{{route('admin.formations.store')}}">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="intitule" class="form-label">Nom de la formation:</label>
                    <input type="text" name="intitule" value="{{old('intitule')}}">
                </div>

            </div>

            <p></p>

            <input type="submit" value="Envoyer">
            @csrf
        </form>
    </div>

    <a href="{{route('admin.formations.index')}}">Retourner à la liste de formation</a>

@endsection
