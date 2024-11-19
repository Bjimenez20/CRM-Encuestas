<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

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
<style type="text/css">
    @import url("GothamRnd_book/stylesheet.css");

    .centro {
        text-align: center;
    }

    body {
        background: url('../layouts/img/background.png');
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .fuente {
        font-family: Tahoma, Geneva, sans-serif;
    }

    .error {
        font-family: GothamRnd-book;
        color: #C30;
    }

    .aviso3 {
        font-size: 130%;
        font-weight: bold;
        color: #11a9e3;
        text-transform: uppercase;
        font-family: Tahoma, Geneva, sans-serif;
        background-color: transparent;
        text-align: center;
        padding: 10px;
    }

    .error {
        font-size: 130%;
        font-weight: bold;
        color: #E30613;
        text-transform: uppercase;
        background-color: transparent;
        text-align: center;
        padding: 10px;
    }

    .my-6 {
        margin-top: 25%;
        margin-bottom: 25%;
    }
</style>

<body>
    <?php
    $USUARIO = $_SESSION["usuarios"];
    require('../datos/conex.php');
    function validar_clave($clave, &$error_clave)
    {
        if (strlen($clave) < 8) {
            $error_clave = "La clave debe tener al menos 8 caracteres";
            return false;
        }
        if (strlen($clave) > 16) {
            $error_clave = "La clave no puede tener más de 16 caracteres";
            return false;
        }
        if (!preg_match('`[a-z]`', $clave)) {
            $error_clave = "La clave debe tener al menos una letra minúscula";
            return false;
        }
        if (!preg_match('`[A-Z]`', $clave)) {
            $error_clave = "La clave debe tener al menos una letra mayúscula";
            return false;
        }
        if (!preg_match('`[0-9]`', $clave)) {
            $error_clave = "La clave debe tener al menos un caracter numérico";
            return false;
        }
        $error_clave = "";
        return true;
    }
    ?>
    <div class="row m-0">
        <div class="col-md-6 col-lg-5 col-sm-10 col-xs-10 mx-auto m-5">
            <div class="row-reverse my-5">
                <div class="col my-6 d-flex justify-content-center align-items-center mb-3">
                    <img src="https://www.overall.pe/img/overall_blue.svg" alt="" class="w-50">
                </div>
                <div class="col my-5">
                    <form id="inicio" action="../presentacion/form_restablecer_clave.php" method="POST" style="width:100%;">
                        <div class="row-reverse my-5">
                            <div class="col-auto mb-4">
                                <label class="sr-only" for="inlineFormInputGroup">Contraseña</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><span class="iconify" data-icon="carbon:password"></span></div>
                                    </div>
                                    <input id="Contrasena_ac" name="Contrasena_ac" class="form-control" type="password" required="required" placeholder="Contraseña actual">
                                </div>
                            </div>
                            <div class="col-auto mb-4">
                                <label class="sr-only" for="inlineFormInputGroup">Contraseña</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><span class="iconify" data-icon="carbon:password"></span></div>
                                    </div>
                                    <input id="Contrasena_nu" name="Contrasena_nu" class="form-control" type="password" required="required" placeholder="Contraseña nueva">
                                </div>
                            </div>
                            <div class="col-auto mb-4">
                                <label class="sr-only" for="inlineFormInputGroup">Contraseña</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><span class="iconify" data-icon="carbon:password"></span></div>
                                    </div>
                                    <input id="Contrasena_va" name="Contrasena_va" class="form-control" type="password" required="required" placeholder="Confirmar contraseña">
                                </div>
                            </div>
                            <div class="col d-flex justify-content-center my-3">
                                <input id="InicioR" name="InicioR" type="submit" value="Cambiar contraseña" class="btn_iniar btn btn-primary btn-block">
                            </div>
                            <?php
                            if (isset($_POST['InicioR'])) {
                                $CONTRASENA_AC = $_POST['Contrasena_ac'];
                                $CONTRASENA_NU = $_POST['Contrasena_nu'];
                                $CONTRASENA_VA = $_POST['Contrasena_va'];
                                $CONTRASENA_VENCE = date('Y-m-d  H:i:s', strtotime('+1 month'));
                                $error_encontrado = "";
                                if (validar_clave($_POST["Contrasena_nu"], $error_encontrado)) {
                                    if ($CONTRASENA_NU == $CONTRASENA_VA) {
                                        echo '<script type="text/javascript">';
                                        echo ' alert("Contraseña valida")';
                                        echo '</script>';
                                        $sql = mysqli_query($conex, "UPDATE usuarios SET CONTRASENA = '" . MD5($CONTRASENA_NU) . "', ESTADO_APP = '2' WHERE EMAIL='" . $USUARIO . "';");
                                        echo mysqli_error($conex);
                                        header("Location: ../");
                                        session_unset();
                                        session_destroy();
                                        exit();
                                    } else {
                                        echo '<script type="text/javascript">';
                                        echo ' alert("Las contraseñas no coinciden")';  //not showing an alert box.
                                        echo '</script>';
                                    }
                                } else {
                                    echo '<script type="text/javascript">';
                                    echo " alert('$error_encontrado')";  //not showing an alert box.
                                    echo '</script>';
                                }
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>