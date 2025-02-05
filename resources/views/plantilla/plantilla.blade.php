<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//capp.nicepage.com/5af5658f5419992d134c0074488a3ffef48fba0f/nicepage.css" media="screen">

    <link rel="stylesheet" href="{{ asset('CSS/index.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .dropdown-menu {
            background-color: rgb(70, 64, 64);
        }

        .dropdown-menu>.class-row {
            border: 1px solid #ddd;
            margin: 2px 0;
        }

        .dropdown-menu>.class-row>a,
        .dropdown-menu>.class-row>form>button {
            padding: 10px 15px;
            color: white;
            display: block;
            text-decoration: none;
        }

        .dropdown-menu>.class-row>form>button {
            background: none;
            border: none;
            width: 100%;
            text-align: left;
        }

        .dropdown-menu>.class-row>a:hover,
        .dropdown-menu>.class-row>form>button:hover {
            background-color: #555;
        }
    </style>

</head>

<body>

    <header class="barra-principal">
        <!-- Barra de búsqueda -->
        <div class="barra-busqueda"></div>

        <!-- Redes Sociales y Logout -->
        <div class="row">
            <div class="btn-group">
                <div class="redes-sociales">
                    <a href="#" title="Facebook"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" title="TikTok"><i class="fab fa-tiktok fa-2x"></i></a>
                    <a href="#" title="WhatsApp"><i class="fab fa-whatsapp fa-2x"></i></a>
                    <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('Recursos/candado.png') }}" alt="Configuraciones"
                            style="margin-right: 10px; margin-left:0px"></button>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="class-row"><a href="/index" class="dropdown-item">Perfil</a></div>
                        <div class="class-row">
                            <form method="GET" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                            </form>
                        </div>
                        <div class="class-row">
                            <form method="GET" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Cambiar de cuenta</button>
                            </form>
                        </div>
                    </div>
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
                @role('admin')
                <li><a href="/dashboard">🏠 Dashboard</a></li>
                @endrole
                @role('admin|vendedor')
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">📦 Productos</a>
                    <ul class="submenu">
                        <li><a href="/producto">📋 Ver Productos</a></li>
                        @role('admin')
                        <li><a href="/producto/create">➕ Añadir Productos</a></li>
                        @endrole
                    </ul>
                </li>
                @endrole
                @role('admin|vendedor')
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">📂 Clientes</a>
                    <ul class="submenu">
                        <li><a href="/cliente">📋 Ver Clientes</a></li>
                        <li><a href="/cliente/create">➕ Añadir Clientes</a></li>
                        <li><a href="#">✏️ Editar</a></li>
                    </ul>
                </li>
                @endrole
                @role('admin')
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">🛒 Proveedores</a>
                    <ul class="submenu">
                        <li><a href="/proveedor">📋 Ver Proveedor</a></li>
                        <li><a href="/proveedor/create">➕ Añadir Proveedor</a></li>
                    </ul>
                </li>
                @endrole
                @role('admin|vendedor')
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">🛒 Ventas</a>
                    <ul class="submenu">
                        <li><a href="/venta">📋 Ver Ventas</a></li>
                        <li><a href="/venta/create">➕ Crear Venta</a></li>
                    </ul>
                </li>
                @endrole
                @role('admin')
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">💳 Método de Pago</a>
                    <ul class="submenu">
                        <li><a href="/metodo_pago">📋 Métodos de Pago</a></li>
                        <li><a href="/metodo_pago/create">➕ Crear Método de Pago</a></li>
                    </ul>
                </li>
                @endrole
                @role('admin')
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">⚙️ Parámetros</a>
                    <ul class="submenu">
                        <li><a href="/parametro">📋 Ver Parámetros</a></li>
                        <li><a href="/parametro/create">➕ Crear Parámetro</a></li>
                    </ul>
                </li>
                @endrole
                @role('admin|vendedor')
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">🔧 Mantenimiento</a>
                    <ul class="submenu">
                        <li><a href="/mantenimientomaquinaria">📋 Mantenimiento de Maquinarias</a></li>
                        <li><a href="/mantenimientomaquinaria/create">➕ Añadir Mantenimiento</a></li>
                    </ul>
                </li>
                @endrole
                @role('admin|vendedor')
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">🔧 Repuestos</a>
                    <ul class="submenu">
                        <li><a href="/repuesto">📋 Repuestos</a></li>
                        @role("admin")
                        <li><a href="/mantenimientomaquinaria/create">➕ Añadir Repuestos</a></li>
                        @endrole
                    </ul>
                </li>
                @endrole
                @role('admin')
                <li>
                    <a href="/activity_log">Auditoría</a>
                </li>
                @endrole
                <li><a href="#" onclick="toggleSubmenu(event)">👤 Perfil</a></li>
            </ul>
        </nav>

    </aside>

        @yield('content')
    
    <style type="text/css">
        .table {
            border-top: 2px solid #ccc;
        }

        /*
        .text-container {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
            
        }*/

        .text-container {
            max-width: 200px;
            /* Ajusta el ancho máximo según sea necesario */
            max-height: 100px;
            /* Ajusta la altura máxima según sea necesario */
            overflow: auto;
            /* Añade barras de desplazamiento si es necesario */
            white-space: pre-wrap;
            /* Permite que el texto se divida en varias líneas */
            word-wrap: break-word;
            /* Permite que las palabras largas se dividan y se ajusten al contenedor */
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script>
        function toggleSubmenu(event) {
            event.preventDefault();
            const parent = event.target.parentElement;
            parent.classList.toggle('active');
        }
        // Función para mostrar/ocultar submenús
        function toggleSubmenu(event) {
            event.preventDefault();
            const parent = event.target.parentElement;
            parent.classList.toggle('active');
        }

        // Slider
        let currentIndex = 0;
        const images = document.querySelectorAll('.slider-images img');
        const totalImages = images.length;
        const slider = document.querySelector('.slider-images');

        function showImage(index) {
            if (index >= totalImages) {
                currentIndex = 0;
            } else if (index < 0) {
                currentIndex = totalImages - 1;
            } else {
                currentIndex = index;
            }
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        document.getElementById('prev').addEventListener('click', (event) => {
            event.preventDefault();
            showImage(currentIndex - 1);
        });

        document.getElementById('next').addEventListener('click', (event) => {
            event.preventDefault();
            showImage(currentIndex + 1);
        });

        setInterval(() => {
            showImage(currentIndex + 1);
        }, 5000);

        showImage(currentIndex);
    </script>
</body>

</html>
