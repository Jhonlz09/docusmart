<?php

require_once "../controllers/direccion.controlador.php";
require_once "../models/direccion.modelo.php";

class ajaxDireccion{

    public $direccion;
    public $id_direccion;

    public function MostrarDireccion(){

        $data = ControladorDireccion::ctrMostrarDireccion();

        echo json_encode($data);
    }
    public function agregarDireccion(){

        $data = ControladorDireccion::ctrAgregarDireccion( $this-> direccion);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function eliminarDireccion(){

        $data = ControladorDireccion::ctrEliminarDireccion($this->id_direccion);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function editarDireccion(){

        $data = ControladorDireccion::ctrEditarDireccion($this->id_direccion, $this->direccion);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}

if(!isset($_POST["accion"])){
    $data = new ajaxDireccion();
    $data -> MostrarDireccion();
}else{
    if($_POST["accion"] == "agregar"){
        $agregar = new ajaxDireccion();
        $agregar ->direccion = $_POST["direccion"];
        $agregar ->agregarDireccion();
    }
    if($_POST["accion"] == "delete"){
        $eliminar = new ajaxDireccion();
        $eliminar ->id_direccion = $_POST["id_direccion"];
        $eliminar ->eliminarDireccion();
    } 
    if($_POST["accion"] == "editar"){
        $editar = new ajaxDireccion();
        $editar ->id_direccion = $_POST["id_direccion"];
        $editar ->direccion = $_POST["direccion"];
        $editar ->editarDireccion();
    }
}