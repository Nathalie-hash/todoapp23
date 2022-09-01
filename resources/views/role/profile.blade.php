@extends('layouts.app')

@section('content')
<section class="vh-100" style="background-color: #f4f5f7;">
  <div class="container_12 py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-6 mb-4 mb-lg-0">
        <div class="card mb-3" style="border-radius: .5rem;">
          <div class="row g-0">
            <div class="col-md-4 gradient-custom text-center text-black"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
            <h5>{{$user->name}}</h5>
              <i class="far fa-edit mb-5"></i>
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Email</h6>
                    <p class="text-muted">{{$user->email}}</p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Phone</h6>
                    <p class="text-muted">{{$user->phone}}</p>
                  </div>
                </div>
                <h6>Profil</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Rôle</h6>
                    <p class="text-muted">{{$roles}}</p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Statut</h6>
                    <p class="text-muted">Connecté</p>
                  </div>
                </div>
                <div class="d-flex justify-content-start">
                  <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                  <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                  <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



<div class="alert alert-success" role="alert">
    <strong>Bienvenue, {{$user->name}} !</strong> <br> Vous êtes connecté en tant que, {{$roles}}.  
</div>
@endsection