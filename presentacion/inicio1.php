<?php
include('../logica/session.php');

include 'layouts/head.php'; ?>

<link rel="stylesheet" href="css/menu.css" />
<link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
<link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
<!-- <link rel="stylesheet" href="../presentacion/css/menu.css" />  -->

<script src="js/jquery.js"></script>
<script src="../presentacion/js/jquery.js"></script>
<script>
    var height = window.innerHeight - 2;
    var porh = (height * 74 / 100);
    $(document).ready(function() {
        $('#info').css('height', porh);
    });
</script>
<style>
    .div_menu {
        margin: 0px auto;
        width: 855px;
        font-family: Tahoma, Geneva, sans-serif;
        background-color: #035da3;
        margin: auto auto;
        margin-top: 15%;
        padding: 5px;
    }
</style>
<?php
if ($privilegios != '' && $usua != '') {
?>
    <!-- Sidebar -->
    <?php include('layouts/sidebar.php'); ?>
    <!-- /.Sidebar -->

    <div class="main-panel">

        <!-- Navbar -->
        <?php include('layouts/navbar.php'); ?>
        <!-- /.navbar -->
        <?php
        if ($privilegios == 1) {
            $PERFIL = 'ADMINISTRADOR';
        }
        ?>
        <div class="content">
            <div class="content">
                <div class="container-fluid">

                    <div id="content_welcome">
                        <div class="row-reverse">
                            <div class="col d-flex justify-content-center">
                                <img src="./../presentacion/imagenes/Novo-Nordisk-Logo-1.png" alt="">
                            </div>
                            <!-- <div class="col d-flex justify-content-center" style="margin-top: 3%;">
                                <label for="" class="h2 font-weight-bold">CRM ENCUESTAS</label>
                            </div> -->
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="card text-center cardhome">
                                    <div class="overflow-hidden position-relative border-radius-lg bg-cover p-3" style="background-image: url('./../presentacion/imagenes/cardhome2.png')">
                                        <span class="mask bg-gradient-dark opacity-6"></span>
                                        <div class="card-body position-relative z-index-1 d-flex flex-column mt-5">
                                            <p class="text-white font-weight-bold h3">ENCUESTAS</p>
                                            <a class="select_menu text-white text-sm font-weight-bold mb-0 icon-move-right mt-4" href="../presentacion/form_paciente_seguimiento.php" target="info">
                                                Ver más
                                                <i class="material-icons text-sm ms-1 position-relative" aria-hidden="true">arrow_forward</i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center cardhome">
                                    <div class="overflow-hidden position-relative border-radius-lg bg-cover p-3" style="background-image: url('./../presentacion/imagenes/cardhome3.png')">
                                        <span class="mask bg-gradient-dark opacity-6"></span>
                                        <div class="card-body position-relative z-index-1 d-flex flex-column mt-5">
                                            <p class="text-white font-weight-bold h3">REPORTES</p>
                                            <a class="select_menu text-white text-sm font-weight-bold mb-0 icon-move-right mt-4" href="../presentacion/scriptcase.php" target="info">
                                                Ver más
                                                <i class="material-icons text-sm ms-1 position-relative" aria-hidden="true">arrow_forward</i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <iframe name="info" id="info" frameborder="0" width="100%" height="100%" style="display: none"></iframe>
            </div>
        </div>
    </div>
    <script>
        $('.select_menu').click(function() {
            $('#info').show('slow');
            $('#content_welcome').hide('slow')
        })
    </script>

    <style>
        .cardhome {
            transition: transform .2s;
            cursor: pointer;
        }

        .cardhome:hover {
            transform: scale(1.1);
        }
    </style>


    <?php include 'layouts/footer.php'; ?>

    <?php include 'layouts/end.php'; ?>

<?php
} else {
?>
    <script type="text/javascript">
        window.onload = window.top.location.href = "../logica/cerrar_sesion2.php";
    </script>
<?php
}
?>