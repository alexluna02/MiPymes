<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, user-scalable=yes">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//capp.nicepage.com/5af5658f5419992d134c0074488a3ffef48fba0f/nicepage.css" media="screen">

    <link rel="stylesheet" href="{{ asset('CSS/index.css') }}">

</head>

<body>
    <header class="u-clearfix u-header u-header" id="sec-8087">
    <div class="barra-principal">
        <div class="logo-container">
            <img src="{{ asset('Recursos/maqagro.jpg') }}" alt="logo" id="logo">
        </div>
        <nav>
            <ul>
                <li><a href="/cliente">Clientes</a></li>
                <li><a href="/producto">Productos</a></li>
                <li><a href="/proveedor">Proveedores</a></li>
                <li><a href="/metodo_pago">Metodos de Pago</a></li>
                <li><a href="/parametro">⚙️Parametros⚙️</a></li>
                <li><a href="/venta">Ventas</a></li>
                <li><a href="/mantenimientomaquinaria">Mantenimiento de Maquinarias</a></li>
            </ul>
        </nav>
        
        <div class="redes-sociales">
        <a href="https://www.facebook.com/login/web/?cuid=AYj5jj70UJ31m83htD-nrnIwit8skBmmj8-qcZp-ZHbl4YWFN2Q7w6ouZyM_rxjW44HZxAbNfjpaSE09RoNGaAh_G-jd7FAuNySb7kwKYZZxBA&e=1348131">
          <img src="{{ asset('Recursos/facebook.webp') }}" alt="Facebook" id="facebook" style="cursor: pointer;">
        </a>

            <img src="{{ asset('Recursos/tiktok.webp') }}" alt="TikTok" id="tiktok">
            <img src="{{ asset('Recursos/whatsap.jpg') }}" alt="WhatsApp" id="whatsapp">
        </div>
    </div>
    </header>

    <div class="container-fluid" style="margin-top: 100px">

        @yield('content')
    </div>
    <style type="text/css">
        .table {
            border-top: 2px solid #ccc;

        }
    </style>
</body>

</html>