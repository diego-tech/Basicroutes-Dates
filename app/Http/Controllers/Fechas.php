<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Fechas extends Controller
{
    public function obtenerFechaSistema()
    {
        date_default_timezone_set('Europe/Madrid');
        $data = date('m/d/Y H:i:s a', time());
        return view('fecha', ['data' => $data]);
    }

    public function calcularEdad(Request $request)
    {
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
                'intervalData' => $this->intervalDateTime($datoDateTime, $date)
            ]
        );
    }

    public function calcularCumpleanos(Request $request)
    {
        $dato = "";
        $checkNextBirthday = "";
        $today = new \DateTime(date('Y-m-d'));
        $datoDateTime = new \DateTime();

        if ($request->has('date') && $request->isMethod('post')) {
            $dato = $request->input('date');
            $checkNextBirthday = $this->checkNextBirthday($dato, $today);
            $datoDateTime = new \DateTime($dato);
        } else {
            $datoDateTime = new \DateTime('0001-01-01');
        }

        $checkBool = 0;
        $datoDateTimeFormat = $datoDateTime->format('d/m/Y');
        $bool = $this->checkTodayIsBirthday($today, $datoDateTime);

        if ($bool == true) {
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
    }

    /**
     * @param datetime fecha que el usuario introduce por input y fecha del sistema
     * @return string string con formato que muestra el intervalo entre las dos fechas
     */
    public function intervalDateTime($date1, $date2)
    {
        $interval = $date1->diff($date2);

        return $interval->format('%Y años - %m meses - %D días');
    }

    /**
     * @param datetime fecha que el usuario introduce por input y fecha del sistema
     * @return bool booleana que comprueba si coinciden las fechas o no
     */
    public function checkTodayIsBirthday($date1, $date2)
    {
        $date1Format = $date1->format('m-d');
        $date2Format = $date2->format('m-d');

        if ($date1Format != $date2Format) {
            return false;
        }

        return true;
    }

    /**
     * @param string/datetime fecha en formato string que introduce el usuario y fecha del sistema en formato datetime
     * @return string string con el texto que se mostrará en la vista
     */
    public function checkNextBirthday($date, $today)
    {
        $userDato = explode("-", $date);

        $proxCumple = new \DateTime(date('Y') . "-" . $userDato[1] . "-" . $userDato[2]);

        $resultStr = "";

        if ($proxCumple < $today) {
            $proxCumple->add(new \DateInterval('P1Y'));
        }

        $diferencia = $today->diff($proxCumple);

        $yearsanddaysStr = $diferencia->format('%m meses %d dias');
        $dayFormat = $proxCumple->format(' l');

        $resultStr = $yearsanddaysStr . " y cae en" . $dayFormat;

        return $resultStr;
    }
}
