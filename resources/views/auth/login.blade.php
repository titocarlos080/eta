<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EtaHansRoth</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
     <script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
    <style>
        body {
            background-color: #f5f5f5;
            /* Fondo gris claro para un aspecto más académico */
            background-image: url("https://img3.wallspic.com/crops/9/3/4/4/3/134439/134439-audiolibro-e_libro-3840x2160.jpg");
            /* Imagen de fondo educativa */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-logo a {
            color: #004d40;
            /* Color verde oscuro para el texto del logo */
            font-size: 2.5rem;
            /* Tamaño de fuente ligeramente mayor para el logo */
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.3);
            /* Sombra más sutil para el texto del logo */
        }

        .card {
            background-color: rgba(255, 255, 255, 0.3);
            /* Fondo blanco con opacidad */
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            /* Sombra más clara para el efecto de transparencia */
            border: none;
            /* Sin borde para mantener la transparencia */
        }

        .login-card-body {
            background-color: rgba(255, 255, 255, 0.7);
            /* Fondo del formulario con opacidad */
            border-radius: 12px;
            padding: 20px;
        }

        .btn-primary {
            background-color: #00796b;
            /* Color verde para el botón de inicio de sesión */
            border-color: #00796b;
        }

        .btn-primary:hover {
            background-color: #004d40;
            /* Color verde oscuro para el botón al pasar el ratón */
            border-color: #004d40;
        }

        .input-group-text {
            background-color: rgba(255, 255, 255, 0.7);
            /* Fondo del icono del input con opacidad */
        }

        .text-danger {
            color: #ff0000;
            /* Color rojo para los mensajes de error */
        }

        .login-box-msg {
            color: #004d40;
            /* Color verde oscuro para el texto del mensaje */
        }

        a {
            color: #00796b;
            /* Color verde para los enlaces */
        }

        a:hover {
            color: #004d40;
            /* Color verde oscuro para los enlaces al pasar el ratón */
        }
    </style>
</head>

<body>

    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>EtaHansRoth</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Iniciar Sesión</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                     
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Recordarme
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                        </div>
                    </div>
                </form>

                <p class="mb-1">
                    <a href="#">Olvidé mi contraseña</a>
                </p>

                <!-- Botón que reproducirá el sonido -->
                <button onclick="sonarError()">Reproducir Sonido</button>

                <script>
                    function sonarError() {
                        var audio = new Audio("{{ asset('vendor/adminlte/dist/sounds/error.mp3 ') }}");
                        audio.play();

                    }
                </script>

                <!-- <p class="mb-0">
                    <a href="#" class="text-center">Registrar un nuevo usuario</a>
                </p> -->
            </div>
        </div>
    </div>

</body>

</html>