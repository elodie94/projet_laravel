@extends('modele')

@section('title',"Modification d'un cours")

@section('contents')

    <div class="row form-group">

        <p>Modification d'un cours</p>

        <form action="{{route('admin.update',['id'=>$cours->id])}}" method="post">
            @method('put')

            Intitule: <input type="text" name="intitule" value="{{old('intitule',$cours->intitule)}}" >

            <div class="col-sm-6">
                <select class="form-control" id="formation_id" name="formation_id">
                    @foreach($formations as $formation)
                        <option value="{{$formation->id}}" >{{ $formation->intitule }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6">
                <select class="form-control" id="formation_id" name="formation_id">
                    @foreach($e as $enseignant)
                        <option value="{{$enseignant->id}}" >{{ $enseignant->login }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="Modifier">
            @csrf
        </form>

    </div>

@endsection
