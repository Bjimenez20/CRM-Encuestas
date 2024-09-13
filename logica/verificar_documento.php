<?php
header('Content-Type: application/json');

require('../logica/session.php');
require('../datos/conex.php');


$data = json_decode(file_get_contents('php://input'), true);
$documento = $data['documento'];

// Consultar en la base de datos
$sql = "SELECT nombre, apellido, tipo_documento, numero_documento, telefono, direccion FROM personas WHERE numero_documento = ?";
$stmt = $conex->prepare($sql);

if (!$stmt) {
    echo json_encode(['error' => 'Error al preparar la consulta: ' . $conex->error]);
    exit;
}

$stmt->bind_param("s", $documento);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontró el documento
if ($result->num_rows > 0) {
    // Documento encontrado
    $data = $result->fetch_assoc();
    echo json_encode(['encontrado' => true, 'datos' => $data]);
} else {
    // Documento no encontrado
    echo json_encode(['encontrado' => false]);
}

// Cerrar conexión
$stmt->close();
$conex->close();
