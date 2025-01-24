@extends('plantilla.plantillalogin')
@section('content')
    <div class="login-container">
        <div class="login-header">
            <h3>Login de Usuario</h3>
        </div>
        <form method="POST" action="{{ route('iniciar-sesion') }}">
            @csrf
            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <a href="/registro" class="btn btn-danger btn-primary btn-block">Registrar</a>
            <!--<a class="btn btn-primary btn-xs" href="{{ route('registro') }}">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
            -->
        </form>
    </div>
@endsection

<script>
    // Función para manejar el evento popstate
    function handlePopState(event) {
        if (window.location.pathname === '/login') {
            history.pushState(null, null, window.location.href);
        }
    }

    // Añadir el evento popstate
    window.addEventListener('popstate', handlePopState);

    // Añadir una entrada al historial para la página de login
    if (window.location.pathname === '/login') {
        window.history.pushState(null, null, window.location.href);
    }
</script>

<script>
    // Añadir una entrada al historial para la URL actual
    window.history.pushState(null, "", window.location.href);

    // Manejar el evento popstate
    window.onpopstate = function(event) {
        // Añadir nuevamente una entrada al historial para la URL actual
        window.history.pushState(null, "", window.location.href);
    };

    // Interceptar el clic izquierdo en el botón de retroceso
    document.addEventListener('click', function(event) {
        if (event.button === 0 && event.target.tagName === 'A' && event.target.href ===
            'javascript:history.back()') {
            event.preventDefault();
            window.history.pushState(null, "", window.location.href);
        }
    });
</script>
