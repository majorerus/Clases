<?php
include 'conexion.php';
session_start();

// Verifica si se ha enviado el ID de la reserva para eliminar
if (isset($_GET['id'])) {
    $idReserva = $_GET['id'];

    // Elimina la reserva
    $deleteSql = "DELETE FROM reservas WHERE IdReserva = '$idReserva'";

    if (mysqli_query($conn, $deleteSql)) {
        header("Location: misreservas.php"); // Redirige a la página de reservas después de eliminar
        exit;
    } else {
        echo "Error al eliminar la reserva: " . mysqli_error($conn);
    }
} else {
    echo "ID de reserva no especificado.";
}
?>
