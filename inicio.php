<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <style>
        body {
            background: url(../layouts/img/bbbackground.png) no-repeat center center fixed;
            background-size: cover;
            backdrop-filter: blur(5px);
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .login-container img {
            width: 100px;
            margin-bottom: 20px;
        }

        .login-container input {
            border-radius: 10px;
            padding: 10px 15px;
        }

        .btn-primary {
            background-color: #0C68B0;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #0a5d9d;
        }

        a {
            color: #0C68B0;
        }

        a:hover {
            color: #0a5d9d;
        }

        .footer {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="login-container col-md-6 col-lg-5 col-sm-10 col-xs-10">
            <div class="text-center">
                <img src="https://1000marcas.net/wp-content/uploads/2021/08/Novo-Nordisk-Logo.png" alt="Logo">
            </div>
            <form id="inicio" action="logica/ini_sesion.php" method="POST">
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><span class="iconify" data-icon="carbon:email"></span></span>
                        </div>
                        <input id="email" name="email" type="email" class="form-control" required placeholder="Correo Electrónico">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Contrasena">Contraseña</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><span class="iconify" data-icon="carbon:password"></span></span>
                        </div>
                        <input id="Contrasena" name="Contrasena" type="password" class="form-control" required placeholder="Contraseña">
                    </div>
                </div>
                <div class="text-center">
                    <input id="Inicio" name="Inicio" type="submit" value="Iniciar Sesión" class="btn btn-primary btn-block">
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="../bayerColombia/presentacion/form_restablecer_contrasena.php">¿Olvidaste tu contraseña?</a>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <p>&copy; <script>document.write(new Date().getFullYear())</script> Corporativo Overall. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>
