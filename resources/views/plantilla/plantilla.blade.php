<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, user-scalable=yes">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//capp.nicepage.com/5af5658f5419992d134c0074488a3ffef48fba0f/nicepage.css" media="screen">

</head>
<body>
    <!-- Barra Principal -->
    <div class="barra-principal">
        <div class="logo-container">
            <img src="{{ asset('Recursos/maqagro.jpg') }}" alt="logo" id="logo">
        </div>
        <nav>
            <ul class="u-nav u-spacing-30 u-unstyled u-nav-1">
                <li class="u-nav-item"><a class="u-border-2 u-border-active-palette-3-base u-border-hover-palette-3-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="/index" style="padding: 10px 0px;">Home</a></li>
                <li class="u-nav-item"><a class="u-border-2 u-border-active-palette-3-base u-border-hover-palette-3-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="/cliente" style="padding: 10px 0px;">Clientes</a></li>
                <li class="u-nav-item"><a class="u-border-2 u-border-active-palette-3-base u-border-hover-palette-3-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="/producto" style="padding: 10px 0px;">Productos</a></li>
                <li class="u-nav-item"><a class="u-border-2 u-border-active-palette-3-base u-border-hover-palette-3-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="/proveedor" style="padding: 10px 0px;">Proveedores</a></li>
                <li class="u-nav-item"><a class="u-border-2 u-border-active-palette-3-base u-border-hover-palette-3-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="/mantenimientomaquinaria" style="padding: 10px 0px;">Mantenimiento de Maquinarias</a></li>
                <li class="u-nav-item"><a class="u-border-2 u-border-active-palette-3-base u-border-hover-palette-3-base u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="/activity_log" style="padding: 10px 0px;">Auditoría</a></li>
            </ul>
        </nav>
        
        <div class="barra-busqueda">
            <input type="text" placeholder="Buscar...">
            <button type="submit">🔍</button>
        </div>

        <div class="redes-sociales">
            <img src="{{ asset('Recursos/facebook.webp') }}" alt="Facebook" id="facebook">
            <img src="{{ asset('Recursos/tiktok.webp') }}" alt="TikTok" id="tiktok">
            <img src="{{ asset('Recursos/whatsap.jpg') }}" alt="WhatsApp" id="whatsapp">
        </div>
    </div>

    <div class="contenedor-principal">
        <div class="categorias">
            <h1>CATEGORÍAS</h1>
            <ul>
                <li><a href="#" class="categoria" data-categoria="Maquinaria">🚜 Maquinaria</a></li>
                <li><a href="#" class="categoria" data-categoria="Repuestos">🔧 Repuestos</a></li>
                <li><a href="#" class="categoria" data-categoria="Aditivos">🧪 Aditivos</a></li>
                <li><a href="#" class="categoria" data-categoria="Accesorios de sistemas de riego">💧 Accesorios sistema de riego</a></li>
                <li><a href="#" class="categoria" data-categoria="Varios">📦 Varios</a></li>
            </ul>
        </div>

        <!-- Slider -->
        <header class="u-clearfix u-header u-header" id="sec-8087">
            <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
                <nav class="u-menu u-menu-one-level u-offcanvas u-menu-1" data-responsive-from="MD">
                    <div class="u-custom-menu u-nav-container">
                        <!-- Contenido adicional del menú si es necesario -->
                    </div>
                </nav>
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
    </div>
</body>

</html>
