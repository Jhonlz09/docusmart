<?php

require_once "../utils/database/conexion.php";

class ModeloMaterias{
    static public function mdlMostrarMaterias(){
        $l = Conexion::ConexionDB()->prepare("SELECT
        m.id_materia,
        m.nombre_materia,
        m.codigo_materia,
        '' AS acciones,
        m.id_direccion,
        CONCAT('{', GROUP_CONCAT(DISTINCT mc.id_carrera ORDER BY mc.id_carrera), '}') AS carreras_relacionadas
    FROM tblmaterias m
    LEFT JOIN tblmateria_carrera mc ON m.id_materia = mc.id_materia
    WHERE m.estado_materia = 'A'
    GROUP BY m.id_materia, m.nombre_materia, m.codigo_materia, m.id_direccion
    ORDER BY m.id_materia ASC;
    ");
        $l -> execute();

        return $l ->fetchAll();
    } 

    static public function mdlAgregarMaterias($codigo_materia, $nombre_materia, $id_direccion){
        $a = Conexion::ConexionDB()->prepare("INSERT INTO tblmaterias(codigo_materia,nombre_materia, id_direccion) VALUES (:codigo_materia,:nombre_materia,:id_direccion)");
        
        $a -> bindParam(":codigo_materia", $codigo_materia, PDO::PARAM_STR); 
        $a -> bindParam(":nombre_materia", $nombre_materia, PDO::PARAM_STR); 
        $a -> bindParam(":id_direccion", $id_direccion, PDO::PARAM_INT);
        if($a -> execute()){
            return 'La materia se agregó correctamente';
        }else{
            return 'Error, no se pudo agregar la materia';
        }     
    } 

    static public function mdlEliminarMaterias($id_materia){
        $e = Conexion::ConexionDB()->prepare("UPDATE tblmaterias SET estado_materia= 'I' WHERE id_materia=:id_materia");

        $e -> bindParam(":id_materia", $id_materia, PDO::PARAM_INT); 

        if($e -> execute()){
            return 'La materia se eliminó correctamente';
        }else{
            return 'Error, no se pudo eliminar la materia';
        }     
    } 
    static public function mdlEditarMaterias($id_materia,$codigo_materia,$nombre_materia, $id_direccion){
        $u = Conexion::ConexionDB()->prepare("UPDATE tblmaterias SET codigo_materia=:codigo_materia, nombre_materia=:nombre_materia, id_direccion=:id_direccion WHERE id_materia=:id_materia");
        
        $u -> bindParam(":id_materia", $id_materia, PDO::PARAM_STR); 
        $u -> bindParam(":codigo_materia", $codigo_materia, PDO::PARAM_STR); 
        $u -> bindParam(":nombre_materia", $nombre_materia, PDO::PARAM_STR); 
        $u -> bindParam(":id_direccion", $id_direccion, PDO::PARAM_INT);

        if($u -> execute()){
            return 'La materia se editó correctamente';
        }else{
            return 'Error, no se pudo editar la materia';
        }   
    } 

    static public function mdlRelacionarCarreras($id_carrera){
        try {
            $u = Conexion::ConexionDB()->prepare("INSERT INTO tblmateria_carrera(
            id_materia, id_carrera)
            VALUES ((SELECT MAX(id_materia) FROM tblmaterias),:id_carrera)");
            $u->bindParam(":id_carrera", $id_carrera, PDO::PARAM_STR);
            
            if($u -> execute()){
                return 'La relacion fue exitosa';
            }else{
                return 'Error, no se pudo relacionar la materia';
            }
        } catch (PDOException $e) {
            return "Error, no se pudo relacionar la materia " . $e->getMessage();
        }    
    } 

    static public function mdlEliminarRelacionMaterias($id_materia) {
        try {
            $u = Conexion::ConexionDB()->prepare("DELETE FROM tblmateria_carrera
            WHERE id_materia=:id_materia;");
    
            $u->bindParam(":id_materia", $id_materia, PDO::PARAM_INT);
    
            if ($u->execute()) {
                return 'ok';
            } else {
                return 'Error, no se pudo relacionar la materia';
            }
        } catch (PDOException $e) {
            return 'Error en la consulta: ' . $e->getMessage();
        }
    }

    static public function mdlEditarRelacionMaterias($id_materia, $id_carrera) {
        try {
            $u = Conexion::ConexionDB()->prepare("INSERT INTO tblmateria_carrera(
                                                    id_materia, id_carrera)
                                                    VALUES (:id_materia,:id_carrera)");
            $u->bindParam(":id_materia", $id_materia, PDO::PARAM_INT);
            $u->bindParam(":id_carrera", $id_carrera, PDO::PARAM_INT);
            
            if ($u->execute()) {
                return 'ok';
            } else {
                return 'Error, no se pudo relacionar la materia';
            }
        } catch (PDOException $e) {
            return 'Error en la consulta: ' . $e->getMessage();
        }
    }
}