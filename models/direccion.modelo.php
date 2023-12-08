<?php
require_once "../utils/database/conexion.php";

class ModeloDireccion{
    static public function mdlMostrarDireccion(){
        $l = Conexion::ConexionDB()->prepare("SELECT id_direccion, direccion, 'X' as acciones 
                                                FROM tbldireccion WHERE estado_direccion ='A';");
        $l -> execute();
        return $l ->fetchAll();   
    } 

    static public function mdlAgregarDireccion($direccion){
        $a = Conexion::ConexionDB()->prepare("INSERT INTO tbldireccion(direccion) VALUES (:direccion)");
        
        $a -> bindParam(":direccion", $direccion, PDO::PARAM_STR); 
        
        if($a -> execute()){
            return "La direccion se agrego correctamente";
        }else{
            return "Error, no se pudo agregar la direccion";
        }    
    } 

    static public function mdlEliminarDireccion($id_direccion){
        $conexion = Conexion::ConexionDB();
        $e = $conexion->prepare("UPDATE tbldireccion SET estado_direccion = 'I'
        WHERE id_direccion =:id_direccion");

        $e->bindParam(":id_direccion", $id_direccion, PDO::PARAM_STR); 

        if($e -> execute()){
            return "La direccion se eliminó correctamente";
        }else{
            return "Error, no se pudo eliminar la direccion";
        }   
    } 
    static public function mdlEditarDireccion($id_direccion, $direccion){
        $u = Conexion::ConexionDB()->prepare("UPDATE tbldireccion SET direccion=:direccion WHERE id_direccion=:id_direccion");
        
        $u -> bindParam(":id_direccion", $id_direccion, PDO::PARAM_INT); 
        $u -> bindParam(":direccion", $direccion, PDO::PARAM_INT); 

        if($u -> execute()){
            return "La direccion se editó correctamente";
        }else{
            return "Error, no se pudo editar la direccion";
        }
    } 
}