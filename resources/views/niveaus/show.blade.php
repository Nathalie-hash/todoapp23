@extends('layouts.app')

@section('title')
    {{$niveau->nom}}
@endsection

@section('content')
@if (session('succes'))
        <div class="alert alert-success">
            {{ session('succes') }}
        </div>
    @endif
    {{-- TODO s'inspirer de resources/views/matieres/show.blade.php pour mettre dans les
    @section --}}
    <h3>{{$niveau->nom}}</h3>

    Liste des matières dans cet niveau
    <ul>
        @foreach($niveau->matieres as $matiere)
        <li class="list-group-item "> <a href="/matiere/{{$matiere->id}}" class="d-block w-100 h-100">{{$matiere->nom}}, {{$matiere->detail}} </a></li>        @endforeach
    </ul>


    {{-- TODO: si l'utilisateur a un rôle d'enseignant ou d'administrateur,
    lister les étudiants appartenant à ce niveau --}}
    {{-- <strong>Liste des étudiants à faire pour l'utilisateur courant de role enseignant ou administrateur</strong> --}}
    {{ $niveau->niveau_user }}
    @if(auth()->check() && auth()->user()->hasRole('enseignant')||auth()->check() && auth()->user()->hasRole('administrateur'))
    {{ $niveau->niveau_user }}
        <ul>
        {{--@foreach($niveau->n as $user)
            <li>{{$user->nom}} </li>
        
        @endforeach--}}
        </ul>
    @endif
   @php
    // l'utilisateur courant
    $user = Auth::getUser();

    @endphp
    @if(!auth()->user()->hasRole("etudiant"))
    <h3>Formulaire d'ajout de matière</h3>
    <form action="/niveau/ajouter_matiere" method="post">
        @csrf
        <div>
            <input type="hidden" name="niveau_id" value="{{$niveau->id}}">
        </div>
        <div class="form-group">
          <label for="nom">Nom de la matiere</label>
          <input type="text" class="form-control" name="nom" placeholder="Entrer le nom de la matière" id="{{$niveau->nom}}">
        </div>
        <div class="form-group">
          <label for="pwd">Detail</label>
          <input type="text" class="form-control" name="detail" placeholder="Entrer le detail" id="{{$niveau->detail}}">
        </div>        <div>
            <button type="submit" class="btn btn-primary my-1">Ajouter</button>
        </div>

    </form> 
    @endif
@endsection
