<?php

require_once "../controllers/carreras.controlador.php";
require_once "../models/carreras.modelo.php";
class ajaxCarreras
{

    public $nombre_carrera;
    public $id_direccion, $nivel;
    public $id_carrera, $id_materia;

    public function MostrarCarreras()
    {

        $data = ControladorCarreras::ctrMostrarCarreras();

        echo json_encode($data);
    }
    public function agregarCarreras()
    {

        $data = ControladorCarreras::ctrAgregarCarreras($this->nombre_carrera, $this->nivel);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function eliminarCarreras()
    {

        $data = ControladorCarreras::ctrEliminarCarreras($this->id_carrera);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function editarCarreras()
    {

        $data = ControladorCarreras::ctrEditarCarreras($this->id_carrera, $this->nombre_carrera, $this->nivel);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function relacionarMaterias(){

        $data = ControladorCarreras::ctrRelacionarMaterias($this->id_materia);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function eliminarRelacionMaterias(){

        $data = ControladorCarreras::ctrEliminarRelacionMaterias($this->id_carrera);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function editarRelacionMaterias(){

        $data = ControladorCarreras::ctrEditarRelacionMaterias($this->id_materia, $this->id_carrera);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}

if (isset($_POST["accion"]) && $_POST['accion'] == 1) {
    $data = new ajaxCarreras();
    $data->MostrarCarreras();
} else if (isset($_POST["accion"]) && $_POST["accion"] == "agregar") {
    $a = new ajaxCarreras();
    $a->nombre_carrera = $_POST["nombre_carrera"];
    $a->nivel = $_POST["id_nivel"];
    // $a ->id_materia = $_POST["id_materia"];
    $a->agregarCarreras();
} else if (isset($_POST["accion"]) && $_POST["accion"] == "delete") {
    $eliminar = new ajaxCarreras();
    $eliminar->id_carrera = $_POST["id_carrera"];
    $eliminar->eliminarCarreras();
} else if (isset($_POST["accion"]) && $_POST["accion"] == "editar") {
    $e = new ajaxCarreras();
    $e->id_carrera = $_POST["id_carrera"];
    $e->nombre_carrera = $_POST["nombre_carrera"];
    $e->nivel = $_POST["id_nivel"];
    $e->editarCarreras();
}else if(isset($_POST["relacion"]) && $_POST["relacion"] == 1){ 
    $r = new ajaxCarreras();
    $r ->id_materia = $_POST["id_materia"];
    $r -> relacionarMaterias();
}else if(isset($_POST["relacion"]) && $_POST["relacion"] == 2){ 
    $r = new ajaxCarreras();
    $r ->id_carrera = $_POST["id_carrera"];
    // $r ->id_carrera = $_POST["id_carrera"];
    $r -> eliminarRelacionMaterias();
}else if(isset($_POST["relacion"]) && $_POST["relacion"] == 3){ // parametro para listar productos
    $r = new ajaxCarreras();
    $r ->id_materia = $_POST["id_materia"];
    $r ->id_carrera = $_POST["id_carrera"];
    $r -> editarRelacionMaterias();
}
