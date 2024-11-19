<?php
header('Content-Type: application/json');

require('../logica/session.php');
require('../datos/conex.php');

// Obtener los datos del formulario
$respuesta_1 = $_POST['respuesta_1'] ?? '';
$respuesta_2 = $_POST['respuesta_2'] ?? '';
$respuesta_3 = $_POST['respuesta_3'] ?? '';
$respuesta_4 = $_POST['respuesta_4'] ?? '';
$respuesta_5 = $_POST['respuesta_5'] ?? '';
$persona = $_POST['persona'] ?? '';
$cuestionarioSeleccionado = $_POST['cuestionarioSeleccionado'] ?? '';

// Preparar la consulta para insertar los datos
switch ($cuestionarioSeleccionado) {
    case '1':
        $sql = "INSERT INTO respuestas (repuesta_1, repuesta_2, repuesta_3, id_persona_fk, id_cuestionarios_fk) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conex->prepare($sql);

        if (!$stmt) {
            echo json_encode(['error' => 'Error al preparar la consulta: ' . $conex->error]);
            exit;
        }

        // Bind de los parámetros: 's' para strings, 'i' para enteros.
        $stmt->bind_param("sssss", $respuesta_1, $respuesta_2, $respuesta_3, $persona, $cuestionarioSeleccionado);
        break;
    case '2':
        $sql = "INSERT INTO respuestas (repuesta_1, repuesta_2, repuesta_3, id_persona_fk, id_cuestionarios_fk) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conex->prepare($sql);

        if (!$stmt) {
            echo json_encode(['error' => 'Error al preparar la consulta: ' . $conex->error]);
            exit;
        }

        // Bind de los parámetros: 's' para strings, 'i' para enteros.
        $stmt->bind_param("sssss", $respuesta_1, $respuesta_4, $respuesta_5, $persona, $cuestionarioSeleccionado);
        break;
    case '3';
        $sql = "INSERT INTO respuestas (repuesta_1, repuesta_2, repuesta_3, repuesta_4, repuesta_5, id_persona_fk, id_cuestionarios_fk) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conex->prepare($sql);

        if (!$stmt) {
            echo json_encode(['error' => 'Error al preparar la consulta: ' . $conex->error]);
            exit;
        }

        // Bind de los parámetros: 's' para strings, 'i' para enteros.
        $stmt->bind_param("sssssss", $respuesta_1, $respuesta_2, $respuesta_3, $respuesta_4, $respuesta_5, $persona, $cuestionarioSeleccionado);
}

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
