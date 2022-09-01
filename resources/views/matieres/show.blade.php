@extends('layouts.app')

@section ( '{{$matiere->nom}}', 'Matiere')

@section('content')
<div class="container-fluid">
    @if (session('succes'))
        <div class="alert alert-success">
            {{ session('succes') }}
        </div>
    @endif

    <h1>
        Matière : {{$matiere->nom}}
        <a href="/niveau/{{$matiere->niveau_id}}">{{$matiere->niveau->nom}}</a>
    </h1>
    <p>{{$matiere->detail}}</p>
    <p>{{ $matiere["détail"]}}</p>

    <hr>  
    <br>

    <h2>Ressources</h2>
    {{-- TODO: lister les ressources associés à ce matière ici
    pour chaque ressources, renseigner un lien de téléchargement 
    (cf: RessourcesController@getRessource et web.php)
    --}}

    {{-- TODO: à côté du lien de téléchargement, ajouter un lien de 
    suppression si l'utilisateur courant a pour rôle enseignant 
    ou administrateur --}}
    <table class="table table-hover">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Date de création</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($matiere->ressources()->where('matiere_id',$matiere->id)->get() as $m)
            <tr>
                <td> {{ $m->nom }} </td>
                <td> {{ $m->created_at }} </td>
                <td>
                    <a href="/ressources/get/{{ $m->id }}">
                        télécharger
                    </a>
                    @if($user->hasRole('administrateur') || $user->hasRole('enseignant'))
                        <a href="/ressources/delete/{{ $m->id }}">
                            supprimer
                        </a>
                    @endif
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- TODO: ne pas afficher cette partie pour ajouter les ressources si
    le rôle de l'utilisateur courant est différent d'enseignant ou d'administrateur 
    --}}
    @php
    // l'utilisateur courant
    $user = Auth::getUser();

    @endphp
    @if(!auth()->user()->hasRole("etudiant"))
        <h2>Ajouter ressources</h2>
        <form action="/ressources/add" enctype="multipart/form-data" method="post">
            {{-- TODO: rappel : toujours ajouter cet input _token dans les formulaires. Ici OK --}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="file" name="ressource"  id="">
            <input type="hidden" name="matiere" value="{{$matiere->id}}">
            <input type="submit" value="téléverser">
        </form>
    @endif
</div>
@endsection
