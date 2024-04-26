<?php
require_once "../utils/database/conexion.php";

class InformeModelo
{

    static public function mdlListarRangoFecha($fechaIni, $fechaFin, $id_direccion)
    {
        $stmt = Conexion::ConexionDB()->prepare("SELECT
        d.direccion, GROUP_CONCAT(CONCAT(n.nombre_nivel, ' EN ', c.nombre_carrera) SEPARATOR ', ') as carreras,
        m.nombre_materia,CONCAT(p.apellidos_profesor, ' ', p.nombres_profesor) as profesor,
        pe.semestre_modulo,h.horario,doc.documento,a.id_micro,a.fecha_entrega,t.year
    FROM tblasignar a
    JOIN tbldoc doc ON a.id_doc = doc.id_doc
    JOIN tblprofesor p ON a.id_profesor = p.id_profesor
    JOIN tblperiodo pe ON a.id_periodo = pe.id_periodo
    JOIN tblhorario h ON a.id_horario = h.id_horario
    JOIN tblmaterias m ON a.id_materia = m.id_materia
    JOIN tbltemporada t ON a.id_temp = t.id_temp
    JOIN tbldireccion d ON m.id_direccion = d.id_direccion
    JOIN tblmateria_carrera mc ON m.id_materia = mc.id_materia -- Tabla intermedia
    JOIN tblcarrera c ON mc.id_carrera = c.id_carrera
    JOIN tblnivel n ON c.id_nivel = n.id_nivel
    WHERE a.id_micro = 3 AND a.fecha_entrega >= :mes_ini
        AND a.fecha_entrega <= :mes_fin AND d.id_direccion = :id_direccion
    GROUP BY d.direccion,m.nombre_materia,p.apellidos_profesor,p.nombres_profesor,
        pe.semestre_modulo,h.horario,doc.documento,a.id_micro,a.fecha_entrega,t.year
    ORDER BY a.fecha_entrega;");

        $stmt->bindParam(":mes_ini", $fechaIni, PDO::PARAM_STR);
        $stmt->bindParam(":mes_fin", $fechaFin, PDO::PARAM_STR);
        $stmt->bindParam(":id_direccion", $id_direccion, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlListarRangoFechaCapel($fechaIni, $fechaFin)
    {
        $stmt = Conexion::ConexionDB()->prepare("SELECT
        d.direccion,GROUP_CONCAT(CONCAT(n.nombre_nivel, ' EN ', c.nombre_carrera) ORDER BY n.id_nivel SEPARATOR ', ') as carreras,
        m.nombre_materia,CONCAT(p.apellidos_profesor, ' ', p.nombres_profesor) as profesor,
        pe.semestre_modulo,h.horario,doc.documento,a.id_micro,a.fecha_entrega,t.year
    FROM tblasignar a
    JOIN tbldoc doc ON a.id_doc = doc.id_doc
    JOIN tblprofesor p ON a.id_profesor = p.id_profesor
    JOIN tblperiodo pe ON a.id_periodo = pe.id_periodo
    JOIN tblhorario h ON a.id_horario = h.id_horario
    JOIN tblmaterias m ON a.id_materia = m.id_materia
    JOIN tbltemporada t ON a.id_temp = t.id_temp
    JOIN tbldireccion d ON m.id_direccion = d.id_direccion
    JOIN tblmateria_carrera mc ON m.id_materia = mc.id_materia
    JOIN tblcarrera c ON mc.id_carrera = c.id_carrera
    JOIN tblnivel n ON c.id_nivel = n.id_nivel
    WHERE a.id_micro = 3 AND a.fecha_entrega >= :mes_ini
        AND a.fecha_entrega <= :mes_fin AND a.capel = true
    GROUP BY d.direccion, m.nombre_materia, p.apellidos_profesor,p.nombres_profesor,
        pe.semestre_modulo,h.horario,doc.documento,a.id_micro,a.fecha_entrega,t.year
    ORDER BY a.fecha_entrega;");

        $stmt->bindParam(":mes_ini", $fechaIni, PDO::PARAM_STR);
        $stmt->bindParam(":mes_fin", $fechaFin, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlDireccion($fechaIni, $fechaFin)
    {
        $c = Conexion::ConexionDB()->prepare("SELECT
        IF(a.capel, 12, d.id_direccion) AS id_direccion,
        IF(a.capel, 'CAPEL', d.direccion) AS direccion
    FROM tblasignar a
    JOIN tblmaterias m ON a.id_materia = m.id_materia
    JOIN tbldireccion d ON m.id_direccion = d.id_direccion
    WHERE a.id_micro = 3 AND a.fecha_entrega >= :fechaIni
        AND a.fecha_entrega <= :fechaFin
    GROUP BY a.capel, 
        IF(a.capel, 12, d.id_direccion),
        IF(a.capel, 'CAPEL', d.direccion)
    ORDER BY id_direccion;");

        $c->bindParam(":fechaIni", $fechaIni, PDO::PARAM_STR);
        $c->bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR);
        $c->execute();
        return $c->fetchAll();
    }

    static public function mdlGenerarGrafico($fechaIni, $fechaFin)
    {
        $c = Conexion::ConexionDB()->prepare("SELECT 
        CASE WHEN a.capel = true THEN 'CAPEL' ELSE d.direccion END AS direccion,
        SUM(a.id_doc = 2) AS silabos,
        SUM(a.id_doc = 1) AS micros
    FROM tblasignar a
    JOIN tblmaterias m ON a.id_materia = m.id_materia
    LEFT JOIN tbldireccion d ON m.id_direccion = d.id_direccion
    WHERE a.id_micro = 3 
        AND fecha_entrega >= :fechaIni 
        AND fecha_entrega <= :fechaFin
    GROUP BY CASE WHEN a.capel = true THEN 'CAPEL' ELSE d.direccion END;");

        $c->bindParam(":fechaIni", $fechaIni, PDO::PARAM_STR);
        $c->bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR);
        $c->execute();

        return $c->fetchAll();
    }

    static public function mdlListarInforme($anio)
    {
        $stmt = Conexion::ConexionDB()->prepare("SELECT 
        CASE WHEN a.capel THEN 'CAPEL' ELSE d.direccion END AS direccion,
        GROUP_CONCAT(c.nombre_carrera ORDER BY c.id_carrera SEPARATOR ', ') AS carreras,
        m.nombre_materia,
        CONCAT(p.apellidos_profesor, ' ', p.nombres_profesor) AS profesor,
        pe.semestre_modulo,
        h.horario,
        doc.documento,
        a.id_micro,
        DATE_FORMAT(a.fecha_entrega, '%d-%m-%Y') AS fecha_entrega
    FROM tblasignar a
    JOIN tbldoc doc ON a.id_doc = doc.id_doc
    JOIN tblprofesor p ON a.id_profesor = p.id_profesor
    JOIN tblperiodo pe ON a.id_periodo = pe.id_periodo
    JOIN tblhorario h ON a.id_horario = h.id_horario
    JOIN tblmaterias m ON a.id_materia = m.id_materia
    JOIN tbldireccion d ON m.id_direccion = d.id_direccion
    JOIN tblmateria_carrera mc ON m.id_materia = mc.id_materia
    JOIN tblcarrera c ON mc.id_carrera = c.id_carrera
    WHERE a.id_micro = 3 AND YEAR(a.fecha_entrega) = :anio
    GROUP BY 
        CASE WHEN a.capel THEN 'CAPEL' ELSE d.direccion END,
        m.nombre_materia,
        p.apellidos_profesor,
        p.nombres_profesor,
        pe.semestre_modulo,
        h.horario,
        doc.documento,
        a.id_micro,
        a.fecha_entrega
    ORDER BY 
        CASE WHEN a.capel THEN 'CAPEL' ELSE d.direccion END,
        a.fecha_entrega; ");

        $stmt->bindParam(":anio", $anio, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();

    }

    static public function mdlListarInformeAnio($mes_ini, $mes_fin)
    {

        $stmt = Conexion::ConexionDB()->prepare("SELECT 
        CASE WHEN a.capel THEN 'CAPEL' ELSE d.direccion END AS direccion,
        GROUP_CONCAT(c.nombre_carrera ORDER BY c.id_carrera SEPARATOR ', ') AS carreras,
        m.nombre_materia,CONCAT(p.apellidos_profesor, ' ', p.nombres_profesor) AS profesor,
        pe.semestre_modulo,h.horario,doc.documento,a.id_micro,
        DATE_FORMAT(a.fecha_entrega, '%d-%m-%Y') AS fecha_entrega
    FROM tblasignar a
    JOIN tbldoc doc ON a.id_doc = doc.id_doc
    JOIN tblprofesor p ON a.id_profesor = p.id_profesor
    JOIN tblperiodo pe ON a.id_periodo = pe.id_periodo
    JOIN tblhorario h ON a.id_horario = h.id_horario
    JOIN tblmaterias m ON a.id_materia = m.id_materia
    JOIN tbltemporada t ON a.id_temp = t.id_temp
    JOIN tbldireccion d ON m.id_direccion = d.id_direccion
    JOIN tblmateria_carrera mc ON m.id_materia = mc.id_materia
    JOIN tblcarrera c ON mc.id_carrera = c.id_carrera
    WHERE 
        a.id_micro = 3 
        AND a.fecha_entrega >= STR_TO_DATE(:mes_ini, '%d-%m-%Y')
        AND a.fecha_entrega < STR_TO_DATE(:mes_fin, '%d-%m-%Y')
    GROUP BY
        CASE WHEN a.capel THEN 'CAPEL' ELSE d.direccion END,m.nombre_materia,
        p.apellidos_profesor,p.nombres_profesor,pe.semestre_modulo,
        h.horario,doc.documento,a.id_micro,DATE_FORMAT(a.fecha_entrega, '%d-%m-%Y')
    ORDER BY a.fecha_entrega;");

        $stmt->bindParam(":mes_ini", $mes_ini, PDO::PARAM_STR);
        $stmt->bindParam(":mes_fin", $mes_fin, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlObtenerConfig(){
        $c = Conexion::ConexionDB()->prepare("SELECT aprobadopor, elaboradopor, cargoaprobado, cargoelaborado FROM tblconfiguracion");
        
        $c -> execute();

        return $c ->fetchAll();
        
    }
    
}
