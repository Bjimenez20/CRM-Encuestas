<?php
require '../datos/conex.php';


$nombre = $_POST['nombre'] ?? '';
$apellidos = $_POST['apellidos'] ?? '';
$tipo_documento = $_POST['tipo_documento'] ?? '';
$numero_documento = $_POST['numero_documento'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$direccion = $_POST['direccion'] ?? '';

$query = "INSERT INTO personas (nombre, apellido, tipo_documento, numero_documento, telefono, direccion) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conex->prepare($query);
$stmt->bind_param("ssssss", $nombre, $apellidos, $tipo_documento, $numero_documento, $telefono, $direccion);

if ($stmt->execute()) {
    echo json_encode([
        'status' => 'registrado',
        'tipo' => 'success',
        'mensaje' => 'Usuario registrado exitosamente'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'tipo' => 'error',
        'mensaje' => 'Error en la base de datos: ' . $conex->error
    ]);
}
$stmt->close();

$conex->close();
