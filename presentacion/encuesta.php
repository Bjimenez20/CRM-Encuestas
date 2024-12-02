<?php
include('../logica/session.php');
require '../logica/get_persona.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <style>
        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 90vw;
            }
        }

        .accordion {
            --bs-accordion-active-bg: #0C68B0;
            --bs-accordion-active-color: white;
            --bs-accordion-btn-bg: #035da3;
            --bs-accordion-btn-color: white;
        }

        body,
        .accordion-item {
            background-color: transparent;
        }

        .accordion-collapse {
            border: solid #0C68B0 1px;
            border-end-start-radius: 10px;
            border-end-end-radius: 10px;

        }

        .btn-modify {
            background: #0C68B0;
        }

        .btn:hover {
            background: #0C68B0;
        }

        .readonly {
            background-color: #E5E5E5;
        }

        .readonly:focus {
            background-color: #E5E5E5;
        }
    </style>
</head>

<body class="w-100">
    <form id="formInsert">
        <div class="col">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            MEDICO
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="id_medico" class="fw-bold">ID Médico</label>
                                    <input type="text" class="form-control" name="id_medico" id="id_medico" value="<?= htmlspecialchars($persona['id']) ?>" readonly>
                                </div>
                                <div class="col">
                                    <label for="nombre_medico" class="fw-bold">Nombre Medico</label>
                                    <input type="text" class="form-control" name="nombre_medico" id="nombre_medico" value="<?= htmlspecialchars($persona['nombre'] . ' ' . $persona['apellido']) ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="telefono" class="fw-bold">Teléfono</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono" value="<?= htmlspecialchars($persona['telefono1']) ?>" readonly>
                                </div>
                                <div class="col">
                                    <label for="correo" class="fw-bold">Correo Electronico</label>
                                    <input type="text" class="form-control" name="correo" id="correo" value="<?= htmlspecialchars($persona['correo_electronico']) ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <?php if (!empty($persona['telefono2'])): ?>
                                    <div class="col">
                                        <label for="telefono2" class="fw-bold">Teléfono 2</label>
                                        <input type="text" class="form-control" name="telefono2" id="telefono2" value="<?= htmlspecialchars($persona['telefono2']) ?>" readonly>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($persona['telefono3'])): ?>
                                    <div class="col">
                                        <label for="telefono3" class="fw-bold">Teléfono 3</label>
                                        <input type="text" class="form-control" name="telefono3" id="telefono3" value="<?= htmlspecialchars($persona['telefono3']) ?>" readonly>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($persona['telefono4'])): ?>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="telefono4" class="fw-bold">Teléfono 4</label>
                                        <input type="text" class="form-control" name="telefono4" id="telefono4" value=" <?= htmlspecialchars($persona['telefono4']) ?>" readonly>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="encuesta_efectiva" class="fw-bold">Encuesta Efectiva<span class="fw-bold text-danger">*</span></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="encuesta" id="encuestaSI" value="SI">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            SI
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="encuesta" id="encuestaNO" value="NO">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            NO
                                        </label>
                                    </div>
                                </div>
                                <div class="col" id="tipo_motivo_no_encuesta" style="display: none;">
                                    <label for="motivo_no_encuesta" class="fw-bold">Motivo encuesta no efectiva<span class="fw-bold text-danger">*</span></label>
                                    <select class="form-control" name="motivo_no_encuesta" id="motivo_no_encuesta">
                                        <option value="">Seleccione...</option>
                                        <option value="Falta de contacto">Falta de contacto</option>
                                        <option value="Negativa rotunda a participar">Negativa rotunda a participar</option>
                                        <option value="Numero erroneo">Número erróneo</option>
                                        <option value="Se encuentra en consulta">Se encuentra en consulta</option>
                                        <option value="Solicita envio al correo">Solicita envio al correo</option>
                                        <option value="Solicita pago por encuesta">Solicita pago por encuesta</option>
                                        <option value="Telefono fuera de servicio">Telefono fuera de servicio</option>
                                    </select>
                                </div>
                                <div class="col" id="tipo_encuesta" style="display: none;">
                                    <label for="cuestionario" class="fw-bold">Cuestionario<span class="fw-bold text-danger">*</span></label>
                                    <select class="form-control" name="cuestionario" id="cuestionario">
                                        <option value="" disabled selected>Seleccione un cuestionario</option>
                                        <?php
                                        $select_cu = mysqli_query($conex, "SELECT * FROM cuestionarios WHERE id != 4");
                                        while ($fila_cu = mysqli_fetch_array($select_cu)) {
                                        ?>
                                            <option value="<?php echo $fila_cu['id'] ?>"><?php echo $fila_cu['nombre_encuesta'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3" id="div_nota" style="display: none;">
                                <div class="col">
                                    <label for="nota" class="fw-bold">Nota<span class="fw-bold text-danger">*</span></label>
                                    <textarea class="form-control" name="nota" id="nota" title="Escriba una Nota" placeholder="Escriba una Nota"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col d-flex justify-content-center">
                                    <button type="submit" id="btnRegistrar" style="display: none;" class="btn btn-success">Registrar</button>
                                </div>
                            </div>

                            <div id="formEncuesta" style="display: none;">
                                <hr>
                                <div style="display: none;">
                                    <input type="text" id="medico_id" name="medico_id" value="<?= htmlspecialchars($persona['id']) ?>">
                                    <input type="text" id="cuestionarioselect" name="cuestionarioselect">
                                    <input type="text" id="encuesta_efectiva" name="encuesta_efectiva">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">1. De los pacientes que atiende en una semana, ¿Cuántos de ellos tienen Diabetes Mellitus Tipo 2?</label><br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="De1a20" name="respuesta_1" value="a) De 1 a 20">
                                        <label class="form-check-label" for="De1a20">a) De 1 a 20</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="De21a20" name="respuesta_1" value="b) De 21 a 40">
                                        <label class="form-check-label" for="De21a20">b) De 21 a 40</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="De41a60" name="respuesta_1" value="c) De 41 a 60">
                                        <label class="form-check-label" for="De41a60">c) De 41 a 60</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="Masde60" name="respuesta_1" value="d) Mas de 60">
                                        <label class="form-check-label" for="Masde60">d) Más de 60</label>
                                    </div>
                                </div>
                                <div id="1" style="display: none;">
                                    <!-- Pregunta 2 -->
                                    <div class="mb-3">
                                        <label class="form-label">2. De estos pacientes con Diabetes Mellitus Tipo 2, ¿a cuántos les formuló un GLP-1 inyectable u oral?</label><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_2" value="a) Ninguno">
                                            <label class="form-check-label" for="Ninguno">a) Ninguno</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De1a2" name="respuesta_2" value="b) De 1 a 2">
                                            <label class="form-check-label" for="De1a2">b) De 1 a 2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De3a5" name="respuesta_2" value="c) De 3 a 5">
                                            <label class="form-check-label" for="De3a5">c) De 3 a 5</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Masde6" name="respuesta_2" value="d) Mas de 6">
                                            <label class="form-check-label" for="Masde6">d) Más de 6</label>
                                        </div>
                                    </div>

                                    <!-- Pregunta 3 -->
                                    <div class="mb-3">
                                        <label class="form-label">3. De estos pacientes con GLP-1, ¿a cuántos les formuló un GLP1 oral?</label><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_3" value="a) Ninguno">
                                            <label class="form-check-label" for="Ninguno">a) Ninguno</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De1a2" name="respuesta_3" value="b) De 1 a 2">
                                            <label class="form-check-label" for="De1a2">b) De 1 a 2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De3a5" name="respuesta_3" value="c) De 3 a 5">
                                            <label class="form-check-label" for="De3a5">c) De 3 a 5</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Masde6" name="respuesta_3" value="d) Mas de 6">
                                            <label class="form-check-label" for="Masde6">d) Más de 6</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="2" style="display: none;">
                                    <!-- Pregunta 4 -->
                                    <div class="mb-3">
                                        <label class="form-label">2. De estos pacientes con Diabetes Mellitus Tipo 2, ¿a cuántos les formuló una Insulina basal?</label><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_4" value="a) Ninguno">
                                            <label class="form-check-label" for="Ninguno">a) Ninguno</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De1a2" name="respuesta_4" value="b) De 1 a 2">
                                            <label class="form-check-label" for="De1a2">b) De 1 a 2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De3a5" name="respuesta_4" value="c) De 3 a 5">
                                            <label class="form-check-label" for="De3a5">c) De 3 a 5</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Masde6" name="respuesta_4" value="d) Mas de 6">
                                            <label class="form-check-label" for="Masde6">d) Más de 6</label>
                                        </div>
                                    </div>

                                    <!-- Pregunta 5 -->
                                    <div class="mb-3">
                                        <label class="form-label">3. De estos pacientes con Insulina, ¿a cuántos les formuló una insulina degludec liraglutida?</label><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_5" value="a) Ninguno">
                                            <label class="form-check-label" for="Ninguno">a) Ninguno</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De1a2" name="respuesta_5" value="b) De 1 a 2">
                                            <label class="form-check-label" for="De1a2">b) De 1 a 2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De3a5" name="respuesta_5" value="c) De 3 a 5">
                                            <label class="form-check-label" for="De3a5">c) De 3 a 5</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Masde6" name="respuesta_5" value="d) Mas de 6">
                                            <label class="form-check-label" for="Masde6">d) Más de 6</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="3" style="display: none;">
                                    <!-- Pregunta 2 -->
                                    <div class="mb-3">
                                        <label class="form-label">2. De estos pacientes con Diabetes Mellitus Tipo 2, ¿a cuántos les formuló un GLP-1 inyectable u oral?</label><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_2" value="a) Ninguno">
                                            <label class="form-check-label" for="Ninguno">a) Ninguno</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De1a2" name="respuesta_2" value="b) De 1 a 2">
                                            <label class="form-check-label" for="De1a2">b) De 1 a 2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De3a5" name="respuesta_2" value="c) De 3 a 5">
                                            <label class="form-check-label" for="De3a5">c) De 3 a 5</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Masde6" name="respuesta_2" value="d) Mas de 6">
                                            <label class="form-check-label" for="Masde6">d) Más de 6</label>
                                        </div>
                                    </div>

                                    <!-- Pregunta 3 -->
                                    <div class="mb-3">
                                        <label class="form-label">3. De estos pacientes con GLP-1, ¿a cuántos les formuló un GLP1 oral?</label><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_3" value="a) Ninguno">
                                            <label class="form-check-label" for="Ninguno">a) Ninguno</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De1a2" name="respuesta_3" value="b) De 1 a 2">
                                            <label class="form-check-label" for="De1a2">b) De 1 a 2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De3a5" name="respuesta_3" value="c) De 3 a 5">
                                            <label class="form-check-label" for="De3a5">c) De 3 a 5</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Masde6" name="respuesta_3" value="d) Mas de 6">
                                            <label class="form-check-label" for="Masde6">d) Más de 6</label>
                                        </div>
                                    </div>
                                    <!-- Pregunta 4 -->
                                    <div class="mb-3">
                                        <label class="form-label">4. De estos pacientes con Diabetes Mellitus Tipo 2, ¿a cuántos les formuló una Insulina basal?</label><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_4" value="a) Ninguno">
                                            <label class="form-check-label" for="Ninguno">a) Ninguno</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De1a2" name="respuesta_4" value="b) De 1 a 2">
                                            <label class="form-check-label" for="De1a2">b) De 1 a 2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De3a5" name="respuesta_4" value="c) De 3 a 5">
                                            <label class="form-check-label" for="De3a5">c) De 3 a 5</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Masde6" name="respuesta_4" value="d) Mas de 6">
                                            <label class="form-check-label" for="Masde6">d) Más de 6</label>
                                        </div>
                                    </div>

                                    <!-- Pregunta 5 -->
                                    <div class="mb-3">
                                        <label class="form-label">5. De estos pacientes con Insulina, ¿a cuántos les formuló una insulina degludec liraglutida?</label><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Ninguno" name="respuesta_5" value="a) Ninguno">
                                            <label class="form-check-label" for="Ninguno">a) Ninguno</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De1a2" name="respuesta_5" value="b) De 1 a 2">
                                            <label class="form-check-label" for="De1a2">b) De 1 a 2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="De3a5" name="respuesta_5" value="c) De 3 a 5">
                                            <label class="form-check-label" for="De3a5">c) De 3 a 5</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="Masde6" name="respuesta_5" value="d) Mas de 6">
                                            <label class="form-check-label" for="Masde6">d) Más de 6</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success">Enviar Encuesta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('input[name="encuesta"]').forEach(function(radio) {
                radio.addEventListener("change", function() {
                    const encuestaSI = document.getElementById("encuestaSI");
                    const encuestaNO = document.getElementById("encuestaNO");
                    const tipoEncuesta = document.getElementById("tipo_encuesta");
                    const tipoMotivoNoEncuesta = document.getElementById("tipo_motivo_no_encuesta");
                    const div_nota = document.getElementById("div_nota");
                    const btnRegistrar = document.getElementById("btnRegistrar");
                    const formEncuesta = document.getElementById("formEncuesta");

                    if (encuestaSI.checked) {
                        tipoEncuesta.style.display = "block";
                        tipoMotivoNoEncuesta.style.display = "none";
                        btnRegistrar.style.display = "none";
                        div_nota.style.display = "none"
                        encuestaSI.disabled = true
                        encuestaNO.disabled = true
                    } else if (encuestaNO.checked) {
                        tipoMotivoNoEncuesta.style.display = "block";
                        tipoEncuesta.style.display = "none";
                        btnRegistrar.style.display = "block";
                        formEncuesta.style.display = "none";
                        div_nota.style.display = "block";
                        encuestaSI.disabled = true
                        encuestaNO.disabled = true
                    }
                });
            });

            const selectElement = document.getElementById('cuestionario');
            const inputElement = document.getElementById('cuestionarioselect');

            selectElement.addEventListener('change', () => {
                inputElement.value = selectElement.value;
            });

            const encuestaRadios = document.querySelectorAll('input[name="encuesta"]');
            const resultadoInput = document.getElementById('encuesta_efectiva');

            encuestaRadios.forEach(radio => {
                radio.addEventListener('change', () => {
                    if (radio.checked) {
                        resultadoInput.value = radio.value;
                    }
                });
            });

            const cuestionario = document.getElementById("cuestionario");
            const formEncuesta = document.getElementById("formEncuesta");
            const seleccionCuestionario = document.getElementById("tipo_encuesta");
            const formRegistro = document.getElementById("formRegistro");

            cuestionario.addEventListener("change", function() {
                const selectedValue = cuestionario.value;

                if (selectedValue) {
                    document.getElementById(selectedValue).style.display = "block";
                    formEncuesta.style.display = "block";
                    cuestionario.disabled = true;
                } else {
                    formEncuesta.style.display = "none";
                }
            });

            function showAlert(type, title, text) {
                Swal.fire({
                    icon: type,
                    title: title,
                    text: text,
                });
            }

            const formInsert = document.getElementById("formInsert");

            formInsert.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(formInsert);

                axios.post('../logica/procesar_encuesta.php', formData)
                    .then(response => {
                        console.log(response)
                        if (response.data.success) {
                            showAlert('success', 'Encuesta registrada')
                            setTimeout(() => {
                                window.open('../presentacion/form_buscar.php', 'info');
                            }, 2000);
                        } else {
                            showAlert('error', 'Error', response.data.error || 'No se pudo registrar la encuesta.');
                        }
                    })
                    .catch(() => {
                        showAlert('error', 'Error', 'Ocurrió un problema al guardar la encuesta.');
                    });
            });
        });
    </script>

</body>

</html>