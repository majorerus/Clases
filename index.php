<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="favicon.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <style>
        body {
            background-color: #f0f4f7; /* Fondo suave */
        }

        .login-container {
            background-color: #ffffff; /* Fondo blanco para el contenedor */
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            padding: 30px; /* Espaciado interno */
        }

        h2 {
            color: #4CAF50; /* Tono verde para el encabezado */
        }

        .form-control {
            border: 1px solid #4CAF50; /* Borde verde */
        }

        .form-control:focus {
            border-color: #388E3C; /* Color del borde al enfocar */
            box-shadow: 0 0 5px rgba(56, 142, 60, 0.5); /* Sombra verde suave al enfocar */
        }

        .btn-primary {
            background-color: #4CAF50; /* Color del botón */
            border: none; /* Sin borde */
        }

        .btn-primary:hover {
            background-color: #388E3C; /* Color del botón al pasar el ratón */
        }

        .form-label {
            color: #4CAF50; /* Color verde para las etiquetas */
        }

        /* Estilo para el iframe del video */
        .video-container {
            margin-bottom: 20px; /* Espacio debajo del video */
            text-align: center; /* Centrar el video */
        }
    </style>
</head>
<body>
    <br><br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 login-container">
                <h2 class="text-center mb-4">Iniciar Sesión</h2>

                <div class="video-container">
                    <iframe width="100%" height="315" 
                        src="https://www.youtube.com/embed/1HPx__YdO8k?autoplay=1&mute=1&controls=0" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin" 
                        allowfullscreen>
                    </iframe>
                </div>

                <form action="logon.php" method="GET">
                    <div class="mb-3">
                        <label for="login_tipo" class="form-label">Selecciona el tipo de login:</label>
                        <select class="form-control" id="login_tipo" name="login_tipo" required>
                            <option value="email">Email</option>
                            <option value="documento_numero">DNI</option>
                            <option value="nie">NIE</option>
                            <option value="login">Usuario</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Continuar</button>
                </form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
