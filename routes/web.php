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
    $data = date('m/d/Y H:i:s a', time());
    return view('fecha', ['data' => $data]);
})->name('fecha');

Route::match(['get', 'post'], '/edad', function (Request $request) {
    $date = new \DateTime();
    $dato = null;

    if ($request->has('date') && $request->isMethod('post')) {
        $dato = $request->input('date');
    }

    $datoDateTime = new \DateTime($dato);
    return view(
        'edad',
        [
            'dato' => $datoDateTime->format('d/m/Y'),
            'intervalData' => intervalDateTime($datoDateTime, $date)
        ]
    );
})->name('edad');

Route::match(['get', 'post'], '/cumpleanos', function (Request $request) {

    $dato = null;
    $today = new \DateTime(date('Y-m-d'));
    $checkBool = 0;
    $checkNextBirthday = "";

    if ($request->has('date') && $request->isMethod('post')) {
        $dato = $request->input('date');
        $checkNextBirthday = checkNextBirthday($dato, $today);
    }

    $datoDateTime = new \DateTime($dato);
    $datoDateTimeFormat = $datoDateTime->format('d/m/Y');

    if (checkTodayIsBirthday($today, $datoDateTime) != false) {
        $checkBool = 1;
    }

    return view(
        'cumpleanos',
        [
            'dato' => $datoDateTimeFormat,
            'intervalData' => $checkNextBirthday,
            'checkBool' => $checkBool
        ]
    );
})->name('cumpleanos');

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
function checkNextBirthday($date, $today)
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
