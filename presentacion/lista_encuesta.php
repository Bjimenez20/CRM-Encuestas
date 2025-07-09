<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable con PHP y MySQL</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <!-- DataTables Bootstrap Integration -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>

<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <h5 class="text-center mb-0">Listado de Encuestas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablaEncuestas" class="table table-hover table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Médico</th>
                                        <th>Encuesta Efectiva</th>
                                        <th>Encuesta</th>
                                        <th>Respuesta 1</th>
                                        <th>Respuesta 2</th>
                                        <th>Respuesta 3</th>
                                        <th>Respuesta 4</th>
                                        <th>Respuesta 5</th>
                                        <th>Motivo Encuesta no Efectiva</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="card-footer text-end bg-light">
                        <small class="text-muted">Actualizado el <span id="fechaActualizacion"></span></small>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Bootstrap Integration -->
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tablaEncuestas').DataTable({
                "ajax": {
                    "url": "../logica/listar_encuestas.php",
                    "type": "GET",
                    "dataSrc": "data"
                },
                "columns": [{
                        "data": "id_res"
                    },
                    {
                        "data": "nombre_completo",
                    },
                    {
                        "data": "encuesta_efectiva"
                    },
                    {
                        "data": "nombre_encuesta"
                    },
                    {
                        "data": "repuesta_1"
                    },
                    {
                        "data": "repuesta_2"
                    },
                    {
                        "data": "repuesta_3"
                    },
                    {
                        "data": "repuesta_4"
                    },
                    {
                        "data": "repuesta_5"
                    },
                    {
                        "data": "motivo_no_encuesta"
                    },
                    {
                        "data": "nota"
                    }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
                },
                "createdRow": function(row, data, dataIndex) {
                    if (data.nombre_encuesta == "Nuevas Especialidades") {
                        $('td', row).eq(8).addClass('highlight-red');
                    }
                    if (data.encuesta_efectiva !== "SI") {
                        $('td', row).slice(4, 9).addClass('highlight-red');
                    } else {
                        $('td', row).eq(9).addClass('highlight-red');
                        $('td', row).eq(10).addClass('highlight-red');
                    }
                }
            });
        });
    </script>

    <style>
        .highlight-red {
            background-color: #fdecea !important;
            color: #d9534f !important;
            font-weight: bold;
        }

        body {
            background-color: transparent;
        }

        .card-header {
            background: linear-gradient(90deg, #4e73df, #224abe);
        }

        .table-hover tbody tr:hover {
            background-color: #f1f5fc;
        }

        .card {
            border-radius: 1rem;
        }

        .card-footer {
            border-top: 1px solid #dee2e6;
        }

        @media (min-width: 992px) {
            .col-lg-10 {
                flex: 0 0 auto;
                width: 100%;
            }
        }
    </style>
</body>

</html>