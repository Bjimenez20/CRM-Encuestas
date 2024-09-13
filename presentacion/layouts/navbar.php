<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                    <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                    <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                </button>
            </div>
            <a class="navbar-brand font-weight-bold" href="javascript:;">Panel administrativo</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class=" dropdown">
                    <?php
                    if ($proveedor == 1) {
                        if ($privilegios == 1 or $privilegios == 3) {
                    ?>
                            <a class="nav-link" href="javascript:;" id="navbarDropdownBell" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="row-reverse">
                                    <div class="col p-0">
                                        <button type="button" class="btn bg-dark">
                                            <span class="mr-1">Notificaciones</span>
                                            <span class="badge badge-primary"><?= $num_total_registros ?></span>
                                        </button>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBell">
                                <a class="dropdown-item select_menu" href="../presentacion/form_listado_operador.php" target="info">
                                    <div class="row-reverse">
                                        <div class="col p-0">
                                            <span class="mr-1">Habilitar operador logistico</span>
                                            <?php
                                            if ($num_total_opl >= 1) {
                                            ?>
                                                <span class="badge badge-primary"><?= $num_total_opl ?></span>
                                            <?php
                                            } else {
                                            ?>
                                                <span></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item select_menu" href="../presentacion/form_listado_asegurador.php" target="info">
                                    <div class="row-reverse">
                                        <div class="col p-0">
                                            <span class="mr-1">Habilitar asegurador</span>
                                            <?php
                                            if ($num_total_asegurador >= 1) {
                                            ?>
                                                <span class="badge badge-primary"><?= $num_total_asegurador ?></span>
                                            <?php
                                            } else {
                                            ?>
                                                <span></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item select_menu" href="../presentacion/form_listado_ips.php" target="info">
                                    <div class="row-reverse">
                                        <div class="col p-0">
                                            <span class="mr-1">Habilitar IPS</span>
                                            <?php
                                            if ($num_total_ips >= 1) {
                                            ?>
                                                <span class="badge badge-primary"><?= $num_total_ips ?></span>
                                            <?php
                                            } else {
                                            ?>
                                                <span></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item select_menu" href="../presentacion/form_listado_medicos.php" target="info">
                                    <div class="row-reverse">
                                        <div class="col p-0">
                                            <span class="mr-1">Habilitar medicos</span>
                                            <?php
                                            if ($num_total_medicos >= 1) {
                                            ?>
                                                <span class="badge badge-primary"><?= $num_total_medicos ?></span>
                                            <?php
                                            } else {
                                            ?>
                                                <span></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item select_menu" href="../presentacion/form_listado_puntos.php" target="info">
                                    <div class="row-reverse">
                                        <div class="col p-0">
                                            <span class="mr-1">Habilitar puntos de entrega</span>
                                            <?php
                                            if ($num_total_puntos >= 1) {
                                            ?>
                                                <span class="badge badge-primary"><?= $num_total_puntos ?></span>
                                            <?php
                                            } else {
                                            ?>
                                                <span></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </li>
                <li class=" dropdown">
                    <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="row-reverse">
                            <div class="col d-flex justify-content-center"><i class="material-icons">person</i></div>
                            <div class="col" style="text-align: center;"><?= $nombre . '<br>' .  $apellido ?></div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="../presentacion/form_cuenta_usuario.php" target="info" id="navlink">Mi cuenta</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logica/cerrar_sesion.php">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>