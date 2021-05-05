@extends('modele')

@section('title','Associer un cours à un enseignant')

@section('contents')



    <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Associer un cours à un enseignant</h4>

        <form action="{{route('assoPC')}}" method="post">
            <div class="row g-3">

                <div class="col-6">
                    Login prof
                    <select class="form-control" id="login" name="login">
                        @foreach($enseignants as $enseignant)
                           <option value="{{$enseignant->id}}" >{{ $enseignant->login }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6">
                    Cours
                    <select class="form-control" id="intitule" name="intitule">
                        @foreach($c as $cours)
                            <option value="{{ $cours->id }}" >{{ $cours->intitule }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <p><br/></p>

            <input type="submit" value="Envoyer">
            @csrf
        </form>
    </div>



@endsection
