@extends('modele')

@section('title','Liste des cours')

@section('contents')

    <div class="container">
        <div class="row justify-content-md-center">
            <h4>Liste des cours dont vous êtes responsable</h4>
            <p></p>
            @forelse($cours as $c)

                @if($loop->first)
                    <ul class="list-group list-group-flush">
                        @endif

                        <li class="list-group-item list-group-item-dark">
                            Cours n°{{$loop->iteration}} : {{$c->intitule}}, formation:
                            @foreach($c->formation()->get() as $f)
                                {{$f->intitule}}
                            @endforeach
                        </li>

                        @if($loop->last)
                    </ul>
                @endif


            @empty
                <p>Il n'y a pas de cours</p>
            @endforelse

            {{$cours->links()}}

        </div>
    </div>
@endsection
