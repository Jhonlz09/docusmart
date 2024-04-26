<?php

require_once "../controllers/modulo.controlador.php";
require_once "../models/modulo.modelo.php";

class ajaxModulo{
    public function ajaxObtenerModulos(){

        $modulos = ModuloControlador::ctrObtenerModulos();

        echo json_encode($modulos);
    }

    public function ajaxObtenerModulosPorPerfil($id_perfil){

        $modulosPerfil = ModuloControlador::ctrObtenerModulosPorPerfil($id_perfil);

        echo json_encode($modulosPerfil);
    }

}

if(isset($_POST['accion']) && $_POST['accion'] == 1){ //
    $modulos = new ajaxModulo;
    $modulos->ajaxObtenerModulos();
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ //
    $moduloPerfil = new ajaxModulo();
    $moduloPerfil->ajaxObtenerModulosPorPerfil($_POST["id_perfil"]);
}