<?php

require_once "../controllers/materias.controlador.php";
require_once "../models/materias.modelo.php";

class ajaxMaterias{
    public $codigo_materia,$nombre_materia,$id_materia,$id_direccion, $id_carrera;

    public function MostrarMaterias(){

        $data = ControladorMaterias::ctrMostrarMaterias();

        echo json_encode($data);
    }
    public function agregarMaterias(){

        $data = ControladorMaterias::ctrAgregarMaterias($this->codigo_materia, $this-> nombre_materia, $this->id_direccion);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function eliminarMaterias(){

        $data = ControladorMaterias::ctrEliminarMaterias($this->id_materia);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function editarMaterias(){

        $data = ControladorMaterias::ctrEditarMaterias($this->id_materia, $this->codigo_materia, $this-> nombre_materia,$this->id_direccion);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function relacionarCarreras(){

        $data = ControladorMaterias::ctrRelacionarMaterias($this->id_carrera);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function eliminarRelacionCarreras(){

        $data = ControladorMaterias::ctrEliminarRelacionMaterias($this->id_materia);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function editarRelacionCarreras(){

        $data = ControladorMaterias::ctrEditarRelacionMaterias($this->id_materia, $this->id_carrera);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

}

if(isset($_POST["accion"]) && $_POST['accion'] == 1){
    $data = new ajaxMaterias();
    $data -> MostrarMaterias();
}else if(isset($_POST["accion"]) && $_POST["accion"] == 3){
    $a = new ajaxMaterias();
    $a ->codigo_materia = $_POST["codigo_materia"];
    $a ->nombre_materia = $_POST["nombre_materia"];
    $a ->id_direccion = $_POST["id_direccion"];
    $a ->agregarMaterias();
}else if(isset($_POST["accion"]) && $_POST["accion"] == 4){
    $e = new ajaxMaterias();
    $e ->id_materia = $_POST["id_materia"];
    $e ->eliminarMaterias();
}else if(isset($_POST["accion"]) && $_POST["accion"] == 5){
    $e = new ajaxMaterias();
    $e ->id_materia = $_POST["id_materia"];
    $e ->codigo_materia = $_POST["codigo_materia"];
    $e ->nombre_materia = $_POST["nombre_materia"];
    $e ->id_direccion = $_POST["id_direccion"];
    $e ->editarMaterias();
}else if(isset($_POST["relacion"]) && $_POST["relacion"] == 1){ 
    $r = new ajaxMaterias();
    $r ->id_carrera = $_POST["id_carrera"];
    $r -> relacionarCarreras();
}else if(isset($_POST["relacion"]) && $_POST["relacion"] == 2){ 
    $r = new ajaxMaterias();
    $r ->id_materia = $_POST["id_materia"];
    $r -> eliminarRelacionCarreras();
}else if(isset($_POST["relacion"]) && $_POST["relacion"] == 3){ // parametro para listar productos
    $r = new ajaxMaterias();
    $r ->id_materia = $_POST["id_materia"];
    $r ->id_carrera = $_POST["id_carrera"];
    $r -> editarRelacionCarreras();
}