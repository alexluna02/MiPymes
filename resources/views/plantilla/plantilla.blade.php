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
   
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <link rel="stylesheet" href="{{ asset('CSS/crudd.css') }}">


</head>

<body>
     
<header class="barra-principal">
        <div class="barra-busqueda"></div>

        <!-- Redes Sociales y Logout -->
        <div class="row">
            <div class="btn-group">
             <div class="redes-sociales">
             <a href="#" title="Facebook"><i class="fab fa-facebook fa-2x"></i></a>
             <a href="#" title="TikTok"><i class="fab fa-tiktok fa-2x"></i></a>
             <a href="#" title="WhatsApp"><i class="fab fa-whatsapp fa-2x"></i></a>

                <form method="GET" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-xs"> <img src="{{ asset('Recursos/candado.png') }}" alt="Foto 2"></button>
                </form>
            
        </div>
</header>
    <aside class="sidebar">
        <!-- Logo -->
        <div class="logo-container">
            <h1>MAQ - AGRO 🌱</h1>
        </div>

        <!-- Menú de Navegación -->
        <nav class="menu">
            <ul>
            <li><a href="/index">Inicio</a></li>
            <li><a href="/dashboard" >🏠 Dashboard</a></li>
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">📦 Productos</a>
                    <ul class="submenu">
                        <li><a href="/producto">📋 Ver Productos</a></li>
                        <li><a href="/producto/create">➕ Añadir Productos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">📂 Clientes</a>
                    <ul class="submenu">
                        <li><a href="/cliente">📋 Ver Clientes</a></li>
                        <li><a href="/cliente/create">➕ Añadir Clientes</a></li>
                        <li><a href="#">✏️ Editar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">🛒 Proveedores</a>
                    <ul class="submenu">
                        <li><a href="/proveedor">📋 Ver Proveedor</a></li>
                        <li><a href="/proveedor/create">➕ Añadir Proveedor</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">🛒 Ventas</a>
                    <ul class="submenu">
                        <li><a href="/venta">📋 Ver Ventas</a></li>
                        <li><a href="/venta/create">➕ Crear Venta</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">💳 Método de Pago</a>
                    <ul class="submenu">
                        <li><a href="/metodo_pago">📋 Métodos de Pago</a></li>
                        <li><a href="/metodo_pago/create">➕ Crear Método de Pago</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">⚙️ Parámetros</a>
                    <ul class="submenu">
                        <li><a href="/parametro">📋 Ver Parámetros</a></li>
                        <li><a href="/parametro/create">➕ Crear Parámetro</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">🔧 Mantenimiento</a>
                    <ul class="submenu">
                        <li><a href="/mantenimientomaquinaria">📋 Mantenimiento de Maquinarias</a></li>
                        <li><a href="/mantenimientomaquinaria/create">➕ Añadir Mantenimiento</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#" onclick="toggleSubmenu(event)">🔧 Repuestos</a>
                    <ul class="submenu">
                        <li><a href="/repuesto">📋 Repuestos</a></li>
                    </ul>
                </li>


                <li><a href="#" onclick="toggleSubmenu(event)">👤 Perfil</a></li>
            </ul>
        </nav>

    </aside>

    <div class="container-fluid" style="margin-top: 100px">

        @yield('content')
    </div>

    <script>
    function toggleSubmenu(event) {
            event.preventDefault();
            const parent = event.target.parentElement;
            parent.classList.toggle('active');
        }
        </script>
    <style type="text/css">
        .table {
            border-top: 2px solid #ccc;

        }
    </style>
</body>

</html>