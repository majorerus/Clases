<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir valores del formulario
    $loginTipo = $_POST['login_tipo'] ?? '';  // Verifica si se recibió 'login_tipo'
    $contraseña = $_POST['contrasena'] ?? '';  // Verifica si se recibió 'contrasena'
    $cred = $_POST['credenciales'] ?? '';  // Verifica si se recibió 'credenciales'

    // Validar que loginTipo no esté vacío
    if (empty($loginTipo)) {
        echo "<p class='text-danger'>El tipo de login no puede estar vacío.</p>";
        exit;
    }

    // Validar que el valor de loginTipo sea uno de los permitidos
    $validLoginTypes = ['email', 'documento_numero', 'nie', 'login'];
    if (!in_array($loginTipo, $validLoginTypes)) {
        echo "<p class='text-danger'>Tipo de login no válido.</p>";
        exit;
    }

    // Limpiar las entradas para prevenir inyecciones SQL
    $contraseña = $conn->real_escape_string(trim($contraseña));
    $cred = $conn->real_escape_string(trim($cred));

    // Crear la consulta SQL de forma segura
    $query = "SELECT * FROM usuarios WHERE $loginTipo = '$cred' AND contrasena = '$contraseña'";
    // Verificar que la consulta está construida correctamente
    echo "Consulta generada: " . $query; // Esto es solo para depuración

    // Ejecutar la consulta
    $result = $conn->query($query);

    // Verificar si la consulta devolvió algún resultado
    if ($result && $result->num_rows > 0) {
        // Usuario y contraseña correctos, iniciar sesión
        session_start();

        // Obtener los datos del usuario desde la consulta
        $user = $result->fetch_assoc();

        // Almacenar información relevante en la sesión
        $_SESSION['dni'] = $user['dni'];  // Aquí almacenamos solo el DNI
        $_SESSION['nombre'] = $user['nombre'];  // Almacenamos el nombre
        $_SESSION['email'] = $user['email'];  // Almacenamos el email
        $_SESSION['puntos'] = $user['puntos'];  // Almacenamos los puntos si es necesario
        $_SESSION['foto'] = $user['foto'];  // Almacenamos la foto si es necesario
        $_SESSION['documento_numero'] = $user['documento_numero'];
        $_SESSION['puntos'] = $user['puntos'];  // Almacenamos los puntos
        // Redirigir al usuario a la página principal
        header("Location: principal.php");
        exit;
    } else {
        // DNI o contraseña incorrectos
        echo "<p class='text-danger'>DNI o contraseña incorrectos.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BinterMas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="favicon.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <style>
        body {
            background-color: #f0f4f7; /* Fondo suave */
        }

        .form-container {
            background-color: #ffffff; /* Fondo blanco para el contenedor */
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            padding: 30px; /* Espaciado interno */
            max-width: 400px; /* Ancho máximo */
            margin: auto; /* Centrar el contenedor */
        }

        .form-header {
            color: #4CAF50; /* Tono verde para el encabezado */
            margin-bottom: 20px; /* Espacio debajo del encabezado */
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

        .text-danger {
            color: #e63946; /* Color para mensajes de error */
        }

        a {
            color: #4CAF50; /* Color verde para enlaces */
            text-decoration: none; /* Sin subrayado */
        }

        a:hover {
            text-decoration: underline; /* Subrayar en hover */
        }
    </style>
</head>
<body>
    <br><br><br>

    <div class="form-container text-center">
        <img src="img/avion.gif" alt="Logo de BinterMas" class="img-fluid mb-3">
        <h2 class="form-header">BinterMas</h2>

        <form action="logon.php" method="POST">
            
            <?php
            // Obtener el tipo de login desde GET
            $login_tipo = $_GET['login_tipo'] ?? '';  

            if (in_array($login_tipo, ['email', 'documento_numero', 'nie', 'login'])) {
                switch ($login_tipo) {
                    case 'email':
                        echo  '<div class="mb-3">
                                <label for="email" class="form-label">Introduce tu Email:</label>
                                <input type="email" class="form-control" id="email" name="credenciales" placeholder="ejemplo@dominio.com" required>
                            </div>';
                        break;
                    case 'documento_numero':
                        echo  '<div class="mb-3">
                                <label for="dni" class="form-label">Introduce tu DNI:</label>
                                <input type="text" class="form-control" id="dni" name="credenciales" placeholder="12345678A" required pattern="[0-9]{8}[A-Za-z]{1}" title="El DNI debe tener 8 números seguidos de una letra">
                            </div>';
                        break;
                    case 'nie':
                        echo  '<div class="mb-3">
                                <label for="nie" class="form-label">Introduce tu NIE:</label>
                                <input type="text" class="form-control" id="nie" name="credenciales" placeholder="X1234567A" required pattern="[XYZ][0-9]{7}[A-Za-z]{1}" title="El NIE debe empezar por X, Y o Z, seguido de 7 números y una letra">
                            </div>';
                        break;
                    case 'login':
                        echo  '<div class="mb-3">
                                <label for="usuario" class="form-label">Introduce tu Usuario:</label>
                                <input type="text" class="form-control" id="usuario" name="credenciales" placeholder="Nombre de usuario" required>
                            </div>';
                        break;
                }
            } else {
                echo "<p class='text-danger'>Tipo de login no válido.</p>";
            }
            ?>
            <input type="hidden" name="login_tipo" value="<?php echo $login_tipo; ?>">
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>
        <label><a href="registro.php">¿No tienes Cuenta? Regístrate aquí</a></label>
        <label><a href="olvida.php">¿Olvidaste tu contraseña?</a></label>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
