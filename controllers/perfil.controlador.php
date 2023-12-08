<?php

class PerfilControlador{

    static public function ctrObtenerPerfiles(){

        $modulos = PerfilModelo::mdlObtenerPerfiles();

        return $modulos;
    }

    static public function ctrRegistrarPermisos($id_perfil,$crear, $editar, $eliminar,$aprobar){

        $permisos = PerfilModelo::mdlRegistrarPermisos($id_perfil,$crear, $editar, $eliminar,$aprobar);

        return $permisos;
    }
    
    static public function ctrSelecionarPermisos($id_perfil){

        $permisos = PerfilModelo::mdlSelecionarPermisos($id_perfil);

        return $permisos;
    }

    static public function ctrAgregarRol($descripcion){
        $data = PerfilModelo::mdlAgregarRol($descripcion);
        return $data;
    }
    static public function ctrEliminarRol($id_perfil){
        $data = PerfilModelo::mdlEliminarRol($id_perfil);
        return $data;
    }
    static public function ctrEditarRol($id_perfil, $descripcion){
        $data = PerfilModelo::mdlEditarRol($id_perfil, $descripcion);
        return $data;
    }


}