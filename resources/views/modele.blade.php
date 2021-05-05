<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <style>
        .error {background-color: red;}
        .etat {background-color: greenyellow;}
        .my-primary{
            color: black ;
            background-color: cadetblue;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
          crossorigin="anonymous">

</head>

<body class="my-primary">

@section('menu')

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"
    >
    </script>


    <!-- bar de navigation -->
    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
        <div class="container-fluid">
            @auth
                <a class="navbar-brand" href="{{route('home')}}">School 2.0</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <!--Accueil-->
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{route('home')}}">Accueil</a>
                        </li>

                    @if(Auth::user()->type == 'admin')
                        <!--Gestion admin-->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">Administrateur</a>
                                <ul class="dropdown-menu" aria-labelledby="dropdown03">
                                    <li><a class="dropdown-item" href="{{route('admin.home')}}">Aller sur la page admin</a></li>
                                </ul>
                            </li>
                    @endif

                    @if(Auth::user()->type == 'etudiant')
                        <!--Gestion étudiant-->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">Etudiant</a>
                                <ul class="dropdown-menu" aria-labelledby="dropdown03">
                                    <li><a class="dropdown-item" href="{{route('user.etudiant.cours.index',['id'=>Auth::id()])}}">Liste des cours de ma formation</a></li>
                                    <li><a class="dropdown-item" href="{{route('user.etudiant.gestioninscr_home')}}">Gestion des cours</a></li>
                                    <li><a class="dropdown-item" href="{{route('user.etudiant.gestionplanning')}}">Mon planning</a></li>
                                </ul>
                            </li>
                    @endif

                    @if(Auth::user()->type == 'enseignant')
                        <!--Gestion enseignant-->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">Enseignant</a>
                                <ul class="dropdown-menu" aria-labelledby="dropdown03">
                                    <li><a class="dropdown-item" href="{{route('user.enseignant.cours.index',['id'=>Auth::user()->id])}}">Liste des cours que j'enseigne</a></li>
                                    <li><a class="dropdown-item" href="{{route('user.enseignant.showplanning')}}">Mon planning</a></li>
                                    <li><a class="dropdown-item" href="{{route('user.enseignant.gestionplanning_home')}}">Gestion du planning</a></li>
                                </ul>
                            </li>
                    @endif

                    @if(Auth::user()->type == 'enseignant' || Auth::user()->type == 'etudiant')
                        <!--Gestion compte-->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">Gestion compte</a>
                                <ul class="dropdown-menu" aria-labelledby="dropdown03">
                                    <li><a class="dropdown-item" href="{{route('editnom',['id'=>Auth::id()])}}">Modifier Nom/prénom</a></li>
                                    <li><a class="dropdown-item" href="{{route('editMdp',['id'=>Auth::id()])}}">Modifier le mot de passe</a></li>
                                </ul>
                            </li>
                    @endif

                    <!--Déconnexion-->
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{route('logout')}}">Deconnexion</a>
                        </li>


                    </ul>
                    @else
                        <a class="navbar-brand" href="{{route('main')}}">School 2.0</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                                <!--Accueil-->
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="{{route('main')}}">Home</a>
                                </li>
                                <!--Partie enseignant et élève pour se connecter ou créer un nouveau compte-->
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="{{route('register')}}">Nouveau compte</a>
                                </li>
                                <!--Connexion-->
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="{{route('login')}}">Connexion</a>
                                </li>
                            </ul>

                            @endauth
                        </div>
    </nav>

    <p><br/><br/></p>


    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@show

@if( session()->has('etat'))
    <p class="etat">{{session()->get('etat')}}</p>
@endif


@show

@yield('contents')

@show

@auth
    @if(Auth::user()->type == 'admin')
        <nav class="navbar fixed-bottom navbar-dark bg-dark">
            <a class="navbar-brand" href="{{route('admin.home')}}">Aller sur la page admin</a>
        </nav>
    @endif

@endauth


</body>
</html>
