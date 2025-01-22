<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Página Principal del Proyecto -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Slider de imágenes inspirado en diseño agrícola" />
    <title>Diseño Agrícola</title>
    <link rel="stylesheet" href="{{ asset('CSS/index.css') }}">
</head>
<body>
    <div class="row">
        <div class="btn-group">
          <form method="GET" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-warning btn-xs">Logout</button>
          </form>
        </div>
    </div>
    <div>@auth
        Sesion: {{Auth::user()->name}}
        Sesion: {{Auth::id()}}
    @endauth</div>
    <!-- Barra Principal -->
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
                <li><a href="/mantenimiento_maquinaria">Mantenimiento de Maquinarias</a></li>
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
        <h1>CATEGORIAS</h1>
        <ul>
            <li><a href="#" class="categoria" data-categoria="Maquinaria">🚜 Maquinaria</a></li>
            <li><a href="#" class="categoria" data-categoria="Repuestos">🔧 Repuestos</a></li>
            <li><a href="#" class="categoria" data-categoria="Aditivos">🧪 Aditivos</a></li>
            <li><a href="#" class="categoria" data-categoria="Accesorios de sistemas de riego">💧 Accesorios sistema de riego</a></li>
            <li><a href="#" class="categoria" data-categoria="Varios">📦 Varios</a></li>
        </ul>
    </div>

    <!-- Slider -->
    <div class="slider">
        <div class="slider-images">
            <img src="{{ asset('data1/images/foto1.jpg') }}" alt="Foto 1">
            <img src="{{ asset('data1/images/foto2.jpg') }}" alt="Foto 2">
            <img src="{{ asset('data1/images/foto3.jpg') }}" alt="Foto 3">
            <img src="{{ asset('data1/images/foto4.jpg') }}" alt="Foto 4">
            <img src="{{ asset('data1/images/foto5.jpg') }}" alt="Foto 5">
        </div>

        <div class="slider-message">
                <h1>Compra y Venta de Maquinaria Agrícola</h1>
                <p>Maq-Agro</p>
            </div>
        <div class="slider-navigation">
            <a href="#" id="prev">&#10094;</a>
            <a href="#" id="next">&#10095;</a>
        </div>
    </div>

    </div>
    <!-- Contenedor de productos -->
    <div id="productos-container">
        <!-- Aquí se mostrarán los productos filtrados -->
    </div>

    <!-- Script -->
    <script>
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

            slider.style.transform = translateX(-${currentIndex * 100}%);
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

        // Filtrar productos por categoría
        document.querySelectorAll('.categoria').forEach(categoria => {
            categoria.addEventListener('click', function (event) {
                event.preventDefault();

                const categoriaSeleccionada = this.getAttribute('data-categoria');
                const productosContainer = document.getElementById('productos-container');

                // Limpiar contenido anterior
                productosContainer.innerHTML = '<p>Cargando productos...</p>';

                // Petición AJAX
                fetch(${window.location.origin}/productos/categoria/${categoriaSeleccionada})
                    .then(response => {
                        console.log('Respuesta del servidor:', response);
                        if (!response.ok) {
                            throw new Error('Error en la respuesta del servidor');
                        }
                        return response.json();
                    })
                    .then(productos => {
                        // Mostrar productos
                        if (productos.length > 0) {
                            productosContainer.innerHTML = productos.map(producto => `
                                <div class="producto">
                                    <h3>${producto.nombre}</h3>
                                    <p>${producto.descripcion}</p>
                                    <p><strong>Precio:</strong> $${producto.precio}</p>
                                </div>
                            `).join('');
                        } else {
                            productosContainer.innerHTML = '<p>No hay productos en esta categoría.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Error al cargar los productos:', error);
                        productosContainer.innerHTML = '<p>Hubo un problema al cargar los productos. Intenta de nuevo más tarde.</p>';
                    });
            });
        });
    </script>
</body>
</html>