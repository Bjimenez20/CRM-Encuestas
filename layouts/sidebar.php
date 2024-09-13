<div class="sidebar" style="background: #0C68B0">
    <div class="logo">
        <div class="row">
            <div class="col " style="display: none" id="logo_mini">
                <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                    <img src="./../presentacion/imagenes/Novo-Nordisk-Logo-1.png" alt="" class="w-100">
                </a>
            </div>
            <div class="col d-flex justify-content-center">
                <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                    <div class="row-reverse">
                        <div class="col">
                            <img src="./../presentacion/imagenes/Novo-Nordisk-Logo-1.png" alt="" id="logo_max">
                        </div>
                        <div class="col d-flex justify-content-center">
                            <label for="" class="text-white ">Bayer Contigo Colombia</label>
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
            <?php
            if ($privilegios == '1') {
            ?>
                <li class="nav-item ">
                    <a class="nav-link" data-toggle="collapse" href="#pagesExamples1">
                        <i class="material-icons">menu_book</i>
                        <p> Novedades
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="pagesExamples1">
                        <ul class="nav">
                            <li class="nav-item select_menu">
                                <a class="nav-link" href="../presentacion/novedades_registro.php" target="info">
                                    <span class="sidebar-mini"> P </span>
                                    <span class="sidebar-normal"> Registro novedad </span>
                                </a>
                            </li>
                            <li class="nav-item select_menu">
                                <a class="nav-link" href="../presentacion/novedades_correo.php" target="info">
                                    <span class="sidebar-mini"> RS </span>
                                    <span class="sidebar-normal"> Consulta novedad </span>
                                </a>
                            </li>
                            <li class="nav-item select_menu">
                                <a class="nav-link" href="../informes/grid_novedades" target="info">
                                    <span class="sidebar-mini"> T </span>
                                    <span class="sidebar-normal"> Reporte novedad </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php } ?>
            <li class="nav-item select_menu">
                <a class="nav-link" href="../presentacion/form_paciente_nuevo.php" target="info">
                    <i class="material-icons">person_add</i>
                    <p> Paciente nuevo </p>
                </a>
            </li>
            <li class="nav-item select_menu">
                <a class="nav-link" href="../presentacion/form_paciente_seguimiento.php" target="info">
                    <i class="material-icons">badge</i>
                    <p> Seguimiento </p>
                </a>
            </li>
            <?php
            if ($privilegios == '1') {
            ?>
                <li class="nav-item ">
                    <a class="nav-link" data-toggle="collapse" href="#pagesExamples2">
                        <i class="material-icons">image</i>
                        <p> Productos
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="pagesExamples2">
                        <ul class="nav">
                            <li class="nav-item select_menu">
                                <a class="nav-link" href="../presentacion/form_registro_material.php" target="info">
                                    <span class="sidebar-mini"> P </span>
                                    <span class="sidebar-normal"> Registro material </span>
                                </a>
                            </li>
                            <li class="nav-item select_menu">
                                <a class="nav-link" href="../presentacion/form_inventario.php" target="info">
                                    <span class="sidebar-mini"> RS </span>
                                    <span class="sidebar-normal"> INVENTARIO </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php
            }
            ?>
            <?php
            if ($privilegios == '1') {
            ?>
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
                                <a class="nav-link" href="../presentacion/form_reporte.php" target="info">
                                    <span class="sidebar-mini"> P </span>
                                    <span class="sidebar-normal"> Filtro por tabla </span>
                                </a>
                            </li>
                            <li class="nav-item select_menu">
                                <a class="nav-link" href="../new_scriptcase/20220614174528" target="info">
                                    <span class="sidebar-mini"> RS </span>
                                    <span class="sidebar-normal"> Otros reportes </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php
            } elseif ($privilegios == '2') {
            ?>
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
                                <a class="nav-link" href="../SCRIPTCASE/new_scriptcase" target="info">
                                    <span class="sidebar-mini"> RS </span>
                                    <span class="sidebar-normal"> Reporte causal conteo </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php } ?>
            <?php
            if ($privilegios == '1') {
                if ($usua == 'ADMIN' || $usua == 'YRAMIREZ') {
            ?>
                    <li class="nav-item ">
                        <a class="nav-link" data-toggle="collapse" href="#pagesExamples4">
                            <i class="material-icons">settings</i>
                            <p> Configuración
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="pagesExamples4">
                            <ul class="nav">
                                <li class="nav-item select_menu">
                                    <a class="nav-link" href="../presentacion/form_cargar_observacion_fundem.php" target="info">
                                        <span class="sidebar-mini"> RS </span>
                                        <span class="sidebar-normal"> Gestiones FUNDEM </span>
                                    </a>
                                </li>
                                <li class="nav-item select_menu">
                                    <a class="nav-link" href="../presentacion/form_cambio_contacto_fundem.php" target="info">
                                        <span class="sidebar-mini"> RS </span>
                                        <span class="sidebar-normal"> Cambio de fecha </span>
                                    </a>
                                </li>
                                <li class="nav-item select_menu">
                                    <a class="nav-link" href="../presentacion/form_asignacion_gestiones.php" target="info">
                                        <span class="sidebar-mini"> RS </span>
                                        <span class="sidebar-normal"> Asignaci贸n </span>
                                    </a>
                                </li>
                                
                                <li class="nav-item select_menu">
                                    <a class="nav-link" href="../presentacion/form_usuarios.php" target="info">
                                        <span class="sidebar-mini"> RS </span>
                                        <span class="sidebar-normal"> Usuarios </span>
                                    </a>
                                </li>
                                
                                <li class="nav-item select_menu">
                                    <a class="nav-link" href="../presentacion/form_cuenta_usuario.php" target="info">
                                        <span class="sidebar-mini"> RS </span>
                                        <span class="sidebar-normal"> Mi cuenta </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item ">
                        <a class="nav-link" data-toggle="collapse" href="#pagesExamples5">
                            <i class="material-icons">settings</i>
                            <p> Configuración
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="pagesExamples5">
                            <ul class="nav">
                                <li class="nav-item select_menu">
                                    <a class="nav-link" href="../presentacion/form_cuenta_usuario.php" target="info">
                                        <span class="sidebar-mini"> P </span>
                                        <span class="sidebar-normal"> Mi cuenta </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
            <?php
                }
            }
            ?>

            <li class="nav-item ">
                <a class="nav-link logout" href="../logica/cerrar_sesion.php">
                    <i class="material-icons">logout</i>
                    <p> Cerrar sesión </p>
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
                    <img src="./../presentacion/layouts/img/people.png" alt="" class="w-100">
                </a>
            </li>
        </ul>
    </div>
</div>