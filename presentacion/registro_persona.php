<?php
include('../logica/session.php');
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
                                    <label for="nombre_medico" class="fw-bold">Nombre<span class="fw-bold text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nombre_medico" id="nombre_medico"">
                                </div>
                                <div class=" col">
                                    <label for="apellido_medico" class="fw-bold">Apellido<span class="fw-bold text-danger">*</span></label>
                                    <input type="text" class="form-control" name="apellido_medico" id="apellido_medico"">
                                </div>
                            </div>
                           <div class=" row mb-3">
                                    <div class=" col">
                                        <label for="correo" class="fw-bold">Correo Electronico<span class="fw-bold text-danger">*</span></label>
                                        <input type="text" class="form-control" name="correo" id="correo">
                                    </div>
                                </div>
                                <div class=" row mb-3">
                                    <div class="col">
                                        <label for="telefono" class="fw-bold">Teléfono 1<span class="fw-bold text-danger">*</span></label>
                                        <input type="text" class="form-control" name="telefono1" id="telefono1">
                                    </div>
                                    <div class="col">
                                        <label for="telefono" class="fw-bold">Teléfono 2</label>
                                        <input type="text" class="form-control" name="telefono2" id="telefono2">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="telefono" class="fw-bold">Teléfono 3</label>
                                        <input type="text" class="form-control" name="telefono3" id="telefono3">
                                    </div>
                                    <div class="col">
                                        <label for="telefono" class="fw-bold">Teléfono 4</label>
                                        <input type="text" class="form-control" name="telefono4" id="telefono4">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success">Registrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.getElementById('formInsert').addEventListener('submit', function(e) {
            e.preventDefault(); // Evita que el formulario se envíe por defecto

            // Obtén los valores de los campos
            const nombre_medico = document.getElementById('nombre_medico').value.trim();
            const apellido_medico = document.getElementById('apellido_medico').value.trim();
            const correo = document.getElementById('correo').value.trim();
            const telefono1 = document.getElementById('telefono1').value.trim();

            // Verifica si los campos obligatorios están llenos
            if (!nombre_medico || !apellido_medico || !correo || !telefono1) {
                Swal.fire({
                    title: 'Campos obligatorios vacíos',
                    text: 'Por favor, completa todos los campos marcados con *.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar',
                });
                return;
            }

            // Empaqueta los datos para enviar
            const data = {
                nombre_medico: nombre_medico,
                apellido_medico: apellido_medico,
                correo: correo,
                telefono1: telefono1,
                telefono2: document.getElementById('telefono2').value.trim(),
                telefono3: document.getElementById('telefono3').value.trim(),
                telefono4: document.getElementById('telefono4').value.trim(),
            };

            // Envía los datos con Axios
            axios.post('../logica/insertar_medico.php', data)
                .then(response => {
                    // Muestra una alerta dependiendo de la respuesta del servidor
                    if (response.data.success) {
                        Swal.fire({
                            title: 'Registro exitoso',
                            text: response.data.message,
                            icon: 'success',
                            confirmButtonText: 'Aceptar',
                        }).then(() => {
                            window.location.href = './form_buscar.php';
                        });
                    } else {
                        Swal.fire({
                            title: 'Error al registrar',
                            text: response.data.message,
                            icon: 'error',
                            confirmButtonText: 'Aceptar',
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error del servidor',
                        text: 'Ocurrió un problema al registrar los datos. Por favor, intenta nuevamente.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                    });
                    console.error(error);
                });
        });
    </script>

</body>

</html>