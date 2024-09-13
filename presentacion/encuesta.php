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

        <!-- Cuestionario (oculto por defecto) -->
        <form id="formEncuesta" action="../logica/procesar_encuesta.php" method="POST" style="display: none;">
            <!-- Nombre y Apellidos -->
            <div class="row mb-3">
                <div class="col">
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <label for="" class="fw-bold">Nombre</label>
                        </div>
                        <div class="col-8">
                            <input type="text" data-title="Nombre" class="form-control" name="nombre" id="nombre" value="">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <label for="" class="fw-bold">Apellidos <span class="fw-bold text-danger">*</span></label>
                        </div>
                        <div class="col-8">
                            <input type="text" data-title="Apellidos" class="form-control" name="apellidos" id="apellidos" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <label for="" class="fw-bold">Tipo de Documento</label>
                        </div>
                        <div class="col-8">
                            <input type="text" data-title="Tipo de Documento" class="form-control" name="tipo_documento" id="tipo_documento" value="">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <label for="" class="fw-bold">Número de Documento <span class="fw-bold text-danger">*</span></label>
                        </div>
                        <div class="col-8">
                            <input type="text" data-title="Número de Documento" class="form-control" name="numero_documento" id="numero_documento" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <label for="" class="fw-bold">Teléfono</label>
                        </div>
                        <div class="col-8">
                            <input type="text" data-title="Teléfono" class="form-control" name="telefono" id="telefono" value="">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <label for="" class="fw-bold">Dirección <span class="fw-bold text-danger">*</span></label>
                        </div>
                        <div class="col-8">
                            <input type="text" data-title="Dirección" class="form-control" name="direccion" id="direccion" value="">
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <!-- Pregunta 2 -->
            <div class="mb-3">
                <label class="form-label">2. ¿Qué tan satisfecho estás con nuestro servicio?</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="muy-satisfecho" name="satisfaccion" value="muy-satisfecho" required>
                    <label class="form-check-label" for="muy-satisfecho">Muy satisfecho</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="satisfecho" name="satisfaccion" value="satisfecho">
                    <label class="form-check-label" for="satisfecho">Satisfecho</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="neutral" name="satisfaccion" value="neutral">
                    <label class="form-check-label" for="neutral">Neutral</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="insatisfecho" name="satisfaccion" value="insatisfecho">
                    <label class="form-check-label" for="insatisfecho">Insatisfecho</label>
                </div>
            </div>

            <!-- Pregunta 3 -->
            <div class="mb-3">
                <label for="recomendarias" class="form-label">3. ¿Nos recomendarías a un amigo?</label>
                <select class="form-select" id="recomendarias" name="recomendarias" required>
                    <option value="si">Sí</option>
                    <option value="no">No</option>
                </select>
            </div>

            <!-- Pregunta 4 -->
            <div class="mb-3">
                <label for="mejora" class="form-label">4. ¿Qué podemos mejorar?</label>
                <textarea class="form-control" id="mejora" name="mejora" rows="4"></textarea>
            </div>

            <!-- Pregunta 5 -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="contacto" name="contacto" value="si">
                <label class="form-check-label" for="contacto">5. ¿Te gustaría que te contactáramos para más información?</label>
            </div>

            <!-- Pregunta 6 -->
            <div class="mb-3">
                <label class="form-label">6. ¿Cómo te enteraste de nosotros?</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="internet" name="origen[]" value="internet">
                    <label class="form-check-label" for="internet">Internet</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="amigos" name="origen[]" value="amigos">
                    <label class="form-check-label" for="amigos">Amigos</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="tv" name="origen[]" value="tv">
                    <label class="form-check-label" for="tv">Televisión</label>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Enviar Encuesta</button>
        </form>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Axios (para solicitudes AJAX) -->
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <!-- JavaScript -->
        <script>
            document.getElementById('formConsulta').addEventListener('submit', function(e) {
                e.preventDefault();

                const documento = document.getElementById('documento').value;
                const btnConsultar = document.getElementById('btnConsultar');

                // Hacer la solicitud AJAX con Axios
                axios.post('../logica/verificar_documento.php', {
                        documento: documento
                    })
                    .then(function(response) {
                        console.log(response.data);
                        if (response.data.encontrado) {
                            // Documento encontrado, mostrar formulario de encuesta
                            document.getElementById('formEncuesta').style.display = 'block';
                            // Ocultar botón de consulta
                            btnConsultar.style.display = 'none';
                            // Completar los campos del formulario con los datos del documento
                            document.getElementById('nombre').value = response.data.datos.nombre || '';
                            document.getElementById('apellidos').value = response.data.datos.apellido || '';
                            document.getElementById('tipo_documento').value = response.data.datos.tipo_documento || '';
                            document.getElementById('numero_documento').value = response.data.datos.numero_documento || '';
                            document.getElementById('telefono').value = response.data.datos.telefono || '';
                            document.getElementById('direccion').value = response.data.datos.direccion || '';

                            Swal.fire({
                                icon: 'success',
                                title: 'Documento encontrado',
                                text: 'Puedes proceder con la encuesta'
                            });
                        } else {
                            // Documento encontrado, mostrar formulario de encuesta
                            document.getElementById('formEncuesta').style.display = 'block';
                            // Ocultar botón de consulta
                            btnConsultar.style.display = 'none';
                            // Documento no encontrado, mostrar alerta
                            Swal.fire({
                                icon: 'error',
                                title: 'Documento no encontrado',
                                text: 'El número de documento no está registrado.'
                            });
                        }
                    })
                    .catch(function(error) {
                        console.error('Error en la solicitud:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al procesar la solicitud.'
                        });
                    });
            });

            // Agregar manejador de envío para el formulario de encuesta
            document.getElementById('formEncuesta').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                axios.post(this.action, formData)
                    .then(function(response) {
                        console.log(response.data);
                        if (response.data.success) {
                            Swal.fire({
                                title: 'Éxito',
                                text: response.data.success,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirigir a otra página cuando se confirme
                                    window.location.href = '../presentacion/encuesta.php';
                                }
                            });
                        } else if (response.data.error) {
                            Swal.fire({
                                title: 'Error',
                                text: response.data.error,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(function(error) {
                        console.error('Error en la solicitud:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Hubo un problema al enviar la encuesta.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            });
        </script>
    </div>
</body>

</html>