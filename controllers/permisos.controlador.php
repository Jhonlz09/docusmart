<?php 

class PermisosControlador {

    static public function ctrObtenerMenuUsuario($id_usuario){

        $menuUsuario = PermisosModelo::mdlObtenerMenuUsuario($id_usuario);

        return $menuUsuario;
    }

    static public function ctrObtenerPermisosUsuario($id_usuario){

        $pUsuario = PermisosModelo::mdlObtenerPermisosUsuario($id_usuario);

        return $pUsuario;
    }

    static public function ctrObtenerConfigUsuario(){

        $pUsuario = PermisosModelo::mdlObtenerConfigUsuario();

        return $pUsuario;
    }
}
?>