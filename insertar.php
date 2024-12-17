<?php
// Incluye el archivo de conexión
include 'conexion.php';
session_start();
$EMAILUsuario = isset($_SESSION['email']) ? htmlspecialchars(     $_SESSION['email']) : 'Usuario desconocido';
// Verificar que el usuario esté autenticado
if (!isset($_SESSION['documento_numero'])) {
    header('Location: login.php');
    exit();
}

// Obtener los datos del formulario
$origen = mysqli_real_escape_string($conn, $_POST['origen']);
$destino = mysqli_real_escape_string($conn, $_POST['destino']);
$tarifa = mysqli_real_escape_string($conn, $_POST['tarifa']);
$vuelo = $_POST['vuelo'];
$usuarioDocumento = $_SESSION['documento_numero']; // Suponemos que el DNI del usuario está guardado en la sesión

// Obtener el ID del usuario de la base de datos basado en su documento
$sqlUsuario = "SELECT id, email FROM usuarios WHERE documento_numero = '$usuarioDocumento'";
$resultUsuario = mysqli_query($conn, $sqlUsuario);
if (mysqli_num_rows($resultUsuario) > 0) {
    $usuario = mysqli_fetch_assoc($resultUsuario);
    $idUsuario = $usuario['id'];
    $emailUsuario = $usuario['email']; // Suponemos que hay un campo 'email' en la tabla 'usuarios'
} else {
    die("Usuario no encontrado.");
}

// Obtener el ID del vuelo basado en el origen y el destino
$sqlVuelo = "SELECT IdVuelo FROM vuelos WHERE origen = '$origen' AND destino = '$destino' or NumVuelo = '$vuelo' LIMIT 1";


$resultVuelo = mysqli_query($conn, $sqlVuelo);
if (mysqli_num_rows($resultVuelo) > 0) {
    $vuelo = mysqli_fetch_assoc($resultVuelo);
    $idVuelo = $vuelo['IdVuelo'];
} else {
    die("No se encontró un vuelo disponible con ese origen y destino.echo $sqlVuelo");
}

// Insertar la nueva reserva en la base de datos
$sqlInsertarReserva = "INSERT INTO reservas (IdUsuario, IdVuelo, tipoTarifa, estado) 
                       VALUES ('$idUsuario', '$idVuelo', '$tarifa', 'activa')";

if (mysqli_query($conn, $sqlInsertarReserva)) {
    // Enviar correo de confirmación
    $asunto = "Confirmación de Reserva";
    $mensaje = "Estimado usuario,\n\nSu reserva ha sido creada con éxito.\n\nDetalles de la reserva:\nOrigen: $origen\nDestino: $destino\nTarifa: $tarifa\n\nGracias por elegirnos.";
    $cabeceras = "From: $EMAILUsuario\r\n"; // Cambia 'tu-dominio.com' por tu dominio real

    if (mail($emailUsuario, $asunto, $mensaje, $cabeceras)) {
        // Redirigir al usuario a una página de confirmación o al listado de reservas
        header('Location: misreservas.php');
        exit();
    } else {
        echo "Error al enviar el correo de confirmación.";
    }
} else {
    echo "Error al realizar la reserva: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>
