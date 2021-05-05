@extends('modele')

@section('title','Nouveau cours')

@section('contents')

    <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Ajout d'un nouveau cours</h4>

        <form method="post" action="{{route('admin.cours.store')}}">
            <div class="row g-3">

                <div class="col-12">
                    <label for="intitule" class="form-label">Intitulé du cours:</label>
                    <input type="text" name="intitule" value="{{old('intitule')}}">
                </div>

                <div class="col-6">
                    Enseignant
                    <select class="form-control" id="id" name="id">
                        @foreach($enseignants as $enseignant)
                            <option value="{{ $enseignant->id }}" >{{ $enseignant->login }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6">
                    Formation du cours
                    <select class="form-control" id="formation_id" name="formation_id">
                        @foreach($formations as $formation)
                            <option value="{{ $formation->id }}" >{{ $formation->intitule }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <p></p>
            <input type="submit" value="Envoyer">
            @csrf
        </form>
    </div>

    <a href="{{route('admin.cours.index')}}">Retourner à la liste de cours</a>

@endsection
