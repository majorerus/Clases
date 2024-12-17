<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscripción</title>

    <!-- Enlace a Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Enlace a Bootstrap JS y Popper.js (necesarios para algunos componentes interactivos de Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">

        <?php
        // Verifica si el formulario fue enviado usando el método POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitiza el correo electrónico recibido para eliminar caracteres no válidos
            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

            // Valida que el correo electrónico tenga un formato válido
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Define el destinatario del correo (en este caso, el mismo correo ingresado por el usuario)
                $to = $email;

                // Define el asunto del correo
                $subject = "Suscripción a Ofertas de Vuelos";

                // Define el contenido del mensaje
                $message = "Gracias por suscribirte a nuestras ofertas de vuelos. ¡Te mantendremos informado!";

                // Define el remitente y el correo para respuestas
                $headers = "From: manurogerdeleon@gmail.com\r\n"; // Correo del remitente
                $headers .= "Reply-To: manurogerdeleon@gmail.com\r\n"; // Correo para responder

                // Envía el correo electrónico y verifica si se envió correctamente
                if (mail($to, $subject, $message, $headers)) {
                    // Mensaje de confirmación si el correo fue enviado con éxito
                    echo '<div class="alert alert-success text-center" role="alert">Correo enviado exitosamente a ' . $email . '.</div>';
                } else {
                    // Mensaje de error si hubo un problema al enviar el correo
                    echo '<div class="alert alert-danger text-center" role="alert">Error al enviar el correo. Intenta nuevamente.</div>';
                }
            } else {
                // Mensaje de error si el correo ingresado no es válido
                echo '<div class="alert alert-warning text-center" role="alert">Por favor, introduce un correo electrónico válido.</div>';
            }
        }
        ?>

        <!-- Redirección automática a 'principal.php' después de 4 segundos -->
        <meta http-equiv="refresh" content="4;url=principal.php">
    </div>
</body>
</html>
