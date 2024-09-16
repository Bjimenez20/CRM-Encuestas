<?php include('../../logica/session.php');
if ($privilegios == 1) {
    $PERFIL = 'ADMINISTRADOR';
}
?>

<div class="sidebar" style="background: #0C68B0">
    <div class="logo">
        <div class="row">
            <div class="col " style="display: none" id="logo_mini">
                <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                    <img src="./../presentacion/imagenes/Novo-Nordisk-Logo-1.png" alt="" class="w-100">
                </a>
                <div class="col d-flex justify-content-center">
                    <label class="text-white" style="font-size: 9px;"><?= $PERFIL ?></label>
                </div>
            </div>
            <div class="col d-flex justify-content-center">
                <a href="#" class="simple-text logo-normal">
                    <div class="row-reverse">
                        <div class="col">
                            <img src="./../presentacion/imagenes/Novo-Nordisk-Logo-1.png" alt="" class="w-60" id="logo_max">
                        </div>
                        <div class="col d-flex justify-content-center">
                            <label class="text-white ">CRM Encuestas</label>
                        </div>
                        <div class="col d-flex justify-content-center">
                            <label class="text-white "><?= $PERFIL ?></label>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#minimizeSidebar').click(function() {
                $('#logo_mini').toggle();
            })
        })
    </script>
    <div class="sidebar-wrapper" style="max-height: 70vh; overflow-x: hidden">
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="javascript:;" onclick="call_back()">
                    <i class="material-icons">home</i>
                    <p> Inicio </p>
                </a>
            </li>
            <script>
                function call_back() {
                    var iframe = document.getElementById('info');
                    iframe.src = '';

                    $('#info').hide('slow');
                    $('#content_welcome').show('slow');
                }
            </script>
            <li class="nav-item select_menu">
                <a class="nav-link" href="../presentacion/encuesta.php" target="info">
                    <i class="material-icons">assignment</i>
                    <p> Encuesta </p>
                </a>
            </li>
            <li class="nav-item select_menu">
                <a class="nav-link" href="../presentacion/lista_encuesta.php" target="info">
                    <i class="material-icons">list</i>
                    <p> Respuestas </p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#pagesExamples3">
                    <i class="material-icons">pie_chart</i>
                    <p> Reportes
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesExamples3">
                    <ul class="nav">
                        <li class="nav-item select_menu">
                            <a class="nav-link" href="../presentacion/reporte_bi.php" target="info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="material-icons">leaderboard </i>
                                <span class="sidebar-normal"> BI </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#pagesExamples4">
                    <i class="material-icons">settings</i>
                    <p> Configuracion
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesExamples4">
                    <ul class="nav">
                        <li class="nav-item select_menu">
                            <a class="nav-link" href="../presentacion/form_registrar.php" target="info">
                                <i class="material-icons">group_add</i>
                                <span class="sidebar-normal"> Registrar usuarios </span>
                            </a>
                        </li>
                        <li class="nav-item select_menu">
                            <a class="nav-link" href="../presentacion/form_usuarios.php" target="info">
                                <i class="material-icons">group_add</i>
                                <span class="sidebar-normal"> Usuarios </span>
                            </a>
                        </li>
                        <li class="nav-item select_menu">
                            <a class="nav-link" href="../presentacion/form_cuenta_usuario.php" target="info">
                                <i class="material-icons">person</i>
                                <span class="sidebar-normal"> Mi cuenta </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link logout" href="../logica/cerrar_sesion.php">
                    <i class="material-icons">logout</i>
                    <p> Cerrar sesion </p>
                </a>
                <style>
                    .logout:hover {
                        color: white !important;
                        font-weight: 700;
                        text-shadow: 1px 1px 2px black;
                    }
                </style>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="https://www.peoplemarketing.com/" target="_blank">
                    <img src="./../presentacion/layouts/img/overall.png" alt="" class="w-100">
                </a>
            </li>
        </ul>
    </div>
</div>