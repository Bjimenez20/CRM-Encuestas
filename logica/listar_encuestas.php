<?php
require('../logica/session.php');
require('../datos/conex.php');

// Consulta para obtener los datos de la tabla "usuarios"
$sql = "SELECT r.id AS id_res, r.*, c.nombre_encuesta, p.nombre, p.apellido  FROM `respuestas` r INNER JOIN `cuestionarios` c ON c.id = r.id_cuestionarios_fk 
INNER JOIN `personas` p ON p.id = r.id_persona_fk";
$result = $conex->query($sql);

// Convertir los datos a formato JSON
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Enviar los datos en formato JSON
echo json_encode(['data' => $data]);

$conex->close();
