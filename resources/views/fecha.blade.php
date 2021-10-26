@extends('layouts.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Fecha</title>
    <style>
        #fecha {
            width: 20%;
            height: 100px;
            margin: auto;
            border-radius: 30px;
            border: 2px solid black;
        }

        #fecha p {
            text-align: center;
            align-items: center;
            line-height: 100px;
            color: #007bff;
            font-size: 20px;
            font-weight: 800;
        }
    </style>
</head>

<body>
    @section('sidebar')
    @parent
    @stop
    @section('title')
    Fecha
    @stop
    @section('content')
    <div id="fecha">
        <p>{{ $data }}</p>
    </div>
    @stop
</body>

</html>