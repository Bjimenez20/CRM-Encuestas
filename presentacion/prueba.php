<?php
require '../datos/conex.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Encuesta de Satisfacción</h1>

        <!-- Formulario para consultar documento -->
        <form id="formConsulta" class="mb-4">
            <div class="mb-3">
                <label for="documento" class="form-label">Número de Documento</label>
                <input type="text" class="form-control" id="documento" required>
            </div>
            <button type="submit" id="btnConsultar" class="btn btn-primary">Consultar Documento</button>
        </form>

        <!-- Selección de cuestionario -->
        <div id="seleccionCuestionario" style="display: none;" class="mb-4">
            <label for="cuestionario" class="form-label">Selecciona un Cuestionario:</label>
            <select id="cuestionario" class="form-select" required>
                <option value="" disabled selected>Seleccione un cuestionario</option>
                <?php
                $select_cu = mysqli_query($conex, "SELECT * FROM cuestionarios");
                while ($fila_cu = mysqli_fetch_array($select_cu)) {
                ?>
                    <option value="<?php echo $fila_cu['id'] ?>"><?php echo $fila_cu['nombre_encuesta'] ?></option>
                <?php
                }
                ?>
            </select>
            <button id="btnHabilitarEncuesta" class="btn btn-success mt-3" disabled>Habilitar Encuesta</button>
        </div>

        <!-- Formulario de registro de nuevo usuario -->
        <form id="formRegistro" style="display: none;">
            <h3>Registro de Usuario</h3>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombreRegistro" required>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidosRegistro" required>
            </div>
            <div class="mb-3">
                <label for="numero_documento" class="form-label">Número de Documento</label>
                <input type="text" class="form-control" id="documentoRegistro" required>
            </div>
            <button type="submit" class="btn btn-success">Registrar</button>
        </form>

        <!-- Formulario de encuesta -->
        <form id="formEncuesta" style="display: none;">
            <h3>Encuesta</h3>
            <p>Complete las preguntas seleccionadas.</p>
            <!-- Preguntas de ejemplo -->
            <div class="mb-3">
                <label>1. ¿Cómo califica nuestro servicio?</label>
                <select class="form-select" required>
                    <option value="excelente">Excelente</option>
                    <option value="bueno">Bueno</option>
                    <option value="regular">Regular</option>
                    <option value="malo">Malo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Encuesta</button>
        </form>
    </div>

    <script>
        const formConsulta = document.getElementById('formConsulta');
        const formRegistro = document.getElementById('formRegistro');
        const seleccionCuestionario = document.getElementById('seleccionCuestionario');
        const formEncuesta = document.getElementById('formEncuesta');
        const btnHabilitarEncuesta = document.getElementById('btnHabilitarEncuesta');
        const cuestionarioSelect = document.getElementById('cuestionario');
        const btnConsultar = document.getElementById('btnConsultar');

        // Función para alternar la visibilidad de las secciones
        function toggleSection(section, show) {
            section.style.display = show ? 'block' : 'none';
        }

        // Función para mostrar las alertas
        function showAlert(icon, title, text) {
            Swal.fire({
                icon: icon,
                title: title,
                text: text
            });
        }

        // Manejo de la consulta del documento
        formConsulta.addEventListener('submit', function(e) {
            e.preventDefault();
            const documento = document.getElementById('documento').value;

            axios.post('../logica/verificar_documento.php', {
                    documento
                })
                .then(response => {
                    if (response.data.encontrado) {
                        // Documento encontrado
                        const datos = response.data.datos;
                        document.getElementById('nombre').value = datos.nombre || '';
                        document.getElementById('apellidos').value = datos.apellido || '';
                        document.getElementById('tipo_documento').value = datos.tipo_documento || '';
                        document.getElementById('numero_documento').value = datos.numero_documento || '';
                        document.getElementById('telefono').value = datos.telefono || '';
                        document.getElementById('direccion').value = datos.direccion || '';
                        document.getElementById('cuestionario').addEventListener('change', function() {
                            // Obtén el valor del cuestionario seleccionado
                            const cuestionarioId = this.value; // ID del cuestionario
                            const cuestionarioTexto = this.options[this.selectedIndex].text; // Texto visible del cuestionario

                            // Muestra el texto del cuestionario seleccionado en el input
                            document.getElementById('cuestionarioSeleccionado').value = cuestionarioId;

                            // Después de seleccionar el cuestionario, habilitar los formularios
                            toggleSection(formRegistro, true);
                            toggleSection(formEncuesta, true);
                            toggleSection(formConsulta, false);
                        });

                        document.getElementById('persona').value = datos.id || '';

                        toggleSection(formConsulta, false);
                        toggleSection(seleccionCuestionario, true);

                        showAlert('success', 'Documento encontrado', 'Selecciona un cuestionario para continuar.');
                    } else {
                        // Documento no encontrado
                        toggleSection(formConsulta, false);
                        toggleSection(formRegistro, true);

                        showAlert('error', 'Documento no encontrado', 'El número de documento no está registrado.');
                    }
                })
                .catch(() => {
                    showAlert('error', 'Error', 'Ocurrió un problema al verificar el documento.');
                });
        });

        // Manejo del formulario de encuesta
        formEncuesta.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(formEncuesta);

            axios.post('../logica/procesar_encuesta.php', formData)
                .then(response => {
                    if (response.data.success) {
                        showAlert('success', 'Encuesta registrada', response.data.success);
                        // Redirigir o realizar alguna acción adicional
                    } else {
                        showAlert('error', 'Error', response.data.error || 'No se pudo registrar la encuesta.');
                    }
                })
                .catch(error => {
                    showAlert('error', 'Error', 'Ocurrió un problema al registrar la encuesta.');
                });
        });
    </script>
</body>

</html>