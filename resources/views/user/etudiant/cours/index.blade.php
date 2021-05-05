@extends('modele')

@section('title','Liste des cours dans la formation')

@section('contents')

    <div class="container">
        <div class="row justify-content-md-center">
            <h4>Liste des cours dans la formation {{$f->intitule}}</h4>
            <p></p>
            @forelse($coursFormation as $cours)
                <ul class="list-group list-group-flush">
                    @if($loop->first)

                    @endif

                        <li class="list-group-item list-group-item-dark">
                            Cours n°{{$loop->iteration}} : {{$cours->intitule}}

                            @if($loop->last)
                        </li>
                            @endif
                </ul>

            @empty
                <p>Il n'y a pas de cours</p>

            @endforelse
    {{$coursFormation->links()}}

        </div>
    </div>
@endsection
