<?php

class ControladorProfesores {

    static public function ctrMostrarProfesores(){
        $data = ModeloProfesores::mdlMostrarProfesores();
        return $data;
    }
    static public function ctrAgregarProfesores($cedula, $nombres_profesor, $apellidos_profesor){
        $data = ModeloProfesores::mdlAgregarProfesores($cedula, $nombres_profesor, $apellidos_profesor);
        return $data;
    }
    static public function ctrEliminarProfesores($id_profesor){
        $data = ModeloProfesores::mdlEliminarProfesores($id_profesor);
        return $data;
    }
    static public function ctrEditarProfesores($id_profesor, $cedula, $nombres_profesor, $apellidos_profesor){
        $data = ModeloProfesores::mdlEditarProfesores($id_profesor, $cedula ,$nombres_profesor, $apellidos_profesor);
        return $data;
    }
}