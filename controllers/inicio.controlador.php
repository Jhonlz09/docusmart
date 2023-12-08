<?php
class InicioControlador
{

    static public function ctrGetDatosInicio()
    {

        $datos = InicioModelo::mdlGetDatosInicio();

        return $datos;
    }

    static public function ctrGetDatosInicioAño($anio)
    {

        $datos = InicioModelo::mdlGetDatosInicioAño($anio);

        return $datos;
    }

    static public function ctrGetGraficoMes($anio)
    {

        $datos = InicioModelo::mdlGetGraficoMes($anio);

        return $datos;
    }

    static public function ctrGetTablaDoc($anio)
    {

        $datos = InicioModelo::mdlGetTablaDoc($anio);

        return $datos;
    }

    static public function ctrGetGraficoAct($fecha_ini,$fecha_en,$fecha_fin)
    {

        $datos = InicioModelo::mdlGetGraficoAct($fecha_ini, $fecha_en, $fecha_fin);

        return $datos;
    }

    static public function ctrGetTablaMod()
    {

        $datos = InicioModelo::mdlGetTablaMod();

        return $datos;
    }
}