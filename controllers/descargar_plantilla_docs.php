<?php
$archivo_ejemplo = '../formatos/FORMATO PARA CARGAR DOCUMENTOS.xlsx';

header('Content-Description: File Transfer');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Formato para documentos.xlsx"');
header('Content-Length: ' . filesize($archivo_ejemplo));
readfile($archivo_ejemplo);
exit;

