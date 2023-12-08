<?php

class ControladorCarreras {

    static public function ctrMostrarCarreras(){
        $data = ModeloCarreras::mdlMostrarCarreras();
        return $data;
    }
    
    static public function ctrAgregarCarreras($nombre_carrera, $id_nivel){
        $data = ModeloCarreras::mdlAgregarCarreras($nombre_carrera,$id_nivel);
        return $data;
    }

    static public function ctrEliminarCarreras($id_carrera){
        $data = ModeloCarreras::mdlEliminarCarreras($id_carrera);
        return $data;
    }

    static public function ctrEditarCarreras($id_carrera,$nombre_carrera, $id_nivel){
        $data = ModeloCarreras::mdlEditarCarreras($id_carrera,$nombre_carrera,$id_nivel);
        return $data;
    }

    static public function ctrRelacionarMaterias($id_materia){
        $data = ModeloCarreras::mdlRelacionarMaterias($id_materia);
        return $data;
    }

    static public function ctrEliminarRelacionMaterias($id_carrera){
        $data = ModeloCarreras::mdlEliminarRelacionMaterias($id_carrera);
        return $data;
    }

    static public function ctrEditarRelacionMaterias($id_materia, $id_carrera){
        $data = ModeloCarreras::mdlEditarRelacionMaterias($id_materia, $id_carrera);
        return $data;
    }
}