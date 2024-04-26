<?php
require_once "../utils/database/conexion.php";

class InicioModelo
{

    static public function mdlGetDatosInicio()
    {

        $stmt = Conexion::ConexionDB()->prepare("SELECT 
            SUM(CASE WHEN a.id_temp = t.id_temp THEN 1 ELSE 0 END) AS silabos,
            SUM(CASE WHEN a.id_micro = 1 AND a.id_temp = t.id_temp THEN 1 ELSE 0 END) AS pendiente,
            SUM(CASE WHEN a.id_micro = 3 AND a.id_temp = t.id_temp THEN 1 ELSE 0 END) AS aprobado,
            SUM(CASE WHEN a.id_micro = 2 AND a.id_temp = t.id_temp THEN 1 ELSE 0 END) AS correcion
            FROM tblasignar a
            JOIN (SELECT id_temp FROM tbltemporada WHERE YEAR = YEAR(CURRENT_DATE)) AS t
            GROUP BY t.id_temp;");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static public function mdlGetDatosInicioAño($anio)
    {

        $stmt = Conexion::ConexionDB()->prepare("SELECT 
            SUM(IF(a.id_temp = t.id_temp, 1, 0)) AS silabos,
            SUM(IF(a.id_micro = 1 AND a.id_temp = t.id_temp, 1, 0)) AS pendiente,
            SUM(IF(a.id_micro = 3 AND a.id_temp = t.id_temp, 1, 0)) AS aprobado,
            SUM(IF(a.id_micro = 2 AND a.id_temp = t.id_temp, 1, 0)) AS correcion
            FROM tblasignar a
            JOIN (SELECT id_temp FROM tbltemporada WHERE id_temp = :anio) AS t
            GROUP BY t.id_temp;");

        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static public function mdlGetGraficoMes($anio)
    {
        // var_dump($anio);

        $stmt = Conexion::ConexionDB()->prepare("SELECT CASE 
            WHEN a.capel = true THEN 'CAPEL'
            ELSE d.direccion
        END AS direccion,
        SUM(CASE WHEN fecha_entrega >= DATE(CONCAT(:anio, '-', EXTRACT(MONTH FROM CURRENT_DATE) - 1, '-01')) AND fecha_entrega < DATE(CONCAT(:anio1, '-', EXTRACT(MONTH FROM CURRENT_DATE), '-01')) THEN 1 ELSE 0 END) AS mesanterior,
        SUM(CASE WHEN fecha_entrega >= DATE(CONCAT(:anio3, '-', EXTRACT(MONTH FROM CURRENT_DATE), '-01')) AND fecha_entrega < DATE(CONCAT(:anio2, '-', EXTRACT(MONTH FROM CURRENT_DATE), '-01') + INTERVAL 1 MONTH) THEN 1 ELSE 0 END) AS mesactual
    FROM tblasignar a
    JOIN tblmaterias m ON a.id_materia = m.id_materia
    LEFT JOIN tbldireccion d ON m.id_direccion = d.id_direccion
    WHERE a.id_micro = 3  
        AND fecha_entrega >= DATE(CONCAT(:anio4, '-', EXTRACT(MONTH FROM CURRENT_DATE) - 1, '-01'))
        AND fecha_entrega < DATE(CONCAT(:anio5, '-', EXTRACT(MONTH FROM CURRENT_DATE), '-01') + INTERVAL 1 MONTH)
    GROUP BY CASE WHEN a.capel = true THEN 'CAPEL' ELSE d.direccion END;");

        $stmt->bindParam(":anio", $anio, PDO::PARAM_STR);
        $stmt->bindParam(":anio1", $anio, PDO::PARAM_STR);
        $stmt->bindParam(":anio2", $anio, PDO::PARAM_STR);
        $stmt->bindParam(":anio3", $anio, PDO::PARAM_STR);
        $stmt->bindParam(":anio4", $anio, PDO::PARAM_STR);
        $stmt->bindParam(":anio5", $anio, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static public function mdlGetTablaDoc($anio)
    {
        $stmt = Conexion::ConexionDB()->prepare("SELECT
        direccion,silabos,silabosc,silabosp,micros,microsc,microsp
    FROM (SELECT CASE WHEN a.capel = true THEN 'CAPEL' ELSE d.direccion END AS direccion,
            SUM(CASE WHEN a.id_doc = 2 AND a.id_micro = 3 THEN 1 ELSE 0 END) AS silabos,
            SUM(CASE WHEN a.id_doc = 1 AND a.id_micro = 3 THEN 1 ELSE 0 END) AS micros,
            SUM(CASE WHEN a.id_doc = 2 AND a.id_micro = 2 THEN 1 ELSE 0 END) AS silabosc,
            SUM(CASE WHEN a.id_doc = 1 AND a.id_micro = 2 THEN 1 ELSE 0 END) AS microsc,
            SUM(CASE WHEN a.id_doc = 2 AND a.id_micro = 1 THEN 1 ELSE 0 END) AS silabosp,
            SUM(CASE WHEN a.id_doc = 1 AND a.id_micro = 1 THEN 1 ELSE 0 END) AS microsp
        FROM tblasignar a
        JOIN tblmaterias m ON a.id_materia = m.id_materia
        JOIN tbldireccion d ON m.id_direccion = d.id_direccion
        JOIN tbltemporada t ON a.id_temp = t.id_temp AND t.year = :anio 
        GROUP BY
            CASE WHEN a.capel = true THEN 'CAPEL' ELSE d.direccion END
    ) AS subconsulta
    WHERE
        (silabos > 0 OR micros > 0 OR silabosc > 0 OR microsc > 0 OR silabosp > 0 OR microsp > 0);");
        
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static public function mdlGetGraficoAct($fecha_ini, $fecha_en, $fecha_fin)
    {
        $stmt = Conexion::ConexionDB()->prepare("SELECT 
        CASE 
            WHEN a.capel = true THEN 'CAPEL'
            ELSE d.direccion
        END AS direccion,
        SUM(CASE WHEN fecha_entrega >= :fecha_ini AND fecha_entrega < :fecha_en THEN 1 ELSE 0 END) AS mesanterior,
        SUM(CASE WHEN fecha_entrega >= :fecha_en1 AND fecha_entrega < :fecha_fin THEN 1 ELSE 0 END) AS mesactual
    FROM tblasignar a
    JOIN tblmaterias m ON a.id_materia = m.id_materia
    LEFT JOIN tbldireccion d ON m.id_direccion = d.id_direccion
    WHERE a.id_micro = 3 AND
        ((fecha_entrega >= :fecha_ini1 AND fecha_entrega < :fecha_en2) OR
        (fecha_entrega >= :fecha_en3 AND fecha_entrega < :fecha_fin1))
    GROUP BY CASE WHEN a.capel = true THEN 'CAPEL' ELSE d.direccion END;
    ");

        $stmt->bindParam(":fecha_ini", $fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_ini1", $fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_en", $fecha_en, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_en1", $fecha_en, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_en2", $fecha_en, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_en3", $fecha_en, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $fecha_fin, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin1", $fecha_fin, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    static public function mdlGetTablaMod()
    {

        $stmt = Conexion::ConexionDB()->prepare("SELECT m.nombre_materia, CONCAT(p.apellidos_profesor, ' ', p.nombres_profesor) as profesor, doc.documento, e.estado_micro
        FROM tblasignar a 
        JOIN tblmaterias m ON a.id_materia = m.id_materia
        JOIN tblprofesor p ON a.id_profesor=p.id_profesor
        JOIN tbldoc doc ON a.id_doc=doc.id_doc
        JOIN tblmicro e ON a.id_micro=e.id_micro
        WHERE a.id_micro=2 OR a.id_micro=3
        ORDER BY 
            a.time_mod DESC,
            a.time_mod IS NULL ASC
        LIMIT 10;");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
