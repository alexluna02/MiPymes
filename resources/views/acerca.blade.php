@extends('plantilla.plantilla')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .header {
            background: #2c3e50;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        .header h1 span {
            color: #e74c3c;
        }
        .section {
            padding: 40px 0;
            text-align: center;
            background: white;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .features {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .feature {
            width: 30%;
            padding: 20px;
            background: #ecf0f1;
            margin: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .feature i {
            font-size: 30px;
            color: #e74c3c;
        }
        #contact-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #contact-form input, #contact-form textarea {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #contact-form button {
            background: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
        .social-icons a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
    </style>
    
    <header class="header"style="margin-left: 260px;">
        <div class="container">
            <h1>Bienvenidos a <span>Maq-Agro</span></h1>
            <p>Compra y Venta de Maquinaria Agrícola</p>
        </div>
    </header>

    <section id="about" class="section" style="margin-left: 260px; ">
        <div class="container">
            <h2>Sobre Nosotros</h2>
            <p>En <strong>Maq-Agro</strong>, nos dedicamos a ofrecer la mejor maquinaria agrícola para el sector...</p>
            <div class="features">
                <div class="feature">
                    <i class="fas fa-tractor"></i>
                    <h3>Venta de Maquinaria</h3>
                    <p>Contamos con una amplia gama de maquinaria agrícola...</p>
                </div>
                <div class="feature">
                    <i class="fas fa-sync-alt"></i>
                    <h3>Alquiler de Equipos</h3>
                    <p>Si no deseas comprar, también ofrecemos opciones de alquiler...</p>
                </div>
                <div class="feature">
                    <i class="fas fa-cogs"></i>
                    <h3>Servicio Post-Venta</h3>
                    <p>Brindamos soporte técnico y mantenimiento especializado...</p>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="section"style="margin-left: 260px;">
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

    <footer style="margin-left: 260px;">
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
            e.preventDefault();
            let name = document.getElementById('name').value;
            let email = document.getElementById('email').value;
            let message = document.getElementById('message').value;
            if (name === '' || email === '' || message === '') {
                alert('Por favor, completa todos los campos');
            } else {
                alert('Mensaje enviado correctamente');
            }
        });
    </script>
@endsection
