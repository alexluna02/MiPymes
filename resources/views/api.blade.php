<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta API</title>
    <!-- Incluye jQuery desde una CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluye Bootstrap CSS desde una CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2>Consulta API</h2>
                        <button class="btn btn-primary" id="consultar-api">Consultar Usuarios</button>
                        <table class="table" id="resultado-api">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <!-- Añade más encabezados según los campos de tus datos -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Las filas de datos se añadirán aquí -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#consultar-api').click(function() {
                var token = localStorage.getItem('token');

                if (token) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://127.0.0.1:8000/api/users',
                        headers: {
                            'Authorization': 'Bearer ' + token
                        },
                        success: function(data) {
                            var tbody = $('#resultado-api tbody');
                            tbody.empty(); // Limpiar cualquier dato anterior

                            // Suponiendo que data es un array de objetos
                            data.forEach(function(item) {
                                var row = '<tr>';
                                row += '<td>' + item.id + '</td>';
                                row += '<td>' + item.name + '</td>';
                                row += '<td>' + item.email + '</td>';
                                // Añade más celdas según los campos de tus datos
                                row += '</tr>';
                                tbody.append(row);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                } else {
                    console.log('Token no encontrado en el almacenamiento local.');
                }
            });
        });
    </script>
</body>

</html>
