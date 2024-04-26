<?php
require_once "../utils/database/conexion.php";

class ModeloCarreras
{
    static public function mdlMostrarCarreras()
    {
        $l = Conexion::ConexionDB()->prepare("SELECT
        c.id_carrera,
        CONCAT(n.nombre_nivel, ' EN ', c.nombre_carrera) as carreras,
        c.nombre_carrera,
        n.id_nivel,
        '' as acciones,
        CONCAT('{', (SELECT GROUP_CONCAT(id_materia) FROM tblmateria_carrera cm WHERE cm.id_carrera = c.id_carrera), '}') as materias_relacionadas
    FROM tblcarrera c
    JOIN tblnivel n ON c.id_nivel = n.id_nivel
    WHERE c.estado_carrera = 'A'
    ORDER BY c.id_carrera;");
        if ($l->execute()) {
            return $l->fetchAll();
        } else {
            return "Error, no se pudo agregar la carrera";
        }
    }

    static public function mdlAgregarCarreras($nombre_carrera, $id_nivel)
    {
        $a = Conexion::ConexionDB()->prepare("INSERT INTO tblcarrera(nombre_carrera, id_nivel) VALUES (:nombre_carrera,:id_nivel)");

        $a->bindParam(":nombre_carrera", $nombre_carrera, PDO::PARAM_STR);
        $a->bindParam(":id_nivel", $id_nivel, PDO::PARAM_STR);
        if ($a->execute()) {
            return "La carrera se agrego correctamente";
        } else {
            return "Error, no se pudo agregar la carrera";
        }
    }

    static public function mdlEliminarCarreras($id_carrera)
    {
        $conexion = Conexion::ConexionDB();
        $e = $conexion->prepare("UPDATE tblcarrera SET estado_carrera = 'I' WHERE id_carrera = :id_carrera");

        $e->bindParam(":id_carrera", $id_carrera, PDO::PARAM_INT);

        if ($e->execute()) {
            return 'La carrera se eliminó correctamente';
        } else {
            return 'Error, no se pudo eliminar la carrera';
        }
    }

    static public function mdlEditarCarreras($id_carrera, $nombre_carrera, $id_nivel)
    {
        $u = Conexion::ConexionDB()->prepare("UPDATE tblcarrera SET nombre_carrera=:nombre_carrera, id_nivel=:id_nivel WHERE id_carrera=:id_carrera");

        $u->bindParam(":id_carrera", $id_carrera, PDO::PARAM_STR);
        $u->bindParam(":nombre_carrera", $nombre_carrera, PDO::PARAM_STR);
        // $u -> bindParam(":id_direccion", $id_direccion, PDO::PARAM_STR);
        $u->bindParam(":id_nivel", $id_nivel, PDO::PARAM_STR);


        if ($u->execute()) {
            return 'La carrera se editó correctamente';
        } else {
            return 'Error, no se pudo editar la carrera';
        }
    }

    static public function mdlRelacionarMaterias($id_materia)
    {
        try {
            $u = Conexion::ConexionDB()->prepare("INSERT INTO tblmateria_carrera (id_carrera, id_materia)
            VALUES ((SELECT MAX(id_carrera) FROM tblcarrera), :id_materia);");
            $u->bindParam(":id_materia", $id_materia, PDO::PARAM_STR);

            if ($u->execute()) {
                return 'La relacion fue exitosa';
            } else {
                return 'Error, no se pudo relacionar la materia';
            }
        } catch (PDOException $e) {
            return "Error, no se pudo relacionar la materia " . $e->getMessage();
        }
    }

    static public function mdlEliminarRelacionMaterias($id_carrera)
    {
        try {
            $u = Conexion::ConexionDB()->prepare("DELETE FROM tblmateria_carrera
            WHERE id_carrera=:id_carrera;");

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
    static public function mdlEditarRelacionMaterias($id_materia, $id_carrera)
    {

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
