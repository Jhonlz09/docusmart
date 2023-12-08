<?php

class ControladorDireccion {

    static public function ctrMostrarDireccion(){
        $data = ModeloDireccion::mdlMostrarDireccion();
        return $data;
    }
    
    static public function ctrAgregarDireccion($direccion){
        $data = ModeloDireccion::mdlAgregarDireccion($direccion);
        return $data;
    }

    static public function ctrEliminarDireccion($id_direccion){
        $data = ModeloDireccion::mdlEliminarDireccion($id_direccion);
        return $data;
    }

    static public function ctrEditarDireccion($id_direccion, $direccion){
        $data = ModeloDireccion::mdlEditarDireccion($id_direccion, $direccion);
        return $data;
    }
}