<?php

require_once "../controllers/silabos.controlador.php";
require_once "../models/silabos.modelo.php";

require_once "../vendor/autoload.php";


class ajaxCarga{

    public $fileSilabos;

    public function ajaxCargaMasiva(){
        $respuesta = SilabosControlador::ctrCargaMasiva($this->fileSilabos);
        echo json_encode($respuesta);
    }
    public function ajaxCargaCarreras(){
        $respuesta = SilabosControlador::ctrCargaMasiva($this->fileSilabos);
        echo json_encode($respuesta);
    }
    public function ajaxCargaMaterias(){
        $respuesta = SilabosControlador::ctrCargaMasiva($this->fileSilabos);
        echo json_encode($respuesta);
    }
    public function ajaxCargaProfesor(){
        $respuesta = SilabosControlador::ctrCargaMasiva($this->fileSilabos);
        echo json_encode($respuesta);
    }
}

if(isset($_FILES)){
    $archivo = new ajaxCarga();
    $archivo-> fileSilabos = $_FILES['fileDocs'];
    $archivo -> ajaxCargaMasiva();
}