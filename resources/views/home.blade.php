@extends('layouts.app')

@section('title','Accueil')

@section('content')

    @php
        // l'utilisateur courant
        $user = Auth::getUser();
    @endphp
    
    @hasanyrole('administrateur|etudiant|enseignant')
        @foreach($user->niveaux as $niveau)
            <div class="box" style="width:720px !important">
                <h2 style="font-size:25px;font-weight:bold;color:#3d3d3d;border-bottom:1px solid #7d2ae7 !important"><a href="/niveau/{{ $niveau->id }}" class="text-dark" style="text-decoration: none"> Niveau {{$niveau->nom}}</a></h2>
                <i class="d-block mt-3 mb-2"><button class="btn" data-toggle="collapse" data-target="#{{ $niveau }}">Liste des matières &gt;</button></i>
                <ul class="collapse list-group w-100" >
                    @foreach($niveau->matieres as $matiere)
                        {{-- TODO: prévoir un lien pour accéder à ce matière (lien /matiere/xx)--}}
                        <li class="list-group-item "> <a href="/matiere/{{$matiere->id}}" class="d-block w-100 h-100">{{$matiere->nom}}</a></li>
                    @endforeach
                </ul>
            </div>    
        @endforeach
    @else
    <p>Vous êtes enregistré avec succès! Veuillez contacter l'administrateur pour continuer</p>
    {{-- <script  type="text/javascript">window.location = {url('/')};</script> --}}
    @endhasanyrole    
@endsection
