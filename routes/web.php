<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'hola'); // Redireccionamos la ruta / a /hola

// Get Methods
Route::get('/hola', function () {
    return view('index');
})->name('inicio');

Route::get('/fecha', function () {
    date_default_timezone_set('Europe/Madrid');
    $data = date('m/d/Y h:i:s a', time());
    return view('fecha', ['data' => $data]);
})->name('fecha');

Route::get('/edad', function () {
    return view('edad');
})->name('edad');

Route::get('/cumpleanos', function () {
    return view('cumpleanos');
})->name('cumpleanos');

// Post Methods
Route::post('/edad', function (Request $request) {
    $dato = $request->input('date');
    $datoDateTime = new \DateTime($dato);
    $date = new \DateTime();

    return view(
        'edad',
        [
            'dato' => $datoDateTime->format('d/m/Y'),
            'intervalData' => intervalDateTime($datoDateTime, $date)
        ]
    );
});

Route::post('/cumpleanos', function (Request $request) {
    $dato = $request->input('date');
    $datoDateTime = new \DateTime($dato);
    $datoDateTimeFormat = $datoDateTime->format('d/m/Y');
    $date = new \DateTime();

    $datoDateTimeFormat = $datoDateTime->format('d/m/Y');
    $dateFormat = $date->format('d/m/Y');

    if ($datoDateTimeFormat == $dateFormat) {
        $checkBool = 1;
    } else {
        $checkBool = 0;
    }

    dates($dato);
    return view(
        'cumpleanos',
        [
            'dato' => $datoDateTimeFormat,
            'intervalData' => dates($dato),
            'checkBool' => $checkBool
        ]
    );
});

// Otra Funciones

function intervalDateTime($date1, $date2)
{
    $interval = $date1->diff($date2);

    return $interval->format('%Y años - %m meses - %D días');
}

function dates($userdate)
{
    $userDato = explode("-", $userdate);
    $proxCumple = new \DateTime(date('Y') . "-" . $userDato[1] . "-" . $userDato[2]);
    $today = new \DateTime(date('Y-m-d'));

    $resultStr = "";
    if ($proxCumple < $today) {
        $resultStr = $proxCumple->add(new DateInterval('P1Y'));
    }

    if ($proxCumple == $today) {
        $resultStr = 'Es tu cumpleaños';
    } else {
        $diferencia = $today->diff($proxCumple);
        $resultStr .= $diferencia->format('%m meses %d dias');
        $resultStr .= $proxCumple->format(' l');
    }

    return $resultStr;
}
