@extends('layouts.layout')

<head>
    <title>Edad</title>
    <style>
        .clearfix {
            float: none;
            clear: both;
        }

        #form {
            float: left;
            width: 20%;
        }

        #datepicker {
            align-items: center;
            border-radius: 5px;
        }

        #dato {
            width: 20%;
            float: left;
            margin-left: 25%;
            margin-right: 7%;
        }

        input[type=submit] {
            background-color: #333;
            color: white;
            border-style: none;
            border-radius: 3px;
            width: 100px;
            margin-top: 30px;
            font-size: 15px;
        }

        #intervalData {
            text-align: center;
            margin-top: 200px;
        }
    </style>
</head>

<body>
    @section('sidebar')
    @parent
    @stop
    @section('title')
    Edad
    @stop
    @section('content')

    <div id="container">
        <div id="dato">
            <h4>Fecha Seleccionada: {{ $dato ?? ''}}</h4>
        </div>
        <form method="POST" action="edad" id="form">
            @csrf
            <label>Día en el que naciste</label>
            <br>
            <input type="date" name="date" value="<?= date('Y-m-d', strtotime('now')); ?>" max="<?= date('Y-m-d', strtotime('now')); ?>" />
            <br>
            <input type="submit" value="Enviar Datos">
        </form>
    </div>

    @if ($intervalData ?? '' != "")
    <h3 class="clearfix" id="intervalData">Años vividos: {{ $intervalData ?? ''}}</h3>
    @endif

    @stop
</body>