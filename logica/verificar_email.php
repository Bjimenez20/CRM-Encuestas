<?php
ob_start();
require '../datos/conex.php';
header('Content-Type: application/json');
ob_clean();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'] ?? '';

    if (!empty($email)) {
        // Preparar la consulta
        $stmt = $conex->prepare("SELECT * FROM personas WHERE correo_electronico = ?");
        if ($stmt) {
            // Vincular el parámetro
            $stmt->bind_param('s', $email); // 's' indica tipo string
            $stmt->execute(); // Ejecutar la consulta
            $result = $stmt->get_result(); // Obtener el resultado

            if ($result->num_rows > 0) {
                $persona = $result->fetch_assoc(); // Obtener los datos
                echo json_encode([
                    'encontrado' => true,
                    'mensaje' => 'Correo electronico encontrado.',
                    'tipo' => 'success',
                    'persona' => $persona, // Puedes incluir los datos encontrados
                ]);
            } else {
                echo json_encode([
                    'encontrado' => false,
                    'mensaje' => 'Correo electronico no encontrado.',
                    'tipo' => 'error',
                ]);
            }
            $stmt->close(); // Cerrar el statement
        } else {
            echo json_encode([
                'encontrado' => false,
                'mensaje' => 'Error al preparar la consulta.',
                'tipo' => 'error',
            ]);
        }
    } else {
        echo json_encode([
            'encontrado' => false,
            'mensaje' => 'Correo electronico no válido.',
            'tipo' => 'error',
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode(['mensaje' => 'Método no permitido.']);
}
