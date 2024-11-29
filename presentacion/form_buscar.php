<?php
require '../datos/conex.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta</title>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
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

<body>
    <div class="row-reverse my-5 px-2" id="formConsulta">
        <div class="col mb-3">
            <h5>Por favor, primero consulta si la persona existe en nuestro sistema: <span class="fw-bold text-danger">*</span></h5>
        </div>
        <div class="col">
            <form>
                <div class="row-reverse">
                    <div class="col-6 mb-3">
                        <label for="documento" class="form-label">Número de Documento</label>
                        <input type="text" class="form-control" name="documento" id="documento" required>
                    </div>
                    <div class="col">
                        <button type="submit" id="btnConsultar" class="btn btn-primary">Consultar Documento</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(function() {
            const btnConsultar = document.getElementById('btnConsultar');

            btnConsultar.addEventListener('click', function(e) {
                e.preventDefault(); // Evita que el formulario se envíe por defecto

                let documentInput = document.getElementById("documento");

                let dateDocument = {
                    documento: document.getElementById("documento").value
                };

                if (documentInput.value.length > 0) {
                    documentInput.classList.add('is-valid');
                    documentInput.classList.remove('is-invalid');

                    axios.post('../logica/verificar_documento.php', dateDocument)
                        .then(function(response) {
                            console.log(response)
                            Swal.fire({
                                title: response.data.mensaje,
                                icon: response.data.tipo,
                                confirmButtonText: 'Aceptar',
                                position: 'top'
                            }).then((result) => {
                                if (response.data.encontrado) {
                                    // Redirige si el documento fue encontrado
                                    window.location.href = `./encuesta.php?documento=${dateDocument.documento}`;
                                } else {
                                    window.location.href = './registro_persona.php';
                                }
                            });
                        })
                        .catch(function(error) {
                            Swal.fire({
                                title: 'Error con el servidor',
                                text: 'Por favor consulte con el administrador',
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            });
                        });
                } else {
                    documentInput.classList.add('is-invalid');
                    documentInput.classList.remove('is-valid');
                }
            });
        });
    </script>

</body>

</html>