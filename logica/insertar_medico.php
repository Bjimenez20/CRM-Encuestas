<?php
// Incluye la conexión a la base de datos
include('../datos/conex.php');

// Obtener los datos enviados desde Axios
$data = json_decode(file_get_contents('php://input'), true);

// Validar que los campos obligatorios estén presentes
if (empty($data['nombre_medico']) || empty($data['correo']) || empty($data['telefono1'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Todos los campos marcados con * son obligatorios.'
    ]);
    exit;
}

// Escapar los datos para prevenir inyección SQL
$nombre_medico = $conex->real_escape_string($data['nombre_medico']);
$apellido_medico = $conex->real_escape_string($data['apellido_medico']);
$correo = $conex->real_escape_string($data['correo']);
$telefono1 = $conex->real_escape_string($data['telefono1']);
$telefono2 = !empty($data['telefono2']) ? $conex->real_escape_string($data['telefono2']) : null;
$telefono3 = !empty($data['telefono3']) ? $conex->real_escape_string($data['telefono3']) : null;
$telefono4 = !empty($data['telefono4']) ? $conex->real_escape_string($data['telefono4']) : null;

// Preparar la consulta SQL con un statement preparado (más seguro y eficiente)
$stmt = $conex->prepare("INSERT INTO personas (nombre, apellido, correo_electronico, telefono1, telefono2, telefono3, telefono4) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");

// Vincular los parámetros
$stmt->bind_param('sssssss', $nombre_medico, $apellido_medico, $correo, $telefono1, $telefono2, $telefono3, $telefono4);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'El médico fue registrado exitosamente.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error al registrar el médico: ' . $stmt->error
    ]);
}

// Cerrar la conexión y el statement
$stmt->close();
$conex->close();
