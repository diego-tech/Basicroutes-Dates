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
    $today = new \DateTime(date('Y-m-d'));
    $checkBool = 0;

    if (checkTodayIsBirthday($today, $datoDateTime) != false) {
        $checkBool = 1;
    }

    return view(
        'cumpleanos',
        [
            'dato' => $datoDateTimeFormat,
            'intervalData' => checkNextBirthday($dato, $today),
            'checkBool' => $checkBool
        ]
    );
});

// Otra Funciones

/**
 * @param datetime fecha que el usuario introduce por input y fecha del sistema
 * @return string string con formato que muestra el intervalo entre las dos fechas
 */
function intervalDateTime($date1, $date2)
{
    $interval = $date1->diff($date2);

    return $interval->format('%Y años - %m meses - %D días');
}


/**
 * @param datetime fecha que el usuario introduce por input y fecha del sistema
 * @return bool booleana que comprueba si coinciden las fechas o no
 */
function checkTodayIsBirthday(datetime $date1, datetime $date2)
{
    if ($date1 != $date2) {
        return false;
    }

    return true;
}

/**
 * @param string/datetime fecha en formato string que introduce el usuario y fecha del sistema en formato datetime
 * @return string string con el texto que se mostrará en la vista
 */
function checkNextBirthday(string $date, datetime $today)
{
    $userDato = explode("-", $date);

    $proxCumple = new \DateTime(date('Y') . "-" . $userDato[1] . "-" . $userDato[2]);

    $resultStr = "";

    if ($proxCumple < $today) {
        $proxCumple->add(new DateInterval('P1Y'));
    }

    $diferencia = $today->diff($proxCumple);

    $yearsanddaysStr = $diferencia->format('%m meses %d dias');
    $dayFormat = $proxCumple->format(' l');

    $resultStr = $yearsanddaysStr . " y cae en" . $dayFormat;

    return $resultStr;
}
