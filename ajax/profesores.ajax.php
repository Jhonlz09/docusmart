<?php

require_once "../controllers/profesores.controlador.php";
require_once "../models/profesores.modelo.php";

class ajaxProfesores{
    public $id_profesor;
    public $cedula;
    public $nombres_profesor;
    public $apellidos_profesor;

    public function MostrarProfesores(){

        $data = ControladorProfesores::ctrMostrarProfesores();

        echo json_encode($data);
    }
    public function agregarProfesores(){

        $data = ControladorProfesores::ctrAgregarProfesores($this->cedula, $this-> nombres_profesor, $this-> apellidos_profesor);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function eliminarProfesores(){

        $data = ControladorProfesores::ctrEliminarProfesores($this->id_profesor);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function editarProfesores(){

        $data = ControladorProfesores::ctrEditarProfesores($this->id_profesor, $this->cedula, $this-> nombres_profesor, $this-> apellidos_profesor);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}



if(!isset($_POST["accion"])){
    $data = new ajaxProfesores();
    $data -> MostrarProfesores();
}else{
    if($_POST["accion"] == "agregar"){
        $agregar = new ajaxProfesores();
        $agregar ->cedula = $_POST["cedula"];
        $agregar ->nombres_profesor = $_POST["nombres_profesor"];
        $agregar ->apellidos_profesor = $_POST["apellidos_profesor"];
        $agregar ->agregarProfesores();
    }
    if($_POST["accion"] == "delete"){
        $eliminar = new ajaxProfesores();
        $eliminar ->id_profesor = $_POST["id_profesor"];
        $eliminar ->eliminarProfesores();
    } 
    if($_POST["accion"] == "editar"){
        $editar = new ajaxProfesores();
        $editar ->id_profesor = $_POST["id_profesor"];
        $editar ->cedula = $_POST["cedula"];
        $editar ->nombres_profesor = $_POST["nombres_profesor"];
        $editar ->apellidos_profesor = $_POST["apellidos_profesor"];
        $editar ->editarProfesores();
    }
}