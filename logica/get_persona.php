<?php
require '../datos/conex.php';  // Conexión a la base de datos

// Verifica la conexión
if (!$conex) {
    die('Error de conexión: ' . mysqli_connect_error());
}

$documento = $_GET['documento'] ?? null;

// Verifica si el parámetro 'documento' está presente y no está vacío
if (empty($documento)) {
    die('El parámetro documento está vacío o no se ha proporcionado.');
}

// Sanitiza el parámetro 'documento' para evitar inyecciones SQL
$documento = mysqli_real_escape_string($conex, $documento);

// Inicializa variables para evitar errores si no se encuentra el documento
$persona = [
    'id' => '',
    'nombre' => '',
    'apellido' => '',
    'correo_electronico' => '',
    'telefono1' => '',
    'telefono2' => '',
    'telefono3' => '',
    'telefono4' => ''
];

// Prepara la consulta SQL
$stmt = $conex->prepare("SELECT * FROM personas WHERE telefono1 = ? OR telefono2 = ? OR telefono3 = ? OR telefono4 = ?");
if (!$stmt) {
    die('Error en la preparación de la consulta: ' . $conex->error);
}

// Enlaza el parámetro
$stmt->bind_param('ssss', $documento, $documento, $documento, $documento); // 's' indica que el parámetro es una cadena
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $persona = $result->fetch_assoc();
}

$stmt->close();

// Retorna los datos obtenidos
return $persona;
