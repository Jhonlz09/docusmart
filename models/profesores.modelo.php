<?php

require_once "../utils/database/conexion.php";

class ModeloProfesores{
    static public function mdlMostrarProfesores(){
        $l = Conexion::ConexionDB()->prepare("SELECT id_profesor, cedula, nombres_profesor, apellidos_profesor, '' as acciones FROM tblprofesor WHERE estado='A' ORDER BY id_profesor ASC");
        $l -> execute();

        return $l ->fetchAll();
        
    } 

    static public function mdlAgregarProfesores($cedula, $nombres_profesor, $apellidos_profesor){
        
        try {
        $a = Conexion::ConexionDB()->prepare("INSERT INTO tblprofesor(cedula,nombres_profesor,apellidos_profesor) VALUES (:cedula,:nombres_profesor,:apellidos_profesor)");
        
        $a -> bindParam(":cedula", $cedula, PDO::PARAM_STR); 
        $a -> bindParam(":nombres_profesor", $nombres_profesor, PDO::PARAM_STR); 
        $a -> bindParam(":apellidos_profesor", $apellidos_profesor, PDO::PARAM_STR);

        if($a -> execute()){
            $resultado = "ok";
        }else{
            $resultado = "error";
        }
    } catch (PDOException $e) {
        if ($e->getCode() == '1062') {
            // Mensaje de error personalizado
            $resultado = 'V';
            }
        } 
        return $resultado;    
    } 

    static public function mdlEliminarProfesores($id_profesor){
        $e = Conexion::ConexionDB()->prepare("UPDATE tblprofesor SET estado= 'I' WHERE id_profesor=:id_profesor");

        $e -> bindParam(":id_profesor", $id_profesor, PDO::PARAM_STR); 

        if($e -> execute()){
            return "EL profesor se eliminó correctamente";
        }else{
            return "Error, no se pudo eliminar el profesor";
        }
    } 
    static public function mdlEditarProfesores($id_profesor,$cedula,$nombres_profesor, $apellidos_profesor){
        try{
        $u = Conexion::ConexionDB()->prepare("UPDATE tblprofesor SET cedula=:cedula, nombres_profesor=:nombres_profesor, apellidos_profesor=:apellidos_profesor WHERE id_profesor=:id_profesor");
        
        $u -> bindParam(":id_profesor", $id_profesor, PDO::PARAM_STR); 
        $u -> bindParam(":cedula", $cedula, PDO::PARAM_STR); 
        $u -> bindParam(":nombres_profesor", $nombres_profesor, PDO::PARAM_STR); 
        $u -> bindParam(":apellidos_profesor", $apellidos_profesor, PDO::PARAM_STR); 

        if($u -> execute()){
            $resultado = "ok";
        }else{
            $resultado = "error";
        }
    } catch (PDOException $e) {
        if ($e->getCode() == '1062') {
            $resultado = 'V';
            }
        } 
        return $resultado;    
    } 
    

}