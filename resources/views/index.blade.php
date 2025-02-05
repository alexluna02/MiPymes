@extends('plantilla.plantilla')

<head>
    <meta name="description" content="Slider de imágenes inspirado en diseño agrícola" />
    <title>Diseño Agrícola</title>
    <link rel="stylesheet" href="{{ asset('CSS/index.css') }}">
</head>
@section('content')
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
            <!-- Navegación del Slider 
            <div class="slider-navigation">
                <a href="#" id="prev">&#10094;</a>
                <a href="#" id="next">&#10095;</a>
            </div>
        -->
        </section>
    </main>
@endsection
