<?php
require '../datos/conex.php';  // Conexión a la base de datos

// Verifica la conexión
if (!$conex) {
    die('Error de conexión: ' . mysqli_connect_error());
}

$email = $_GET['email'] ?? null;

// Verifica si el parámetro 'documento' está presente y no está vacío
if (empty($email)) {
    die('El parámetro correo electronico está vacío o no se ha proporcionado.');
}

// Sanitiza el parámetro 'documento' para evitar inyecciones SQL
$email = mysqli_real_escape_string($conex, $email);

// Inicializa variables para evitar errores si no se encuentra el documento
$persona = [
    'id' => '',
    'nombre_completo' => '',
    'telefono1' => '',
    'telefono2' => '',
    'correo_electronico' => '',
    'especialidad' => ''
];

// Prepara la consulta SQL
$stmt = $conex->prepare("SELECT * FROM personas WHERE correo_electronico = ?");
if (!$stmt) {
    die('Error en la preparación de la consulta: ' . $conex->error);
}

// Enlaza el parámetro
$stmt->bind_param('s', $email); // 's' indica que el parámetro es una cadena
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $persona = $result->fetch_assoc();
}

$stmt->close();

// Retorna los datos obtenidos
return $persona;
