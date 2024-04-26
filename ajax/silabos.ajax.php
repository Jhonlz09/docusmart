<?php

require_once "../controllers/silabos.controlador.php";
require_once "../models/silabos.modelo.php";


class ajaxSilabos{

    public $fileSilabos;
    public $id, $capel;
    public $estado, $estado_silabo, $fecha_actual;
    public $infoAño, $id_doc, $id_asignacion,$id_profesor, $id_materia, $id_horario, $id_periodo, $id_carrera, $id_año, $comentario;
    public $mes_ini, $mes_fin, $id_drive;

    
    public function ajaxListarSilabos(){
    
        $productos = SilabosControlador::ctrListarSilabos($this->id_año); 
    
        echo json_encode($productos);
    
    }


    public function ajaxCambiarEstadoSilabos(){
    
        $silabos = SilabosControlador::ctrCambiarEstadoSilabos($this->id, $this->estado, $this->fecha_actual);
    
        echo json_encode($silabos);
    
    }

    public function ajaxAgregarSilabos(){ 
    
        $silabos = SilabosControlador::ctrAgregarSilabos($this->id_profesor, $this->id_materia, $this->id_horario, $this->id_periodo, $this->id_doc, $this->id_año,$this->capel,$this->id_drive);
    
        echo json_encode($silabos);
    
    }

    public function ajaxEditarSilabos(){
    
        $silabos = SilabosControlador::ctrEditarSilabos($this->id_asignacion, $this->id_profesor, $this->id_materia, $this->id_horario, $this->id_periodo, $this->id_doc, $this->comentario, $this->id_año, $this->capel );
    
        echo json_encode($silabos);
    
    }

    public function ajaxEliminarSilabos(){
    
        $silabos = SilabosControlador::ctrEliminarSilabos($this->id_asignacion);
    
        echo json_encode($silabos, JSON_UNESCAPED_UNICODE);
    
    }

}

if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar productos
    $silabos = new ajaxSilabos();
    $silabos ->id_año = $_POST["anio"];
    $silabos -> ajaxListarSilabos();
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){
    $silabos = new ajaxSilabos();
    $silabos ->id = $_POST["id"];
    $silabos ->estado = $_POST["estado"];
    $silabos ->fecha_actual = $_POST["fecha_actual"];
    $silabos -> ajaxCambiarEstadoSilabos();
}else if(isset($_POST['accion']) && $_POST['accion'] == 3){
    $s = new ajaxSilabos();
    $s ->id_profesor = $_POST["id_profesor"];
    $s ->id_materia = $_POST["id_materia"];
    $s ->id_horario = $_POST["id_horario"];
    $s ->id_periodo = $_POST["id_periodo"];
    $s ->id_doc = $_POST["id_doc"];
    $s ->id_año = $_POST["id_año"];
    $s ->id_drive = $_POST["id_drive"];
    $s ->capel = $_POST["capel"];
    $s -> ajaxAgregarSilabos();
}else if(isset($_POST['accion']) && $_POST['accion'] == 4){
    $e = new ajaxSilabos();
    $e ->id_asignacion = $_POST["id_asignacion"];
    $e -> ajaxEliminarSilabos();
}else if(isset($_POST['accion']) && $_POST['accion'] == 10){ // parametro para listar productos
    $silabos = new ajaxSilabos();
    $silabos ->id_asignacion = $_POST["id_asignacion"];
    $silabos ->id_profesor = $_POST["id_profesor"];
    $silabos ->id_materia = $_POST["id_materia"];
    $silabos ->id_horario = $_POST["id_horario"];
    $silabos ->id_periodo = $_POST["id_periodo"];
    $silabos ->id_doc = $_POST["id_doc"];
    $silabos ->id_año = $_POST["id_año"];
    $silabos ->comentario = $_POST["comentario"];
    $silabos ->capel = $_POST["capel"];
    $silabos -> ajaxEditarSilabos();
}