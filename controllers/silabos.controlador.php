<?php


class SilabosControlador{

    static public function ctrCargaMasiva($fileSilabos){
        
        $respuesta = SilabosModelo::mdlCargaMasiva($fileSilabos);
        return $respuesta;
    }
    static public function ctrListarSilabos($anio){
    
        $silabos = SilabosModelo::mdlListarSilabos($anio);
        return $silabos;
    }

    static public function ctrCambiarEstadoSilabos($id, $estado, $fecha_actual){
        
        $silabos = SilabosModelo::mdlCambiarEstadoSilabos($id, $estado, $fecha_actual);
        return $silabos;
    
    }

    static public function ctrAgregarSilabos($id_profesor, $id_materia, $id_horario, $id_periodo, $id_doc, $id_año, $capel, $id_drive){
        
        $silabos = SilabosModelo::mdlAgregarSilabos($id_profesor, $id_materia, $id_horario, $id_periodo, $id_doc, $id_año, $capel, $id_drive);
        return $silabos;
    
    }

    static public function ctrEditarSilabos($id_asignacion,$id_profesor, $id_materia, $id_horario, $id_periodo, $id_doc, $comentario, $id_año,$capel){
        
        $silabos = SilabosModelo::mdlEditarSilabos($id_asignacion,$id_profesor, $id_materia, $id_horario, $id_periodo, $id_doc, $comentario, $id_año,$capel);
        return $silabos;
    
    }
    static public function ctrEliminarSilabos($id_asignacion){
        
        $silabos = SilabosModelo::mdlEliminarSilabos($id_asignacion);
        return $silabos;
    
    }
}

