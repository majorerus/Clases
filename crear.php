<?php
include("conexion.php");

// Obtener la lista de usuarios
$usuarios_query = "SELECT id, login FROM usuarios";
$usuarios_result = mysqli_query($conn, $usuarios_query);

// Obtener la lista de vuelos
$vuelos_query = "SELECT id, origen, destino, fecha_salida FROM vuelos";
$vuelos_result = mysqli_query($conn, $vuelos_query);

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $id_vuelo = $_POST['id_vuelo'];
    $fecha_reserva = date('Y-m-d H:i:s'); // Fecha actual
    $estado = $_POST['estado'];

    $insert_query = "INSERT INTO reservas (id_usuario, id_vuelo, fecha_reserva, estado) 
                     VALUES ('$id_usuario', '$id_vuelo', '$fecha_reserva', '$estado')";
    if (mysqli_query($conn, $insert_query)) {
        echo "<script>alert('Reserva creada exitosamente.');</script>";
        echo "<script>window.location.href = 'crud.php';</script>";
    } else {
        echo "Error al crear la reserva: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Reserva</title>
    <link rel="icon" href="favicon.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
</head>
<body>
    <h2>Crear Reserva</h2>
    <form action="crear.php" method="post">
        <label for="id_usuario">Usuario:</label>
        <select name="id_usuario" id="id_usuario" required>
            <option value="">Seleccione un usuario</option>
            <?php while ($usuario = mysqli_fetch_assoc($usuarios_result)) { ?>
                <option value="<?= $usuario['id'] ?>"><?= $usuario['login'] ?></option>
            <?php } ?>
        </select>
        <br><br>

        <label for="id_vuelo">Vuelo:</label>
        <select name="id_vuelo" id="id_vuelo" required>
            <option value="">Seleccione un vuelo</option>
            <?php while ($vuelo = mysqli_fetch_assoc($vuelos_result)) { ?>
                <option value="<?= $vuelo['id'] ?>">
                    <?= $vuelo['origen'] ?> - <?= $vuelo['destino'] ?> (<?= $vuelo['fecha_salida'] ?>)
                </option>
            <?php } ?>
        </select>
        <br><br>

        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="confirmada">Confirmada</option>
            <option value="cancelada">Cancelada</option>
        </select>
        <br><br>

        <button type="submit">Crear Reserva</button>
    </form>
    <br>
    <a href="crud.php">Volver al listado</a>
</body>
</html>
