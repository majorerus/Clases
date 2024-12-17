<?php
// Definir los parámetros de conexión a la base de datos
$host = "localhost";      // Servidor de base de datos
$usuario = "root";        // Usuario de la base de datos
$contrasena = "";         // Contraseña de la base de datos
$base_de_datos = "bintermas";  // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} else {
    // Opcional: Puedes activar la codificación de caracteres si es necesario
    $conn->set_charset("utf8mb4");
}

?>
