@extends('plantilla.plantilla')

@section('content')
   
    
    <!-- Header -->
    <header class="header">
        <div class="container">
            <h1>Bienvenidos a <span>Maq-Agro</span></h1>
            <p>Compra y Venta de Maquinaria Agrícola</p>
        </div>
    </header>



      
    <!-- About Us Section -->
    <section id="about" class="section">
        <div class="container">
            <h2>Sobre Nosotros</h2>
            <p>En <strong>Maq-Agro</strong>, nos dedicamos a ofrecer la mejor maquinaria agrícola para el sector. Con más de 10 años de experiencia en el mercado, trabajamos con los principales fabricantes de equipos agrícolas para ofrecer soluciones de alta calidad a nuestros clientes.</p>
            <div class="features">
                <div class="feature">
                    <i class="fas fa-tractor"></i>
                    <h3>Venta de Maquinaria</h3>
                    <p>Contamos con una amplia gama de maquinaria agrícola, desde tractores hasta sembradoras, para todos tus cultivos.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-sync-alt"></i>
                    <h3>Alquiler de Equipos</h3>
                    <p>Si no deseas comprar, también ofrecemos opciones de alquiler para equipos agrícolas en excelentes condiciones.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-cogs"></i>
                    <h3>Servicio Post-Venta</h3>
                    <p>Brindamos soporte técnico y mantenimiento especializado para asegurarnos de que tu maquinaria siempre esté en buen estado.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section">
        <div class="container">
            <h2>Contáctanos</h2>
            <form action="#" method="post" id="contact-form">
                <input type="text" id="name" name="name" placeholder="Tu nombre" required>
                <input type="email" id="email" name="email" placeholder="Tu correo electrónico" required>
                <textarea id="message" name="message" placeholder="Tu mensaje" required></textarea>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Maq-Agro | Todos los derechos reservados</p>
            <div class="social-icons">
                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevenir el comportamiento por defecto del formulario

            // Validar campos del formulario
            let name = document.getElementById('name').value;
            let email = document.getElementById('email').value;
            let message = document.getElementById('message').value;

            if (name === '' || email === '' || message === '') {
                alert('Por favor, completa todos los campos');
            } else {
                alert('Mensaje enviado correctamente');
                // Aquí podrías hacer una petición para enviar los datos
            }
        });
    </script>

@endsection
