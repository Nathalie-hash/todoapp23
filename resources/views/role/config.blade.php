@extends('layouts.app')

@section ( 'title', 'Configurer les rôles et les niveaux')


@section('content')
<div class="container w-100">
	    {{-- TODO: ajouter un lien vers la liste des rôles et niveaux --}}

		@php
    // l'utilisateur courant
    $user = Auth::getUser();

    @endphp
	@if(auth()->user()->hasRole("administrateur"))
		<div>
			<strong><a href="/roles/index" class="btn btn-primary p-3 mb-5">See all roles</a></strong>
		</div>
	
	<h3 class="bg-violet p-2">Assign roles</h3>
	<form action="/roles/save" method="POST" class="w-100 p-3" style="width:520px !important">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		users: <br>
		<select name="user" id="" class="form-control">
			@foreach ($users as $user)
				<option value="{{$user->id}}">{{$user->name}}</option>
			@endforeach
		</select>
		<br>Roles: <br>
		<select name="role" id="" class="form-control">
			@foreach ($rolesModels as $role)
				@if($role->name!="administrateur")
				<option value="{{$role->id}}">{{$role->name}}</option>
				@endif
			@endforeach
		</select>
		<br>Levels: <br>
		<select name="niveau[]" id="" multiple class="form-control" required>
			@foreach ($niveaux as $niveau)
				<option value="{{$niveau->id}}">{{$niveau->nom}}</option>
			@endforeach
		</select>
		<input type="submit" value="OK" class="btn btn-primary mt-3">
	</form>
	@else
		Vous n'êtes pas autorisé à voir page
	
	@endif
		
</div>
@endsection