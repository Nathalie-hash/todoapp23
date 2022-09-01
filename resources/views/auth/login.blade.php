@extends('layouts.app')

@section('content')
<body>
<div class="container">
    <div class="row justify-content-center">

    
    <form  method="POST" action="{{ route('login') }}" class="shadow"  id="login-form" > 
        @csrf
       
        <div class="">
            <div class="title p-2 mb-5">Login here</div>
            
            <div class="input-box">
                
                <input type="text" placeholder="Email" id="email" name="email" class="form-control w-100  @error('email') is-invalid @enderror" required autocomplete="email" autofocus>
            </div>
            <div class="input-box">
               
                <input type="password" placeholder="Password" id="password" name="password" class="form-control w-100" value="{{ old('email') }}"  required>
            </div>
            
            <div class="form-group row">
                <div class="col-md-6 ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" style="color: #5a5a5a;font-size:15px" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-6 ">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link " href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Login') }}
                    </button>

                    
                </div>
                <div class="col-md-12">
                    <div class="text w-100 text-center" style="color: #5a5a5a;font-size:14px;text-align: center !important;">Don't have an account?</div>
                    <a class="btn btn-link d-block w-100 text-center" href="{{ route('register') }}">
                        {{ __('Register now') }}
                    </a>
                </div>
            </div>
        </div>
        </div>
    </form>
</div>
</body>
@endsection
