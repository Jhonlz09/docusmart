<?php
require_once "../utils/database/conexion.php";

use PhpOffice\PhpSpreadsheet\Calculation\TextData\Trim;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Exception as SpreadsheetException;


class SilabosModelo
{

    static public function mdlCargaMasiva($fileSilabos)
    {
        $resultados = [];
        $silabosRegistrados = 0;
        $CedulasNoRegistradas = [];
        $MateriasNoRegistradas = [];
        $PeriodoNoRegistrado = [];
        $HorarioNoRegistrado = 0;
        try {

            $documento = IOFactory::load($fileSilabos['tmp_name'])->getSheet(0);
            $numeroFilasSilabos = $documento->getHighestDataRow();
            $silabosRepetidos = 0;
            $silabosVacios = 0;
            $silabosVacios = 0;
            $silabosIncorrectos = 0;
            $silabosNoRegistrados = 0;
            //CICLO FOR PARA REGISTROS DE SILABOS
            for ($i = 3; $i <= $numeroFilasSilabos; $i++) {
                try {
                    $cedula = trim($documento->getCell("A" . $i)->getValue());
                    $codigo = strtoupper(trim($documento->getCell("B" . $i)->getValue()));
                    $semestre = strtoupper(trim($documento->getCell("C" . $i)->getValue()));

                    $id_profesor = self::mdlObtenerId('tblprofesor', 'cedula', 'id_profesor', $cedula);
                    if ($id_profesor == null && !empty($cedula)) {
                        $CedulasNoRegistradas[] = $cedula;
                    }
                    $id_materia = self::mdlObtenerId('tblmaterias', 'codigo_materia', 'id_materia', $codigo);
                    if ($id_materia == null && !empty($codigo)) {
                        $MateriasNoRegistradas[] = $codigo;
                    }
                    $id_periodo = self::mdlObtenerId('tblperiodo', 'semestre_modulo', 'id_periodo', $semestre);
                    if ($id_periodo == null && !empty($semestre)) {
                        $PeriodoNoRegistrado[] = $semestre;
                    }
                    $id_horario = trim($documento->getCell("D" . $i)->getValue());
                    $id_horario_entero = intval($id_horario);
                    if ($id_horario_entero >= 1 && $id_horario_entero <= 4) {
                    } else {
                        $HorarioNoRegistrado++;
                    }
                    
                    $id_temp = self::mdlBuscarIdAnio();
                    $stmt = Conexion::ConexionDB()->prepare("INSERT INTO tblasignar(id_profesor, id_materia, id_periodo, id_horario, id_temp)
                            VALUES (:id_profesor, :id_materia, :id_periodo, :id_horario, :id_temp)");
                    $stmt->bindParam(":id_profesor", $id_profesor, PDO::PARAM_INT);
                    $stmt->bindParam(":id_materia", $id_materia, PDO::PARAM_INT);
                    $stmt->bindParam(":id_periodo", $id_periodo, PDO::PARAM_INT);
                    $stmt->bindParam(":id_horario", $id_horario, PDO::PARAM_STR);
                    $stmt->bindParam(":id_temp", $id_temp[0], PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        $silabosRegistrados++;
                    }
                } catch (PDOException $e) {
                    if ($e->getCode() == '23000' || $e->getCode() == '1062') {
                        $silabosRepetidos++;
                    } else if ($e->getCode() == '') {
                        $silabosVacios++;
                    } else {
                        $silabosIncorrectos++;
                    }
                    $silabosNoRegistrados++;
                }
            }
            $resultados = [
                'silabosRegistrados' => $silabosRegistrados,
                'silabosNoRegistrados' => $silabosNoRegistrados,
                'silabosRepetidos' => $silabosRepetidos,
                'silabosVacios' => $silabosVacios,
                'silabosIncorrectos' => $silabosIncorrectos,
                'CedulasNoRegistradas' => $CedulasNoRegistradas,
                'MateriasNoRegistradas' => $MateriasNoRegistradas,
                'PeriodoNoRegistrado' => $PeriodoNoRegistrado,
                'HorarioNoRegistrado' => $HorarioNoRegistrado
            ];
            return $resultados;
        } catch (SpreadsheetException $exception) {

            return $resultados;
        }
    }

    static private function mdlObtenerId($tabla, $campoBusqueda, $campoId, $valor)
    {
        if (empty($valor)) {
            return '';
        }
        $stmt = Conexion::ConexionDB()->prepare("SELECT $campoId FROM $tabla WHERE $campoBusqueda = :valor");
        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
        // Verificar si $stmt->execute() se ejecuta correctamente
        if ($stmt->execute()) {
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si fetch devolvió un resultado antes de acceder a $campoId
            if ($resultado !== false && isset($resultado[$campoId])) {
                return $resultado[$campoId];
            }
        }
        // Si no se cumple ninguna condición anterior, devolver un valor predeterminado
        return null;
    }

    static public function mdlBuscarIdHorario($horario)
    {

        $stmt = Conexion::ConexionDB()->prepare("SELECT id_horario FROM tblhorario WHERE horario = :horario");
        $stmt->bindParam(":horario", $horario, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }
    static public function mdlBuscarIdAnio()
    {

        $stmt = Conexion::ConexionDB()->prepare("SELECT id_temp FROM tbltemporada WHERE YEAR = YEAR(CURRENT_DATE);");

        $stmt->execute();

        return $stmt->fetch();
    }
    static public function mdlListarSilabos($anio)
    {
        $stmt = Conexion::ConexionDB()->prepare("SELECT a.id_asignacion,
        GROUP_CONCAT(c.nombre_carrera ORDER BY c.nombre_carrera SEPARATOR ', ') as carreras,
        m.nombre_materia,CONCAT(p.nombres_profesor, ' ', p.apellidos_profesor) as profesor,
        h.horario,doc.documento,a.id_micro,CASE WHEN a.capel = true THEN 'CAPEL' ELSE d.direccion END as direccion,
        a.id_periodo,'' as acciones,a.comentario,m.id_materia,p.id_profesor,h.id_horario,
        doc.id_doc,a.capel, a.id_drive
    FROM tblasignar a
        JOIN tbldoc doc ON a.id_doc = doc.id_doc
        JOIN tblprofesor p ON a.id_profesor = p.id_profesor
        JOIN tblhorario h ON a.id_horario = h.id_horario
        JOIN tblmaterias m ON a.id_materia = m.id_materia
        JOIN tbltemporada t ON a.id_temp = t.id_temp AND t.year = :anio
        JOIN tbldireccion d ON m.id_direccion = d.id_direccion
        JOIN tblmateria_carrera mc ON m.id_materia = mc.id_materia
        JOIN tblcarrera c ON mc.id_carrera = c.id_carrera
    GROUP BY
        a.id_asignacion,m.id_materia,m.nombre_materia,p.id_profesor,profesor,
        h.id_horario,h.horario,doc.documento,a.id_micro,doc.id_doc,a.comentario,d.direccion,
        a.capel,a.id_periodo
    ORDER BY
        CASE
            WHEN a.capel = true THEN 'CAPEL'
            ELSE d.direccion END;");

        $stmt->bindParam(":anio", $anio, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlCambiarEstadoSilabos($id, $estado, $fecha_actual)
    {
        try {
            $stmt = Conexion::ConexionDB()->prepare("UPDATE tblasignar SET fecha_entrega='" . $fecha_actual . "', id_micro=" . $estado . ", time_mod=CURRENT_TIMESTAMP  WHERE id_asignacion =" . $id);

            if ($stmt->execute()) {
                $resultado = "ok";
            } else {
                $resultado = "error";
            }
        } catch (Exception $e) {
            $resultado = 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }

        return $resultado;
    }

    static public function mdlAgregarSilabos($id_profesor, $id_materia, $id_horario, $id_periodo, $id_doc, $id_anio, $capel, $id_drive)
    {
        try {
            $conn = Conexion::ConexionDB();
            $stmt = $conn->prepare("INSERT INTO tblasignar (capel, id_profesor, id_materia, id_horario, id_periodo, id_doc, id_temp, fecha_entrega, id_drive) 
                                        VALUES (:capel, :id_profesor, :id_materia, :id_horario, :id_periodo, :id_doc, :id_anio, CURRENT_DATE, :id_drive)");

            $stmt->bindParam(':capel', $capel, PDO::PARAM_BOOL);
            $stmt->bindParam(':id_profesor', $id_profesor, PDO::PARAM_INT);
            $stmt->bindParam(':id_materia', $id_materia, PDO::PARAM_INT);
            $stmt->bindParam(':id_horario', $id_horario, PDO::PARAM_INT);
            $stmt->bindParam(':id_periodo', $id_periodo, PDO::PARAM_INT);
            $stmt->bindParam(':id_doc', $id_doc, PDO::PARAM_INT);
            $stmt->bindParam(':id_anio', $id_anio, PDO::PARAM_INT);
            $stmt->bindParam(':id_drive', $id_drive, PDO::PARAM_STR);


            if ($stmt->execute()) {
                $resultado = "ok";
            } else {
                $resultado = "error";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == '1062') {
                // Mensaje de error personalizado
                $resultado = 'V';
            } else {
                // Manejo de otras excepciones
                $resultado = 'Error: ' . $e->getMessage();
            }
        }
        return $resultado;
    }

    static public function mdlEditarSilabos($id_asignacion, $id_profesor, $id_materia, $id_horario, $id_periodo, $id_doc, $comentario, $id_año, $capel)
    {
        try {
            $stmt = Conexion::ConexionDB()->prepare("UPDATE tblasignar
                                                SET id_profesor=" . $id_profesor . ", 
                                                    id_materia=" . $id_materia . ", 
                                                    id_periodo=" . $id_periodo . ", 
                                                    id_horario=" . $id_horario . ", 
                                                    id_doc=" . $id_doc . ",
                                                    id_temp=" . $id_año . ",
                                                    capel=" . $capel . ",
                                                    comentario=:comentario
                                                    WHERE id_asignacion=" . $id_asignacion . ";");
            $stmt->bindParam(":comentario", $comentario, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $resultado = "ok";
            } else {
                $resultado = "error";
            }
        } catch (PDOException $e) {
            $resultado =  'V';
        }
        return $resultado;
    }

    static public function mdlEliminarSilabos($id)
    {

        $stmt = Conexion::ConexionDB()->prepare("DELETE FROM tblasignar WHERE id_asignacion=" . $id);

        if ($stmt->execute()) {
            return 'El silabo se eliminó correctamente';
        } else {
            return 'Error, no se pudo eliminar la materia';
        }
    }
}
