<?php

require_once "../utils/database/conexion.php";

class ModuloModelo
{

    static public function mdlObtenerModulos()
    {

        $stmt = Conexion::ConexionDB()->prepare("SELECT
        id_modulo AS id, CASE WHEN id_padre IS NULL THEN '#' ELSE id_padre END AS parent,
        modulo AS text,vista FROM tblmodulo m
        ORDER BY m.id_modulo;");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static public function mdlObtenerModulosPorPerfil($id_perfil)
    {
        $stmt = Conexion::ConexionDB()->prepare("SELECT 
        id_modulo AS id,
        modulo,
        COALESCE(
            CASE WHEN m.vista IS NULL OR m.vista = '' THEN '0'
                ELSE 
                    (SELECT '1' FROM tblperfil_modulo pm 
                    WHERE pm.id_modulo = m.id_modulo AND pm.id_perfil = :id_perfil)
            END, '0') AS sel,
        (SELECT vista_inicio FROM tblperfil_modulo pm 
        WHERE pm.id_modulo = m.id_modulo AND pm.id_perfil = :id_perfil1) as vista_inicio
    FROM tblmodulo m ORDER BY m.id_modulo;");

        $stmt->bindParam(":id_perfil", $id_perfil, PDO::PARAM_INT);
        $stmt->bindParam(":id_perfil1", $id_perfil, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
