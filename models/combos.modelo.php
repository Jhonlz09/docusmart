<?php

require_once "../utils/database/conexion.php";

class ModeloCombos{
    static public function mdlComboProfesores(){
        $c = Conexion::ConexionDB()->prepare("SELECT id_profesor, CONCAT(nombres_profesor, ' ', apellidos_profesor) AS nombre
        FROM tblprofesor
        WHERE estado = 'A'
        ORDER BY nombre ASC;");
        $c -> execute();

        return $c ->fetchAll();
        
    }

    static public function mdlComboMaterias(){
        $c = Conexion::ConexionDB()->prepare("SELECT id_materia, nombre_materia FROM tblmaterias WHERE estado_materia='A' ORDER BY nombre_materia ASC");
        $c -> execute();

        return $c ->fetchAll();
        
    }
    static public function mdlComboHorario(){
        $c = Conexion::ConexionDB()->prepare("SELECT id_horario, horario FROM tblhorario");
        $c -> execute();

        return $c ->fetchAll();
        
    }
    static public function mdlComboPeriodo(){
        $c = Conexion::ConexionDB()->prepare("SELECT id_periodo, semestre_modulo FROM tblperiodo");
        $c -> execute();

        return $c ->fetchAll();
    }
    static public function mdlComboCarrera(){
        $c = Conexion::ConexionDB()->prepare("SELECT id_carrera, nombre_carrera FROM tblcarrera WHERE estado_carrera='A' ORDER BY nombre_carrera ASC");
        $c -> execute();

        return $c ->fetchAll();
        
    }

    static public function mdlComboDireccion(){
        $c = Conexion::ConexionDB()->prepare("SELECT id_direccion, direccion 
        FROM tbldireccion 
        WHERE estado_direccion = 'A' ORDER BY id_direccion");
        $c -> execute();

        return $c ->fetchAll();
        
    }

    static public function mdlComboTemporada(){
        $c = Conexion::ConexionDB()->prepare("SELECT id_temp, year FROM tbltemporada WHERE year <= YEAR(CURRENT_DATE) ORDER BY id_temp;");
        $c -> execute();

        return $c ->fetchAll();
    }

    static public function mdlComboNivel(){
        $c = Conexion::ConexionDB()->prepare("SELECT * FROM tblnivel
                                            WHERE id_nivel <> 4 order by id_nivel;");
        $c -> execute();

        return $c ->fetchAll();
    }

    static public function mdlComboRol(){
        $c = Conexion::ConexionDB()->prepare("SELECT id_perfil, descripcion FROM tblperfil WHERE id_perfil <> 1 AND estado_perfil= 'A'
        order by id_perfil");
        $c -> execute();

        return $c ->fetchAll();
    }

}