<?php
include('conexion.php'); // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    // Verificar si el email no está vacío
    if (empty($email)) {
        echo "<p class='text-danger'>El email no puede estar vacío.</p>";
        exit;
    }

    // Limpiar el email para prevenir inyecciones SQL
    $email = $conn->real_escape_string(trim($email));

    // Consulta para verificar si el email existe
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // Generar un token único
        $token = bin2hex(random_bytes(50)); // Genera un token aleatorio
        // Guardar el token en la base de datos junto con el email (en una tabla o columna de recuperación)
        // Aquí asumimos que tienes una columna `token` en tu tabla de usuarios
        $updateQuery = "UPDATE usuarios SET token = '$token' WHERE email = '$email'";
        $conn->query($updateQuery);

        // Enviar correo con instrucciones para restablecer la contraseña
        $to = $email;
        $subject = "Restablecimiento de contraseña";
        $message = "Hola,\n\nHaz clic en el siguiente enlace para restablecer tu contraseña:\n";
        $message .= "http://tu-dominio.com/restablecer.php?token=$token\n\n";
        $message .= "Si no solicitaste esto, ignora este mensaje.\n";
        $headers = "From: no-reply@tu-dominio.com\r\n";
        
        // Usar sendmail para enviar el correo
        if (mail($to, $subject, $message, $headers)) {
            echo "<p class='text-success'>Se ha enviado un correo a <strong>$email</strong> con instrucciones para restablecer tu contraseña.</p>";
        } else {
            echo "<p class='text-danger'>Hubo un error al enviar el correo. Por favor, intenta más tarde.</p>";
        }
    } else {
        echo "<p class='text-danger'>No se encontró ningún usuario con ese email.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olvidaste tu Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="favicon.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <style>
        body {
            background-color: #f0f4f7;
        }
        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            margin: auto;
            margin-top: 100px;
        }
        h2 {
            color: #4CAF50;
        }





/* Estilo para el formulario */
form {
    background-color: #f4f4f4; /* Fondo gris claro para el formulario */
    padding: 20px;
    border-radius: 8px;
}

/* Estilo para los campos de texto */
form .form-control {
    border-color: #77C34D; /* Verde Binter para los bordes */
    box-shadow: 0 0 5px rgba(119, 195, 77, 0.5); /* Sombra sutil en verde */
}

form .form-control:focus {
    border-color: #4cae4c; /* Verde más oscuro cuando el campo está enfocado */
    box-shadow: 0 0 5px rgba(77, 172, 77, 0.5);
}

/* Estilo para el botón de enviar */
form .btn-success {
    background-color: #77C34D; /* Verde Binter */
    border-color: #77C34D;
    color: white;
}

form .btn-success:hover {
    background-color: #66b348; /* Verde más oscuro en hover */
    border-color: #66b348;
}

/* Estilo para las etiquetas */
form .form-label {
    font-weight: bold;
    color: #333; /* Color gris oscuro para las etiquetas */
}

/* Estilo para los selectores */
form .form-select {
    border-color: #77C34D; /* Verde Binter para los selectores */
}

form .form-select:focus {
    border-color: #4cae4c;
    box-shadow: 0 0 5px rgba(77, 172, 77, 0.5);
}

/* Estilo para las casillas de verificación */
form .form-check-input:checked {
    background-color: #77C34D;
    border-color: #77C34D;
}



/* Estilo general para la tarjeta */
.card {
    border-radius: 10px;
    
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
    transition: box-shadow 0.3s ease; /* Transición suave en la sombra */
}

.card:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Sombra más intensa al pasar el ratón */
}

/* Encabezado de la tarjeta */
.card-header {
    border-radius: 10px 10px 0 0;
    padding: 15px;
    background-color: #0ea625;
    color: white;
}

.card-header h5 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 500;
}

/* Botón de búsqueda */
.btn-outline-light {
    border-color: white;
    color: white;
    font-size: 0.875rem;
    padding: 5px 15px;
}

.btn-outline-light:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

/* Estilo de los campos de selección */
.form-select {
    padding: 0.75rem;
    border-radius: 8px;
    border: 1px solid #ddd;
    font-size: 1rem;
}

.form-select-lg {
    font-size: 1.1rem;
}

/* Botón de agregar reserva */
.btn-success {
    background-color: #28a745;
    border-color: #28a745;
    font-size: 1.1rem;
    padding: 12px;
    border-radius: 8px;
    transition: background-color 0.3s ease;
}

.btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
}

/* Estilo de los labels */
.form-label {
    font-weight: 600;
    font-size: 1.05rem;
    color: #333;
}


.btn.btn-primary {
    background-color: #28a745; /* Verde claro */
    border-color: #28a745;
}

.btn.btn-primary:hover {
    background-color: #218838; /* Verde más oscuro al pasar el ratón */
    border-color: #1e7e34;
}






        
    </style>
</head>
<body>
    <div class="form-container text-center">
        <h2>¿Olvidaste tu Contraseña?</h2>
        <form action="olvida.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Introduce tu Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@dominio.com" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>
        <label><a href="index.php">¿Ya tienes una cuenta? Inicia sesión aquí</a></label>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
