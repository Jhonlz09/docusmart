<?php

class ControladorMaterias {

    static public function ctrMostrarMaterias(){
        $data = ModeloMaterias::mdlMostrarMaterias();
        return $data;
    }
    static public function ctrAgregarMaterias($codigo_materia, $nombre_materia, $id_direccion){
        $data = ModeloMaterias::mdlAgregarMaterias($codigo_materia, $nombre_materia, $id_direccion);
        return $data;
    }
    static public function ctrEliminarMaterias($id_materia){
        $data = ModeloMaterias::mdlEliminarMaterias($id_materia);
        return $data;
    }
    static public function ctrEditarMaterias($id_materia, $codigo_materia, $nombre_materia, $id_direccion){
        $data = ModeloMaterias::mdlEditarMaterias($id_materia, $codigo_materia ,$nombre_materia, $id_direccion);
        return $data;
    }

    static public function ctrRelacionarMaterias($id_carrera){
        $data = ModeloMaterias::mdlRelacionarCarreras($id_carrera);
        return $data;
    }

    static public function ctrEliminarRelacionMaterias($id_materia){
        $data = ModeloMaterias::mdlEliminarRelacionMaterias($id_materia);
        return $data;
    }

    static public function ctrEditarRelacionMaterias($id_materia, $id_carrera){
        $data = ModeloMaterias::mdlEditarRelacionMaterias($id_materia, $id_carrera);
        return $data;
    }
}