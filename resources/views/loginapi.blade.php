@extends('plantilla.plantillalogin')

<head>
    <title>Login API</title>
    <!-- Incluye jQuery desde una CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
@section('content')
    <div class="login-container">
        <div class="login-header">
            <h3>Login API de Usuario</h3>
        </div>
        <form id="login-form">
            @csrf
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <button id="login-button" type="button" class="btn btn-primary btn-block">Iniciar sesión</button>

        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#login-button').click(function(event) {
                event.preventDefault(); // Prevenir el comportamiento por defecto del formulario

                var email = $('#email').val();
                var password = $('#password').val();

                $.ajax({
                    type: 'POST',
                    url: 'http://127.0.0.1:8000/api/login', // Asegúrate de que la URL sea correcta
                    data: {
                        email: email,
                        password: password
                    },
                    success: function(data) {
                        var token = data.token;
                        localStorage.setItem('token', token);
                        console.log('Token guardado:', localStorage.getItem(
                            'token')); // Verificar que el token se guarda
                        window.location.href = 'http://127.0.0.1:8000/api/consultasapi';
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
