@extends('layouts.layout')

<head>
    <title>Cumpleaños</title>
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
    Cumpleaños
    @stop
    @section('content')
    <div id="container">
        <div id="dato">
            @if ($dato ?? '' != "")
            <h4>Próximo Cumpleaños: {{ $dato ?? ''}}</h4>
            @else
            <h4>Próximo Cumpleaños: </h4>
            @endif
        </div>
        <form method="POST" action="cumpleanos" id="form">
            @csrf
            <label>Próximo Cumpleaños</label>
            <br>
            <input type="date" name="date" max="<?= date('Y-m-d', strtotime('now')); ?>" />
            <br>
            <input type="submit" value="Enviar Datos">
        </form>
    </div>

    @if ($checkBool ?? '' == 1)
    <script type="text/javascript">
        alert("FELICIDADES!! \nTu cumpleaños es HOY!!");
    </script>
    @elseif ($intervalData ?? '' != "")
    <h3 class="clearfix" id="intervalData">Quedan para tu cumpleaños: {{ $intervalData ?? ''}}</h3>
    @endif

    @stop
</body>