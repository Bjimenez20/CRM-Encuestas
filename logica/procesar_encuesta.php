<?php
header('Content-Type: application/json');

require('../logica/session.php');
require('../datos/conex.php');

// Obtener los datos del formulario
$nombre = $_POST['nombre'] ?? '';
$apellidos = $_POST['apellidos'] ?? '';
$tipo_documento = $_POST['tipo_documento'] ?? '';
$numero_documento = $_POST['numero_documento'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$satisfaccion = $_POST['satisfaccion'] ?? '';
$recomendarias = $_POST['recomendarias'] ?? '';
$mejora = $_POST['mejora'] ?? '';
$contacto = isset($_POST['contacto']) ? 1 : 0;
$origen = isset($_POST['origen']) ? implode(',', $_POST['origen']) : '';

// Preparar la consulta para insertar los datos
$sql = "INSERT INTO encuestas (nombre_encuestado, tipo_documento_encuestado, numero_documento_encuestado, telefono_encuestado, direccion_encuestado, satisfaccion, recomendarias, mejora, contacto, origen) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conex->prepare($sql);

if (!$stmt) {
    echo json_encode(['error' => 'Error al preparar la consulta: ' . $conex->error]);
    exit;
}

// Bind de los parámetros: 's' para strings, 'i' para enteros.
$stmt->bind_param("ssssssssss", $nombre, $tipo_documento, $numero_documento, $telefono, $direccion, $satisfaccion, $recomendarias, $mejora, $contacto, $origen);

$response = [];
if ($stmt->execute()) {
    $response['success'] = 'Encuesta registrada con éxito';
} else {
    $response['error'] = 'Error al registrar la encuesta: ' . $stmt->error;
}

echo json_encode($response);

// Cerrar conexión
$stmt->close();
$conex->close();
