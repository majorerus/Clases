<?php
// Configuración de la conexión
$servername = "localhost"; // o el nombre de tu servidor de base de datos
$username = "root";        // Tu nombre de usuario de la base de datos
$password = "";            // Tu contraseña de la base de datos
$dbname = "hoteldb";       // El nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
