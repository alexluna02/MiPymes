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
    <!-- Barra Principal -->
    <div class="barra-principal">
        <div class="logo-container">
            <img src="{{ asset('Recursos/maqagro.jpg') }}" alt="logo" id="logo">
        </div>
        <nav>
            <ul>
                <li><a href="#">Clientes</a></li>
                <li><a href="#">Productos</a></li>
                <li><a href="#">Proveedores</a></li>
                <li><a href="#">Mantenimiento de Maquinarias</a></li>
            </ul>
        </nav>
        
        <div class="redes-sociales">
            <img src="{{ asset('Recursos/facebook.webp') }}" alt="Facebook" id="facebook">
            <img src="{{ asset('Recursos/tiktok.webp') }}" alt="TikTok" id="tiktok">
            <img src="{{ asset('Recursos/whatsap.jpg') }}" alt="WhatsApp" id="whatsapp">
        </div>
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
        <div class="slider-navigation">
            <a href="#" id="prev">&#10094;</a>
            <a href="#" id="next">&#10095;</a>
        </div>
    </div>

    <!-- Categorías -->
    <div class="categorias">
        <h1>CATEGORIAS</h1>
        <ul>
            <li><a href="#">Maquinaria</a></li>
            <li><a href="#">Repuestos</a></li>
            <li><a href="#">Aditivos</a></li>
            <li><a href="#">Accesorios sistema de riego</a></li>
            <li><a href="#">Varios</a></li>
        </ul>
    </div>

    <!-- Script para el Slider -->
    <script>
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


<div class="barra-busqueda">
    <input type="text" placeholder="Buscar...">
    <nav class ="botonbuscar">
    <button>Buscar </button>
    </nav>
</div>

</body>
</html>
