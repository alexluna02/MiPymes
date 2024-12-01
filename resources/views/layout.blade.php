<html>

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrinkto-fit=no">
    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
</head>

<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="/home">Home</a></li>

                <h1>Michael Serrano</h1>
                <li><a href="/proveedor">Listado de Proveedores</a></li>
                <li><a href="/mantenimientomaquinaria">Listado de Mantenimiento</a></li>

                <h1>Alex Luna</h1>
                <li><a href="/cliente">Listado de Clientes</a></li>
                <li><a href="/producto">Listado de Productos</a></li>

                <h1>Sergio Pazmiño</h1>
                <li><a href="/metodo_pago">Listado de Metodos de Pago</a></li>
                <li><a href="/detalle_venta">Listado de Detalles de venta</a></li>

                <h1>Christian Yaselga</h1>
                <li><a href="/parametro">Listado de Parametros</a></li>
                <li><a href="/venta">Listado de Ventas</a></li>

                
                
            </ul>
        </nav>
        @yield('content')
    </div>
</body>

</html>