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

        <!-- Formulario de encuesta -->
        <form id="formEncuesta" style="display: none;">
            <div class="row mb-3">
                <div class="col">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" readonly>
                </div>
                <div class="col">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                    <input type="text" class="form-control" name="tipo_documento" id="tipo_documento" readonly>
                </div>
                <div class="col">
                    <label for="numero_documento" class="form-label">Número de Documento</label>
                    <input type="text" class="form-control" name="numero_documento" id="numero_documento" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" id="telefono" readonly>
                </div>
                <div class="col">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" readonly>
                </div>
            </div>
            <div class="row mb-3" style="display: none;">
                <div class="col">
                    <label for="persona" class="form-label">Persona</label>
                    <input type="text" class="form-control" name="persona" id="persona" readonly>
                </div>
                <div class="col">
                    <label for="cuestionarioSeleccionado" class="form-label">Cuestionario</label>
                    <input type="text" class="form-control" name="cuestionarioSeleccionado" id="cuestionarioSeleccionado" readonly>
                </div>
            </div>
            <hr>
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
            <div id="3">
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
        const formConsulta = document.getElementById('formConsulta');
        const seleccionCuestionario = document.getElementById('seleccionCuestionario');
        const btnHabilitarEncuesta = document.getElementById('btnHabilitarEncuesta');
        const cuestionarioSelect = document.getElementById('cuestionario');
        const btnConsultar = document.getElementById('btnConsultar');

        formConsulta.addEventListener('submit', function(e) {
            e.preventDefault();
            const documento = document.getElementById('documento').value;

            axios.post('../logica/verificar_documento.php', {
                    documento
                })
                .then(response => {
                    if (response.data.encontrado) {
                        // Mostrar datos del documento
                        document.getElementById('nombre').value = response.data.datos.nombre || '';
                        document.getElementById('apellidos').value = response.data.datos.apellido || '';
                        document.getElementById('tipo_documento').value = response.data.datos.tipo_documento || '';
                        document.getElementById('numero_documento').value = response.data.datos.numero_documento || '';
                        document.getElementById('telefono').value = response.data.datos.telefono || '';
                        document.getElementById('direccion').value = response.data.datos.direccion || '';
                        document.getElementById('cuestionario').addEventListener('change', function() {
                            // Obtén el valor del cuestionario seleccionado
                            const cuestionarioId = this.value; // ID del cuestionario
                            const cuestionarioTexto = this.options[this.selectedIndex].text; // Texto visible del cuestionario

                            // Muestra el texto del cuestionario seleccionado en el input
                            document.getElementById('cuestionarioSeleccionado').value = cuestionarioId;
                        });
                        document.getElementById('persona').value = response.data.datos.id || '';
                        seleccionCuestionario.style.display = 'block';
                        formConsulta.style.display = 'none';
                        Swal.fire({
                            icon: 'success',
                            title: 'Documento encontrado',
                            text: 'Selecciona un cuestionario para continuar.'
                        });
                    } else {
                        seleccionCuestionario.style.display = 'block';
                        formConsulta.style.display = 'none';
                        Swal.fire({
                            icon: 'error',
                            title: 'Documento no encontrado',
                            text: 'El número de documento no está registrado.'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un problema al verificar el documento.'
                    });
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
        });

        // Aquí añades el script para el manejo de la encuesta
        const formEncuesta = document.getElementById('formEncuesta');
        formEncuesta.addEventListener('submit', function(e) {
            e.preventDefault();

            // Obtener los datos del formulario de encuesta
            const formData = new FormData(formEncuesta);

            // Enviar los datos al servidor usando Axios
            axios.post('../logica/procesar_encuesta.php', formData)
                .then(response => {
                    if (response.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Encuesta registrada',
                            text: response.data.success,
                        }).then(() => {
                            // Redirigir o resetear el formulario si es necesario
                            const url = `../presentacion/encuesta.php`;
                            const target = "info";
                            //document.getElementById("seguimiento").reset()
                            window.open(url, target);
                        });
                    } else if (response.data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.data.error,
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un problema al guardar la encuesta.',
                    });
                });
        });
    </script>

</body>

</html>