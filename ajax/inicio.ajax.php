<?php

require_once "../controllers/inicio.controlador.php";
require_once "../models/inicio.modelo.php";

class AjaxInicio
{
    public $estado, $año, $fecha_ini, $fecha_en, $fecha_fin;

    public function getDatosInicio()
    {

        $datos = InicioControlador::ctrGetDatosInicio();

        echo json_encode($datos);
    }

    public function getDatosInicioAño()
    {

        $datos = InicioControlador::ctrGetDatosInicioAño($this->año);

        echo json_encode($datos);
    }

    public function getGraficoMes()
    {
        $datos = InicioControlador::ctrGetGraficoMes($this->año);
        echo json_encode($datos);
    }

    public function getTablaDoc()
    {
        $datos = InicioControlador::ctrGetTablaDoc($this->año);
        echo json_encode($datos);
    }

    public function getGraficoAct()
    {
        $datos = InicioControlador::ctrGetGraficoAct($this->fecha_ini, $this->fecha_en, $this->fecha_fin);
        echo json_encode($datos);
    }
    public function getTablaMod()
    {
        $datos = InicioControlador::ctrGetTablaMod();
        echo json_encode($datos);
    }
}
if (isset($_POST['accion']) && $_POST['accion'] == 1) {
    $datos = new AjaxInicio();
    $datos->año = $_POST["id_anio"];
    $datos->getGraficoMes();
} else if (isset($_POST['accion']) && $_POST['accion'] == 2) {
    $datos = new AjaxInicio();
    $datos->año = $_POST["id_anio"];
    $datos->getTablaDoc();
} else if (isset($_POST['accion']) && $_POST['accion'] == 3) {
    $datos = new AjaxInicio();
    $datos->getTablaMod();
} else if (isset($_POST['accion']) && $_POST['accion'] == 4) {
    $datos = new AjaxInicio();
    $datos->año = $_POST["id_año"];
    $datos->getDatosInicioAño();
} else if (isset($_POST['accion']) && $_POST['accion'] == 5) {
    $datos = new AjaxInicio();
    $datos->fecha_ini = $_POST["fecha_ini"];
    $datos->fecha_en = $_POST["fecha_en"];
    $datos->fecha_fin = $_POST["fecha_fin"];
    $datos->getGraficoAct();
} else {
    $datos = new AjaxInicio();
    $datos->getDatosInicio();
}