<?php

require_once "../utils/database/conexion.php";

class UsuarioModelo
{
    static public function mdlMostrarUsuarios()
    {

        $stmt = Conexion::ConexionDB()->prepare("SELECT u.id_usuario, u.nombre_usuario, u.estado_usuario, p.id_perfil,p.descripcion,'' as acciones FROM tblusuario u JOIN tblperfil p ON p.id_perfil=u.id_perfil WHERE u.estado_usuario='A' AND u.id_usuario != 1 order by u.id_usuario;");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function mdlMostrarUsuariosSuper()
    {

        $stmt = Conexion::ConexionDB()->prepare("SELECT u.id_usuario, u.nombre_usuario, u.estado_usuario, p.id_perfil,p.descripcion,'X' as acciones FROM tblusuario u JOIN tblperfil p ON p.id_perfil=u.id_perfil WHERE u.estado_usuario='A' order by u.id_usuario;");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function mdlAgregarUsuarios($usuario, $password, $id_perfil)
    {
        $resultado = "error";

        try {
            $conexion = Conexion::ConexionDB();

            $stmt = $conexion->prepare("INSERT INTO tblusuario(nombre_usuario, clave_usuario, id_perfil)
            VALUES (:nombre_usuario, :password, :id_perfil)");
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $stmt->bindParam(":nombre_usuario", $usuario, PDO::PARAM_STR);
            $stmt->bindParam(":id_perfil", $id_perfil, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $usuario_id = $conexion->lastInsertId();

                $stmtConf = $conexion->prepare("INSERT INTO tblconfiguracion(id_usuario)
                VALUES (:usuario_id)");
                $stmtConf->bindParam(":usuario_id", $usuario_id, PDO::PARAM_INT);

                if ($stmtConf->execute()) {
                    $resultado = "ok";
                }
            } else {
                $resultado = "error";
            }
        } catch (PDOException $e) {
            // Manejo de errores
            $resultado = "error: " . $e->getMessage();
        }

        return $resultado;
    }


    static public function mdlEditarUsuarios($id_usuario, $usuario, $id_perfil)
    {
        if ($id_perfil == "null") {
            $id_perfil =  1;
        }

        $stmt = Conexion::ConexionDB()->prepare("UPDATE tblusuario
        SET nombre_usuario=:nombre_usuario, id_perfil=:id_perfil
        WHERE id_usuario=:id_usuario;");

        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);
        $stmt->bindParam(":nombre_usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":id_perfil", $id_perfil, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->execute()) {
            $resultado = "ok";
        } else {
            $resultado = "error";
        }
        return $resultado;
    }

    static public function mdlEliminarUsuario($id_usuario)
    {

        $stmt = Conexion::ConexionDB()->prepare("DELETE FROM tblusuario
            WHERE id_usuario=:id_usuario;");

        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function mdlRestablecerClaveUsuario($id_usuario, $password)
    {

        $stmt = Conexion::ConexionDB()->prepare("UPDATE tblusuario
                SET clave_usuario=:password
                WHERE id_usuario=:id_usuario;");

        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        return $resultado;
    }
}
