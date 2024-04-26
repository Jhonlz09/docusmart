<?php
session_start(); // Inicializar la sesión
require_once "../utils/database/conexion.php";

    class SesionModelo{

        public static function mdlIniciarSesion($usuario, $password){
            $stmt = Conexion::ConexionDB()->prepare("SELECT u.id_usuario,u.nombre_usuario,u.clave_usuario,u.id_perfil,p.crear,p.editar,p.aprobar,p.eliminar,pm.vista_inicio,pm.id_modulo,m.modulo,m.icon_menu,m.vista FROM tblusuario u 
            JOIN tblperfil p ON u.id_perfil = p.id_perfil
            JOIN tblperfil_modulo pm ON pm.id_perfil = u.id_perfil
            JOIN tblmodulo m ON m.id_modulo = pm.id_modulo  
            WHERE nombre_usuario=:usuario AND vista_inicio=1");
            
            $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_CLASS);

            if ($user) {
                // El usuario existe en la base de datos, verificar la contraseña
                if (password_verify($password, $user[0]->clave_usuario)) {
                    $_SESSION["s_usuario"] = $user[0];
                    return "success";
                } else {
                    // Contraseña incorrecta
                    return "invalid_password";
                }
            } else {
                // Usuario no encontrado
                return "invalid_username";
            }
        }
    }

?>