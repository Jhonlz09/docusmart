<?php

require_once "../utils/database/conexion.php";

class PerfilModelo
{

    static public function mdlObtenerPerfiles()
    {

        $stmt = Conexion::ConexionDB()->prepare("SELECT p.id_perfil, p.descripcion, '' as acciones
        FROM tblperfil p
        WHERE p.id_perfil != 1 AND p.estado_perfil ='A'
        ORDER BY p.id_perfil");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlRegistrarPermisos($id_perfil, $crear, $editar, $eliminar, $aprobar)
    {

        $stmt = Conexion::ConexionDB()->prepare("UPDATE tblperfil
                                                SET crear=:crear, editar=:editar, aprobar=:aprobar, eliminar=:eliminar
                                                WHERE id_perfil =:id_perfil;");

        $stmt->bindParam(":id_perfil", $id_perfil, PDO::PARAM_INT);
        $stmt->bindParam(":crear", $crear, PDO::PARAM_BOOL);
        $stmt->bindParam(":editar", $editar, PDO::PARAM_BOOL);
        $stmt->bindParam(":eliminar", $eliminar, PDO::PARAM_BOOL);
        $stmt->bindParam(":aprobar", $aprobar, PDO::PARAM_BOOL);
        if ($stmt->execute()) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        return $resultado;
    }

    static public function mdlSelecionarPermisos($id_perfil)
    {

        $stmt = Conexion::ConexionDB()->prepare("SELECT crear, editar, aprobar, eliminar
        FROM tblperfil WHERE id_perfil=:id_perfil;");

        $stmt->bindParam(":id_perfil", $id_perfil, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static public function mdlAgregarRol($descripcion)
    {
        $a = Conexion::ConexionDB()->prepare("INSERT INTO tblperfil(descripcion) VALUES (:descripcion)");
        $a->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);

        if ($a->execute()) {
            return "El rol se agrego correctamente";
        } else {
            return "Error, no se pudo agregar el rol";
        }
    }

    static public function mdlEliminarRol($id_perfil)
    {
        $e = Conexion::ConexionDB()->prepare("UPDATE tblperfil SET estado_perfil= 'I' WHERE id_perfil=:id_perfil");
        $e->bindParam(":id_perfil", $id_perfil, PDO::PARAM_STR);
        if ($e->execute()) {
            return "EL rol se eliminó correctamente";
        } else {
            return "Error, no se pudo eliminar el rol";
        }
    }
    static public function mdlEditarRol($id_perfil, $descripcion)
    {
        $u = Conexion::ConexionDB()->prepare("UPDATE tblperfil SET descripcion=:descripcion WHERE id_perfil=:id_perfil");

        $u->bindParam(":id_perfil", $id_perfil, PDO::PARAM_STR);
        $u->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);

        if ($u->execute()) {
            return "El rol se editó correctamente";
        } else {
            return "Error, no se pudo editar el rol";
        }
    }
}
