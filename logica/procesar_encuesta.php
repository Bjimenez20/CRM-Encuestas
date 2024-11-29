<?php
require('../logica/session.php');
require('../datos/conex.php');

$respuesta_1 = $_POST['respuesta_1'] ?? '';
$respuesta_2 = $_POST['respuesta_2'] ?? '';
$respuesta_3 = $_POST['respuesta_3'] ?? '';
$respuesta_4 = $_POST['respuesta_4'] ?? '';
$respuesta_5 = $_POST['respuesta_5'] ?? '';
$encuesta = $_POST['encuesta_efectiva'] ?? '';
$persona = $_POST['medico_id'] ?? '';
$cuestionarioSeleccionado = $_POST['cuestionarioselect'] ?? '';
$motivo_no_encuesta = $_POST['motivo_no_encuesta'] ?? '';
$nota = $_POST['nota'] ?? '';

if ($encuesta == 'SI') {
    switch ($cuestionarioSeleccionado) {
        case '1':
            $sql = "INSERT INTO respuestas (repuesta_1, repuesta_2, repuesta_3, id_persona_fk, id_cuestionarios_fk, encuesta_efectiva) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conex->prepare($sql);
            if (!$stmt) {
                echo json_encode(['error' => 'Error al preparar la consulta: ' . $conex->error]);
                exit;
            }
            $stmt->bind_param("ssssss", $respuesta_1, $respuesta_2, $respuesta_3, $persona, $cuestionarioSeleccionado, $encuesta);
            break;

        case '2':
            $sql = "INSERT INTO respuestas (repuesta_1, repuesta_2, repuesta_3, id_persona_fk, id_cuestionarios_fk, encuesta_efectiva) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conex->prepare($sql);
            if (!$stmt) {
                echo json_encode(['error' => 'Error al preparar la consulta: ' . $conex->error]);
                exit;
            }
            $stmt->bind_param("ssssss", $respuesta_1, $respuesta_4, $respuesta_5, $persona, $cuestionarioSeleccionado, $encuesta);
            break;

        case '3':
            $sql = "INSERT INTO respuestas (repuesta_1, repuesta_2, repuesta_3, repuesta_4, repuesta_5, id_persona_fk, id_cuestionarios_fk, encuesta_efectiva) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conex->prepare($sql);
            if (!$stmt) {
                echo json_encode(['error' => 'Error al preparar la consulta: ' . $conex->error]);
                exit;
            }
            $stmt->bind_param("ssssssss", $respuesta_1, $respuesta_2, $respuesta_3, $respuesta_4, $respuesta_5, $persona, $cuestionarioSeleccionado, $encuesta);
            break;

        default:
            echo json_encode(['error' => 'Cuestionario seleccionado no válido.']);
            exit;
    }
} else {

    $sql = "INSERT INTO respuestas (id_persona_fk, encuesta_efectiva, motivo_no_encuesta, nota) VALUES (?, ?, ?, ?)";
    $stmt = $conex->prepare($sql);
    if (!$stmt) {
        echo json_encode(['error' => 'Error al preparar la consulta: ' . $conex->error]);
        exit;
    }
    $stmt->bind_param("ssss", $persona, $encuesta, $motivo_no_encuesta, $nota);
}

$response = [];
if ($stmt->execute()) {
    $response['success'] = 'Encuesta registrada con éxito';
} else {
    $response['error'] = 'Error al registrar la encuesta: ' . $stmt->error;
}

echo json_encode($response);

$stmt->close();
$conex->close();
