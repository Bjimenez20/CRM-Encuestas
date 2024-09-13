<?php
require('../logica/session.php');
require('../datos/conex.php');

// Consulta para obtener los datos de la tabla "usuarios"
$sql = "SELECT * FROM encuestas";
$result = $conex->query($sql);

// Convertir los datos a formato JSON
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Enviar los datos en formato JSON
echo json_encode(['data' => $data]);

$conex->close();
