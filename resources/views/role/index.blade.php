@extends('layouts.app')

@section ( 'title', 'Liste des rôles et niveaux')


@section('content')
<div class="container w-100 text-center">
    {{-- TODO: ajouter un lien vers la configuration des rôles --}}
    @php
    // l'utilisateur courant
    $user = Auth::getUser();

    @endphp
	@if(auth()->user()->hasRole("administrateur"))
    <div>
        <a href="/roles/config" class="btn btn-primary text-light  p-3 mb-5">Role configuration</a>
    </div>
    <table class="table table-striped shadow">
        <thead class="bg-violet">
            <tr>
                <th>Utilisateur</th>
                <th>Rôle</th>
                <th>Niveau</th>
            </tr>
        </thead>

        <tbody>
        @foreach($users as $user)
            <tr>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    {{$user->roles->first()["name"]}}               
                </td>
                <td>
                    <ul style="list-style: none">
                    @foreach($user->niveaux as $niveau)
                        <li>{{$niveau->nom}}</li>
                    @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
@else
Vous n'êtes pas autorisé à voir cette page
    @endif
</div>