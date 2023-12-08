<?php

require_once "../controllers/perfil.controlador.php";
require_once "../models/perfil.modelo.php";

class ajaxPerfil{
    public $id_perfil, $crear, $editar, $eliminar, $aprobar, $descripcion;

    public function ajaxObtenerPerfiles(){
        $p = PerfilControlador::ctrObtenerPerfiles();
        echo json_encode($p);
    }
    public function ajaxRegistrarPermisos(){
        $p = PerfilControlador::ctrRegistrarPermisos($this->id_perfil, $this->crear, $this->editar, $this->eliminar, $this->aprobar);
        echo json_encode($p);
    }
    public function ajaxSelecionarPermisos(){
        $p = PerfilControlador::ctrSelecionarPermisos($this->id_perfil);
        echo json_encode($p);
    }
    public function agregarRol(){

        $data = PerfilControlador::ctrAgregarRol($this->descripcion);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function eliminarRol(){

        $data = PerfilControlador::ctrEliminarRol($this->id_perfil);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function editarRol(){

        $data = PerfilControlador::ctrEditarRol($this->id_perfil, $this->descripcion);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
if(isset($_POST['accion']) && $_POST['accion'] == 1){
    $p = new ajaxPerfil;    
    $p->ajaxObtenerPerfiles();
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){
    $p = new ajaxPerfil;   
    $p ->id_perfil = $_POST["idPerfil"];
    $p-> crear = $_POST["crear"];
    $p ->editar = $_POST["editar"];
    $p ->eliminar = $_POST["eliminar"];
    $p ->aprobar = $_POST["aprobar"];
    $p->ajaxRegistrarPermisos();
}else if(isset($_POST['accion']) && $_POST['accion'] == 3){
    $p = new ajaxPerfil;   
    $p ->id_perfil = $_POST["id_perfil"];
    $p->ajaxSelecionarPermisos();
}else if(isset($_POST['accion']) && $_POST['accion'] == 4){
    $a = new ajaxPerfil;   
    $a ->descripcion = $_POST["descripcion"];
    $a ->agregarRol();
}else if(isset($_POST['accion']) && $_POST['accion'] == 5){
    $e = new ajaxPerfil;   
    $e ->id_perfil = $_POST["id_perfil"];
    $e ->descripcion = $_POST["descripcion"];
    $e ->editarRol();
}else if(isset($_POST['accion']) && $_POST['accion'] == 6){
    $d = new ajaxPerfil;   
    $d ->id_perfil = $_POST["id_perfil"];
    $d ->eliminarRol();
}
