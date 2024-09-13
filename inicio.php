<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</head>

<body>
    <div class="mi-elemento">
        <div class="row m-0">
            <div class="col-md-6 col-lg-5 col-sm-10 col-xs-10 mx-auto m-5">
                <div class="row-reverse my-5">
                    <div class="col my-6 d-flex justify-content-center">
                        <img src="https://www.overall.pe/img/overall_blue.svg" alt="" class="w-50">
                    </div>
                    <div class="col my-5">
                        <form id="inicio" action="logica/ini_sesion.php" method="POST">
                            <div class="row-reverse my-5">
                                <div class="col-auto mb-4">
                                    <label class="sr-only" for="inlineFormInputGroup">Correo eléctronico</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><span class="iconify" data-icon="carbon:email"></span></div>
                                        </div>
                                        <input id="email" name="email" type="email" class="form-control" required="required" placeholder="Correo Electronico">
                                    </div>
                                </div>
                                <div class="col-auto mb-4">
                                    <label class="sr-only" for="inlineFormInputGroup">Contraseña</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><span class="iconify" data-icon="carbon:password"></span></div>
                                        </div>
                                        <input id="Contrasena" name="Contrasena" class="form-control" type="password" required="required" placeholder="Contraseña">
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-center my-3">
                                    <input id="Inicio" name="Inicio" type="submit" value="Iniciar Sesi&oacute;n" class="btn_iniar btn btn-primary btn-block">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col d-flex justify-content-center my-5">
                        <a href="../bayerColombia/presentacion/form_restablecer_contrasena.php">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
                <style>
                    a {
                        text-decoration: underline;
                        color: #0C68B0;
                    }

                    a:hover {
                        color: #0C68B0;
                    }

                    .column_form {
                        left: 5%;
                    }

                    .my-6 {
                        margin-top: 15%;
                        margin-bottom: 15%;
                    }

                    body {
                        background: url(../layouts/img/background.png) no-repeat center center fixed;
                        -webkit-background-size: cover;
                        -moz-background-size: cover;
                        -o-background-size: cover;
                        background-size: cover;
                    }

                    .container-fluid {
                        background: transparent;
                        border: none;
                    }

                    .footer {
                        background-color: rgba(0, 0, 0, 0.5);
                        /* Cambia el último valor (0.5) para ajustar la opacidad */
                        text-align: center;
                        width: 100%;
                        position: fixed;
                        /* Lo fija en la ventana */
                        bottom: 0;
                        /* Lo coloca en la parte inferior */
                        left: 0;
                        /* Lo coloca al lado izquierdo */
                    }

                    .copyright p {
                        color: white;
                        font-size: 13px;
                    }
                </style>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright">
                    <p>
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        People Marketing SAS. Todos los derechos de propiedad intelectual y de marca y cualquier otra parte que componga el software en mención pertenece a sus autores. En este sentido, está prohibido, por cualquier medio o forma su utilización, explotación, copia, reproducción, así como su eliminación, lesión, alteración y/o modificación, registro y/o solicitud de registro, bien parcial o total, temporal o definitiva de los mismos y/o de cualquier otro similar, presente y/o futuro, sin la autorización expresa de People Marketing SAS; sin que en ningún momento pueda entenderse que existe alguna clase de autorización de cualquier naturaleza a ningún proveedor, tercero y/o cliente por parte de People Marketing SAS.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>

<!--<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->

<!--<script>-->
<!--    $(function() {-->
<!--        Swal.fire({-->
<!--            html: `<div class="row-reverse">-->
<!--        <div class="col">-->
<!--            <img src="layouts/img/3.png" alt="" class="w-50">-->
<!--        </div>-->
<!--        <div class="col">-->
<!--            <h3 class="font-weight-bold">En este momento nos encontramos en mantenimiento.</h3>-->
<!--            <p>Si necesitas ingresar al ambiente de pruebas, <br> por favor digita el codigo asignado por el administrador:</p>-->
<!--        </div>-->
<!--    </div>`,-->
<!--            input: 'text',-->
<!--            inputAttributes: {-->
<!--                autocapitalize: 'off'-->
<!--            },-->
<!--            backdrop: false,-->
<!--            showCancelButton: false,-->
<!--            confirmButtonText: 'Desbloquear acceso',-->
<!--            showLoaderOnConfirm: true,-->
<!--            preConfirm: (login) => {-->
<!--                return fetch(`./services/logica.php?code=${login}`)-->
<!--                    .then(response => {-->
<!--                        if (!response.ok) {-->
<!--                            throw new Error(response.statusText);-->
<!--                        }-->
<!--                        return response.json();-->
<!--                    })-->
<!--                    .then(data => {-->
<!--                        if (data.tipo === 'error') {-->
<!--                            throw new Error(data.mensaje);-->
<!--                        } else {-->
                            <!--document.getElementById("Inicio").disabled = false; //Quitar disabled del botón-->
<!--                        }-->
<!--                    })-->
<!--                    .catch(error => {-->
<!--                        Swal.showValidationMessage(error);-->
<!--                    })-->
<!--            },-->
<!--            allowOutsideClick: () => !Swal.isLoading()-->
<!--        });-->

<!--    });-->
<!--</script>-->
<?php include 'layouts/end.php'; ?>