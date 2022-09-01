<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- TODO: personnaliser cette page
        Ce n'est pas une page de laravel mais
        le portail pour notre application --}}

        <title>Application de ...</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
               
                background-image: url('tco1.webp');
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-left" style="position:absolute;left:10px;top:18px">
                Educom
            </div>
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Acceuil</a>
                    @else
                       {{-- <a href="#">A propos</a>
                        <a href="#">Contact</a> --}} 
                        <a href="{{ route('login') }}">Se Connecter</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">S'inscricre</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
               
            </div>
        </div>
    </body>
</html>
