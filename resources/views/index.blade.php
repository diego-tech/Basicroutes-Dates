@extends('layouts.layout')

<head>
    <title>Inicio</title>
    <style>
        h3 {
            text-align: center;
        }
    </style>
</head>

<body>
    @section('sidebar')
    @parent
    @stop
    @section('title')
    Inicio
    @stop
    @section('content')
    <h3>Bienvenido al primer proyecto de Laravel de Diego!!!</h3>
    @stop
</body>

</html>