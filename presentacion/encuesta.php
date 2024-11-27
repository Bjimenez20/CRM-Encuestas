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

        <!-- Formulario de registro -->
        <form id="formRegistro" style="display: none;">
            <div class="row mb-3">
                <div class="col">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre">
                </div>
                <div class="col">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                    <input type="text" class="form-control" name="tipo_documento" id="tipo_documento">
                </div>
                <div class="col">
                    <label for="numero_documento" class="form-label">Número de Documento</label>
                    <input type="text" class="form-control" name="numero_documento" id="numero_documento">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" id="telefono">
                </div>
                <div class="col">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" name="direccion" id="direccion">
                </div>
            </div>
            <div id="btnRegistrar" style="display: none;">
                <button type="submit" class="btn btn-success">Registrar</button>
            </div>
        </form>
        <!-- Formulario de encuesta -->
        <form id="formEncuesta" style="display: none;">
            <hr>
            <div class="row mb-3" style="display: none;">
                <div class="col">
                    <label for="persona" class="form-label">Persona</label>
                    <input type="text" class="form-control" name="persona" id="persona">
                </div>
                <div class="col">
                    <label for="cuestionarioSeleccionado" class="form-label">Cuestionario</label>
                    <input type="text" class="form-control" name="cuestionarioSeleccionado" id="cuestionarioSeleccionado">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">1. De los pacientes que atiende en una semana, ¿Cuántos de ellos tienen Diabetes Mellitus Tipo 2?</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="De1a20" name="respuesta_1" value="De 1 a 20">
                    <label class="form-check-label" for="De1a20">De 1 a 20</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="De21a20" name="respuesta_1" value="De 21 a 40">
                    <label class="form-check-label" for="De21a20">De 21 a 40</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="De41a60" name="respuesta_1" value="De 41 a 60">
                    <label class="form-check-label" for="De41a60">De 41 a 60</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="Masde60" name="respuesta_1" value="Mas de 60">
                    <label class="form-check-label" for="Masde60">Más de 60</label>
                </div>
            </div>
            <div id="1" style="display: none;">
                <!-- Pregunta 2 -->
                <div class="mb-3">
                    <label class="form-label">2. De estos pacientes con Diabetes Mellitus Tipo 2, ¿a cuántos les formuló un GLP-1 inyectable u oral?</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_2" value="Ninguno">
                        <label class="form-check-label" for="Ninguno">Ninguno</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De1a2" name="respuesta_2" value="De 1 a 2">
                        <label class="form-check-label" for="De1a2">De 1 a 2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De3a5" name="respuesta_2" value="De 3 a 5">
                        <label class="form-check-label" for="De3a5">De 3 a 5</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Masde6" name="respuesta_2" value="Mas de 6">
                        <label class="form-check-label" for="Masde6">Más de 6</label>
                    </div>
                </div>

                <!-- Pregunta 3 -->
                <div class="mb-3">
                    <label class="form-label">3. De estos pacientes con GLP-1, ¿a cuántos les formuló un GLP1 oral?</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_3" value="Ninguno">
                        <label class="form-check-label" for="Ninguno">Ninguno</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De1a2" name="respuesta_3" value="De 1 a 2">
                        <label class="form-check-label" for="De1a2">De 1 a 2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De3a5" name="respuesta_3" value="De 3 a 5">
                        <label class="form-check-label" for="De3a5">De 3 a 5</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Masde6" name="respuesta_3" value="Mas de 6">
                        <label class="form-check-label" for="Masde6">Más de 6</label>
                    </div>
                </div>
            </div>
            <div id="2" style="display: none;">
                <!-- Pregunta 4 -->
                <div class="mb-3">
                    <label class="form-label">2. De estos pacientes con Diabetes Mellitus Tipo 2, ¿a cuántos les formuló una Insulina basal?</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_4" value="Ninguno">
                        <label class="form-check-label" for="Ninguno">Ninguno</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De1a2" name="respuesta_4" value="De 1 a 2">
                        <label class="form-check-label" for="De1a2">De 1 a 2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De3a5" name="respuesta_4" value="De 3 a 5">
                        <label class="form-check-label" for="De3a5">De 3 a 5</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Masde6" name="respuesta_4" value="Mas de 6">
                        <label class="form-check-label" for="Masde6">Más de 6</label>
                    </div>
                </div>

                <!-- Pregunta 5 -->
                <div class="mb-3">
                    <label class="form-label">3. De estos pacientes con Insulina, ¿a cuántos les formuló una insulina degludec liraglutida?</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_5" value="Ninguno">
                        <label class="form-check-label" for="Ninguno">Ninguno</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De1a2" name="respuesta_5" value="De 1 a 2">
                        <label class="form-check-label" for="De1a2">De 1 a 2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De3a5" name="respuesta_5" value="De 3 a 5">
                        <label class="form-check-label" for="De3a5">De 3 a 5</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Masde6" name="respuesta_5" value="Mas de 6">
                        <label class="form-check-label" for="Masde6">Más de 6</label>
                    </div>
                </div>
            </div>
            <div id="3" style="display: none;">
                <!-- Pregunta 2 -->
                <div class="mb-3">
                    <label class="form-label">2. De estos pacientes con Diabetes Mellitus Tipo 2, ¿a cuántos les formuló un GLP-1 inyectable u oral?</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_2" value="Ninguno">
                        <label class="form-check-label" for="Ninguno">Ninguno</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De1a2" name="respuesta_2" value="De 1 a 2">
                        <label class="form-check-label" for="De1a2">De 1 a 2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De3a5" name="respuesta_2" value="De 3 a 5">
                        <label class="form-check-label" for="De3a5">De 3 a 5</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Masde6" name="respuesta_2" value="Mas de 6">
                        <label class="form-check-label" for="Masde6">Más de 6</label>
                    </div>
                </div>

                <!-- Pregunta 3 -->
                <div class="mb-3">
                    <label class="form-label">3. De estos pacientes con GLP-1, ¿a cuántos les formuló un GLP1 oral?</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_3" value="Ninguno">
                        <label class="form-check-label" for="Ninguno">Ninguno</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De1a2" name="respuesta_3" value="De 1 a 2">
                        <label class="form-check-label" for="De1a2">De 1 a 2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De3a5" name="respuesta_3" value="De 3 a 5">
                        <label class="form-check-label" for="De3a5">De 3 a 5</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Masde6" name="respuesta_3" value="Mas de 6">
                        <label class="form-check-label" for="Masde6">Más de 6</label>
                    </div>
                </div>
                <!-- Pregunta 4 -->
                <div class="mb-3">
                    <label class="form-label">4. De estos pacientes con Diabetes Mellitus Tipo 2, ¿a cuántos les formuló una Insulina basal?</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_4" value="Ninguno">
                        <label class="form-check-label" for="Ninguno">Ninguno</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De1a2" name="respuesta_4" value="De 1 a 2">
                        <label class="form-check-label" for="De1a2">De 1 a 2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De3a5" name="respuesta_4" value="De 3 a 5">
                        <label class="form-check-label" for="De3a5">De 3 a 5</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Masde6" name="respuesta_4" value="Mas de 6">
                        <label class="form-check-label" for="Masde6">Más de 6</label>
                    </div>
                </div>

                <!-- Pregunta 5 -->
                <div class="mb-3">
                    <label class="form-label">5. De estos pacientes con Insulina, ¿a cuántos les formuló una insulina degludec liraglutida?</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_5" value="Ninguno">
                        <label class="form-check-label" for="Ninguno">Ninguno</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De1a2" name="respuesta_5" value="De 1 a 2">
                        <label class="form-check-label" for="De1a2">De 1 a 2</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="De3a5" name="respuesta_5" value="De 3 a 5">
                        <label class="form-check-label" for="De3a5">De 3 a 5</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="Masde6" name="respuesta_5" value="Mas de 6">
                        <label class="form-check-label" for="Masde6">Más de 6</label>
                    </div>
                </div>
            </div>
            <div class="mb-4 d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Enviar Encuesta</button>
            </div>
        </form>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        // Elementos del DOM
        const formConsulta = document.getElementById('formConsulta');
        const formRegistro = document.getElementById('formRegistro');
        const btnRegistrar = document.getElementById('btnRegistrar');
        const seleccionCuestionario = document.getElementById('seleccionCuestionario');
        const formEncuesta = document.getElementById('formEncuesta');
        const btnHabilitarEncuesta = document.getElementById('btnHabilitarEncuesta');
        const cuestionarioSelect = document.getElementById('cuestionario');
        const btnConsultar = document.getElementById('btnConsultar');

        // Función para mostrar u ocultar secciones
        function toggleSection(section, show) {
            section.style.display = show ? 'block' : 'none';
        }

        // Función para mostrar alertas
        function showAlert(type, title, text) {
            Swal.fire({
                icon: type,
                title: title,
                text: text,
            });
        }

        // Manejo del formulario de consulta
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

                        });
                        document.getElementById('persona').value = datos.id || '';

                        toggleSection(formConsulta, false);
                        toggleSection(seleccionCuestionario, true);

                        const nombreInput = document.getElementById('nombre');
                        const apellidosInput = document.getElementById('apellidos');
                        const tipoDocumentoInput = document.getElementById('tipo_documento');
                        const numeroDocumentoInput = document.getElementById('numero_documento');
                        const telefonoInput = document.getElementById('telefono');
                        const direccionInput = document.getElementById('direccion');

                        // Asignar valores y marcar como readonly si no están vacíos
                        if (datos.nombre) {
                            nombreInput.value = datos.nombre;
                            nombreInput.readOnly = true; // Hacerlo readonly si tiene valor
                        } else {
                            nombreInput.value = '';
                        }

                        if (datos.apellido) {
                            apellidosInput.value = datos.apellido;
                            apellidosInput.readOnly = true;
                        } else {
                            apellidosInput.value = '';
                        }

                        if (datos.tipo_documento) {
                            tipoDocumentoInput.value = datos.tipo_documento;
                            tipoDocumentoInput.readOnly = true;
                        } else {
                            tipoDocumentoInput.value = '';
                        }

                        if (datos.numero_documento) {
                            numeroDocumentoInput.value = datos.numero_documento;
                            numeroDocumentoInput.readOnly = true;
                        } else {
                            numeroDocumentoInput.value = '';
                        }

                        if (datos.telefono) {
                            telefonoInput.value = datos.telefono;
                            telefonoInput.readOnly = true;
                        } else {
                            telefonoInput.value = '';
                        }

                        if (datos.direccion) {
                            direccionInput.value = datos.direccion;
                            direccionInput.readOnly = true;
                        } else {
                            direccionInput.value = '';
                        }

                        showAlert('success', 'Documento encontrado', 'Selecciona un cuestionario para continuar.');
                    } else {
                        // Documento no encontrado
                        toggleSection(formConsulta, false);
                        toggleSection(formRegistro, true);
                        toggleSection(btnRegistrar, true);

                        showAlert('error', 'Documento no encontrado', 'El número de documento no está registrado.');
                    }
                })
                .catch(() => {
                    showAlert('error', 'Error', 'Ocurrió un problema al verificar el documento.');
                });
        });

        // Manejo del formulario de registro
        formRegistro.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(formRegistro);

            axios.post('../logica/registro_persona.php', formData)
                .then(response => {
                    if (response.data.status === 'registrado') {
                        // Mostrar la alerta de éxito
                        showAlert('success', 'Registro exitoso', 'Volver a consultarse.')
                        setTimeout(() => {
                            window.open('../presentacion/encuesta.php', 'info');
                        }, 2000);
                    } else {
                        // Mostrar mensaje de error si no se pudo registrar
                        showAlert('error', 'Error en el registro', response.data.error || 'No se pudo registrar.');
                    }
                })
                .catch(() => {
                    showAlert('error', 'Error', 'Ocurrió un problema al registrar.');
                });
        });

        cuestionarioSelect.addEventListener('change', function() {
            btnHabilitarEncuesta.disabled = !cuestionarioSelect.value;
        });

        btnHabilitarEncuesta.addEventListener('click', function() {
            const selectedCuestionario = cuestionarioSelect.value;
            document.getElementById(selectedCuestionario).style.display = 'block';
            formEncuesta.style.display = 'block';
            seleccionCuestionario.style.display = 'none';
            formRegistro.style.display = 'block';
            // btnRegistrar.style.display = 'none'
            formEncuesta.style.display = 'block';
        });

        // Manejo del formulario de encuesta
        formEncuesta.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(formEncuesta);

            axios.post('../logica/procesar_encuesta.php', formData)
                .then(response => {
                    console.log(response)
                    if (response.data.success) {
                        showAlert('success', 'Encuesta registrada')
                        setTimeout(() => {
                            window.open('../presentacion/encuesta.php', 'info');
                        }, 2000);
                    } else {
                        showAlert('error', 'Error', response.data.error || 'No se pudo registrar la encuesta.');
                    }
                })
                .catch(() => {
                    showAlert('error', 'Error', 'Ocurrió un problema al guardar la encuesta.');
                });
        });
    </script>


</body>

</html>