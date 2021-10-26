<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>@yield('title')</title>
    <style>
        .navbar {
            font-size: 18px;
        }

        .container {
            padding: 10px;
        }
    </style>
</head>

<body>
    @section('sidebar')
    <nav class="navbar navbar-default navbar-shrink">
        <div class="container">
            <div class="navbar-header page-scroll">
                <p class="navbar-brand page-scroll">@yield('title')</p>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="{{ route('inicio')}}">Inicio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{ route('fecha')}}">Fecha</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{ route('edad')}}">Edad</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{ route('cumpleanos')}}">Cumpleaños</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @show

    @yield('content')

</body>

</html>