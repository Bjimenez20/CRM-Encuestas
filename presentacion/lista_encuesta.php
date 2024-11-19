<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable con PHP y MySQL</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Listado de Encuestas</h1>

        <table id="tablaEncuestas" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Encuestado </th>
                    <th>Encuesta </th>
                    <th>Respuesta 1 </th>
                    <th>Respuesta 2 </th>
                    <th>Respuesta 3 </th>
                    <th>Respuesta 4 </th>
                    <th>Respuesta 5 </th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .highlight-red {
            background-color: red;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#tablaEncuestas').DataTable({
                "ajax": {
                    "url": "../logica/listar_encuestas.php", // Cambia a la URL de tu archivo PHP que sirve los datos
                    "type": "GET",
                    "dataSrc": "data" // Ruta en el JSON donde están los datos
                },
                "columns": [{
                        "data": "id_res"
                    },
                    {
                        "data": "nombre"
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
                    }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
                },
                "createdRow": function(row, data, dataIndex) {
                    // Verificar si el nombre_encuesta es igual a "Cuestionario 1"
                    if (data.nombre_encuesta != "Cuestionario 3") {
                        // Cambiar las respuestas a "X"
                        $('td', row).eq(6).text('X').addClass('highlight-red');; // Columna repuesta_4
                        $('td', row).eq(7).text('X'); // Columna repuesta_5
                    }
                }
            });
        });
    </script>


</body>

</html>