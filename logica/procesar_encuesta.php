<?php
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

print($respuesta_1);
print($persona);
print($cuestionarioSeleccionado);
// Validar que los datos necesarios están presentes
if (empty($persona) || empty($cuestionarioSeleccionado)) {
    echo json_encode(['error' => 'Faltan datos importantes para registrar la encuesta.']);
    exit;
}

// Preparar la consulta según el cuestionario seleccionado
switch ($cuestionarioSeleccionado) {
    case '1':
        $sql = "INSERT INTO respuestas (repuesta_1, repuesta_2, repuesta_3, id_persona_fk, id_cuestionarios_fk) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conex->prepare($sql);
        if (!$stmt) {
            echo json_encode(['error' => 'Error al preparar la consulta: ' . $conex->error]);
            exit;
        }
        $stmt->bind_param("sssss", $respuesta_1, $respuesta_2, $respuesta_3, $persona, $cuestionarioSeleccionado);
        break;

    case '2':
        $sql = "INSERT INTO respuestas (repuesta_1, repuesta_2, repuesta_3, id_persona_fk, id_cuestionarios_fk) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conex->prepare($sql);
        if (!$stmt) {
            echo json_encode(['error' => 'Error al preparar la consulta: ' . $conex->error]);
            exit;
        }
        $stmt->bind_param("sssss", $respuesta_1, $respuesta_4, $respuesta_5, $persona, $cuestionarioSeleccionado);
        break;

    case '3':
        $sql = "INSERT INTO respuestas (repuesta_1, repuesta_2, repuesta_3, repuesta_4, repuesta_5, id_persona_fk, id_cuestionarios_fk) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conex->prepare($sql);
        if (!$stmt) {
            echo json_encode(['error' => 'Error al preparar la consulta: ' . $conex->error]);
            exit;
        }
        $stmt->bind_param("sssssss", $respuesta_1, $respuesta_2, $respuesta_3, $respuesta_4, $respuesta_5, $persona, $cuestionarioSeleccionado);
        break;

    default:
        echo json_encode(['error' => 'Cuestionario seleccionado no válido.']);
        exit;
}

// Ejecutar la consulta
// $response = [];
// if ($stmt->execute()) {
//     $response['success'] = 'Encuesta registrada con éxito';
// } else {
//     $response['error'] = 'Error al registrar la encuesta: ' . $stmt->error;
// }

// // Respuesta de éxito o error
// echo json_encode($response);

// // Cerrar conexión
// $stmt->close();
// $conex->close();

if ($stmt->execute()) {
    echo json_encode([
        'status' => 'registrado',
        'tipo' => 'success',
        'mensaje' => 'Encuesta registrada con éxito'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'tipo' => 'error',
        'mensaje' => 'Error al registrar la encuesta: ' . $conex->error
    ]);
}
$stmt->close();

$conex->close();

