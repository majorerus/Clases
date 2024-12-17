<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener la isla seleccionada
    $islaSeleccionada = $_POST['isla'];

    if ($islaSeleccionada) {
        echo "Has seleccionado: " . $islaSeleccionada;
    } else {
        echo "No seleccionaste ninguna isla.";
    }
} else {
    echo "Acceso no válido.";
}
?>
