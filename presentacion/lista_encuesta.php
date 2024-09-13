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

        <table id="tablaEncuestas" class="display table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Encuestado </th>
                    <th>Tipo de Documento Encuestado </th>
                    <th>Numero de Documento Encuestado </th>
                    <th>Telefono Encuestado </th>
                    <th>Dirección Encuestado </th>
                    <th>Pregunta 1 </th>
                    <th>Pregunta 2 </th>
                    <th>Pregunta 3 </th>
                    <th>Pregunta 4 </th>
                    <th>Pregunta 5</th>
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

    <script>
        $(document).ready(function() {
            $('#tablaEncuestas').DataTable({
                "ajax": {
                    "url": "../logica/listar_encuestas.php", // Cambia a la URL de tu archivo PHP que sirve los datos
                    "type": "GET",
                    "dataSrc": "data" // Ruta en el JSON donde están los datos
                },
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "nombre_encuestado"
                    },
                    {
                        "data": "tipo_documento_encuestado"
                    },
                    {
                        "data": "numero_documento_encuestado"
                    },
                    {
                        "data": "telefono_encuestado"
                    },
                    {
                        "data": "direccion_encuestado"
                    },
                    {
                        "data": "satisfaccion"
                    },
                    {
                        "data": "recomendarias"
                    },
                    {
                        "data": "mejora"
                    },
                    {
                        "data": "contacto"
                    },
                    {
                        "data": "origen"
                    }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
                }
            });
        });
    </script>

</body>

</html>