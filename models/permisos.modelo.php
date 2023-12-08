<?php
session_start(); // Inicializar la sesión
require_once "utils/database/conexion.php";

    class PermisosModelo{
        
        static public function mdlObtenerMenuUsuario($id_usuario){

            $stmt = Conexion::ConexionDB()->prepare("SELECT m.id_modulo,m.modulo,m.icon_menu,m.vista,pm.vista_inicio
                                                        FROM tblusuario u JOIN tblperfil p on u.id_perfil = p.id_perfil
                                                        JOIN tblperfil_modulo pm on pm.id_perfil = p.id_perfil
                                                        JOIN tblmodulo m on m.id_modulo = pm.id_modulo
                                                        WHERE u.id_usuario = :id_usuario
                                                        AND m.id_padre is null
                                                        ORDER BY m.id_modulo");
    
            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);
    
            $stmt->execute();
    
            return $stmt-> fetchAll(PDO::FETCH_CLASS);
    
        }
        
        static public function mdlObtenerPermisosUsuario($id_usuario){

            $stmt = Conexion::ConexionDB()->prepare("SELECT p.crear,p.aprobar,p.eliminar,p.editar
            FROM tblusuario u JOIN tblperfil p on u.id_perfil = p.id_perfil
            WHERE u.id_usuario = :id_usuario");
    
            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);
    
            $stmt->execute();
    
            return $stmt-> fetchAll(PDO::FETCH_CLASS);
    
        }

        static public function mdlObtenerConfigUsuario(){

            $stmt = Conexion::ConexionDB()->prepare("SELECT c.institucion, c.rutalogo FROM tblconfiguracion c");
        
            $stmt->execute();
    
            return $stmt-> fetchAll(PDO::FETCH_CLASS);
    
        }
    }

?>