<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metadatos de la Página -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Slider de imágenes inspirado en diseño agrícola" />
    <title>Diseño Agrícola</title>
    <link rel="stylesheet" href="{{ asset('CSS/index.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>

<body>
    <!-- Barra Principal -->
    <header class="barra-principal">
        <!-- Barra de búsqueda -->
        <div class="barra-busqueda"></div>

        <!-- Redes Sociales y Logout -->
        <div class="row">
            <div class="btn-group">
                <div class="redes-sociales">
                    <a href="https://www.facebook.com/MaqAgroMultirepuestos" title="Facebook"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" title="TikTok"><i class="fab fa-tiktok fa-2x"></i></a>
                    <a href="https://w.app/maqagro" title="WhatsApp"><i class="fab fa-whatsapp fa-2x"></i></a>

                    <form method="GET" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-xs"> <img
                                src="{{ asset('Recursos/candado.png') }}" alt="Foto 2"></button>
                    </form>

        </div>
    </header>

    <!-- Barra Lateral -->
    <aside class="sidebar">
        <!-- Logo -->
        <div class="logo-container">
            <h1>MAQ - AGRO 🌱</h1>
        </div>

        <!-- Menú de Navegación -->
        <nav class="menu">
            <ul>
                <li><a href="/index" >🏠 Inicio</a></li>

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
                @hasanyrole('admin|vendedor')
                <li>
                    <a href="#" onclick="toggleSubmenu(event)">🛒 Ventas</a>
                    <ul class="submenu">
                        <li><a href="/venta">📋 Ver Ventas</a></li>
                        <li><a href="/venta/create">➕ Crear Venta</a></li>
                    </ul>
                </li>
                @endhasanyrole
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

    <!-- Contenido Principal -->
    <main class="contenedor-principal">
        <section class="slider">
            <!-- Imágenes del Slider -->
            <div class="slider-images">
                <img src="{{ asset('data1/images/foto2.jpg') }}" alt="Foto 2">
                <img src="{{ asset('data1/images/foto3.jpg') }}" alt="Foto 3">
                <img src="{{ asset('data1/images/foto4.jpg') }}" alt="Foto 4">
                <img src="{{ asset('data1/images/foto5.jpg') }}" alt="Foto 5">
            </div>

            <!-- Mensaje del Slider -->
            <div class="slider-message">
                <h1>Compra y Venta de Maquinaria Agrícola</h1>
                <p>Maq-Agro</p>
            </div>

            <!-- Navegación del Slider -->
            <div class="slider-navigation">
                <a href="#" id="prev">&#10094;</a>
                <a href="#" id="next">&#10095;</a>
            </div>
        </section>
    </main>

    <!-- Scripts -->
    <script>
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