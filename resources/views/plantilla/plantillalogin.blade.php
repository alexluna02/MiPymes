<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//capp.nicepage.com/5af5658f5419992d134c0074488a3ffef48fba0f/nicepage.css" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
body {
    background: linear-gradient(to right, #006400, #8FBC8F); /* Degradado verde con toques naturales */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-family: 'Arial', sans-serif;
    margin: 0;
}

.login-container {
    background-color: rgba(255, 255, 255, 0.85); /* Fondo blanco semi-transparente para destacar el formulario */
    padding: 30px 40px;
    border-radius: 15px;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2); /* Sombras suaves para un toque futurista */
    width: 100%;
    max-width: 400px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.login-container:hover {
    transform: translateY(-10px); /* Efecto de elevación al pasar el mouse */
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3); /* Efecto de sombra más prominente */
}

.login-header h3 {
    font-size: 26px;
    font-weight: bold;
    color: #004d00; /* Verde oscuro, tono que recuerda a la naturaleza */
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.form-group {
    position: relative;
    margin-bottom: 20px;
}

.form-group label {
    font-size: 14px;
    font-weight: 600;
    color: #333;
    display: block;
    margin-bottom: 5px;
    letter-spacing: 0.5px;
}

.form-group .form-control {
    width: 100%;
    padding: 12px 40px 12px 40px; /* Espacio para los iconos */
    margin-top: 5px;
    border-radius: 30px;
    border: 1px solid #ccc;
    font-size: 16px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-group .form-control:focus {
    border-color: #66afe9; /* Color suave de enfoque */
    box-shadow: 0 0 10px rgba(0, 123, 255, 0.25);
}

.form-group i {
    position: absolute;
    top: 12px;
    left: 10px;
    font-size: 18px;
    color: #888;
}

.btn {
    font-size: 16px;
    padding: 12px 0;
    border-radius: 30px;
    cursor: pointer;
    width: 100%;
    margin: 10px 0;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn-primary {
    background-color: #2d7e2d; /* Verde con un toque brillante */
    border: none;
    color: white;
    font-weight: bold;
}

.btn-primary:hover {
    background-color: #4caf50;
    transform: translateY(-5px); /* Efecto de elevación en hover */
}

.btn-secondary {
    background-color: #8B4513; /* Marrón cálido para el botón de registrar */
    border: none;
    color: white;
    font-weight: bold;
}

.btn-secondary:hover {
    background-color: #7a3e1f;
    transform: translateY(-5px); /* Efecto de elevación en hover */
}

.social-btns {
    display: flex;
    justify-content: center;
    margin: 20px 0;
}

.social-btns a {
    font-size: 18px;
    margin: 0 10px;
    padding: 12px;
    border-radius: 50%;
    background-color: #3b5998; /* Facebook */
    color: white;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.social-btns a.twitter {
    background-color: #00acee; /* Twitter */
}

.social-btns a:hover {
    background-color: #555; /* Efecto de hover para redes sociales */
}

.forgot-password {
    font-size: 14px;
    color: #007bff;
    text-decoration: none;
}

.forgot-password:hover {
    text-decoration: underline;
}

.register-link {
    font-size: 14px;
    color: #007bff;
    margin-top: 15px;
    display: block;
}

.register-link:hover {
    text-decoration: underline;
}

@media (max-width: 480px) {
    .login-container {
        width: 90%;
        padding: 20px;
    }
}


    </style>
</head>
</head>

<body>
    @yield('content')
</body>

</html>
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        var password = document.querySelector('input[name="password"]').value;
        var passwordConfirmation = document.querySelector('input[name="password_confirmation"]').value;

        if (password !== passwordConfirmation) {
            event.preventDefault();
            alert('Las contraseñas no coinciden.');
        }
    });
</script>
