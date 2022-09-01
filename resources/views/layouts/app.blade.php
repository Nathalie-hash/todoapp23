<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

      <!--custom css file link -->
      <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/vendor/bootstrap.min.css') }}" rel="stylesheet" />
      

</head>
<body>
    {{-- TODO: Ajouter un menu pour naviguer dans l'application --}}
    {{-- utiliser les menus bootstrap --}}
    {{-- TODO: dans le menu, ajouter un bouton pour se connecter si on ne l'est pas
    et pour se déconnecter si on est déjà connecté (cf:routes/web.php por se documenter éventuellement) 
    On a utilisé le quick start dans la documentation sur l'authentification de laravel7
    --}}
    {{-- TODO: dans le menu, afficher le rôle et le nom de l'utilisateur courant --}}
    {{-- TODO: supprimer toutes les views (.blade ou dossier) dans ressources relatif au modèle Task
    qu'il faudra également supprimer
    Supprimer tout ce qui a trait au modèle Task même dans la base
    --}}

    {{-- TODO: seulement pour l'administrateur, dans le menu,
    ajouter un lien vers la liste des rôles et niveaux 
    cf routes/web.php RoleController@index --}}

<div class="navbar navabr-expand d-flex flex-row ustify-content-space-between fixed-top bg-violet shadow">
    <div class="navabar-nav nav">
        <div class="nav-item">
            <a href="/" class="nav-link">Accueil</a>
        </div>
    @hasrole('administrateur')
        <div class="nav-item">
            <a href="/roles/index" class="nav-link">Configuration</a>
        </div>
    @endhasrole
    </div>
    <div>
        <a href="{{ url("/mon_profile") }}" class="btn btn-deconnect">Profile</a>
        <a href="{{ url('/logout') }}" class="btn btn-deconnect">
            <i class="fa fa-sign-out"></i> Déconnexion</a>
    </div>
</div>    
<div class="container w-100">
    <div class="">
        @yield('content')
    </div>
</div>


</body>
</html>