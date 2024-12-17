<?php
// Iniciar sesión para mantener el estado del juego
session_start();

// Configuración inicial
if (!isset($_SESSION['cartas'])) {
    // Si no se han configurado las cartas aún, configuramos el tablero

    // Crear un array de pares de cartas (íconos de animales)
    $pares = ['🐱', '🐶', '🦄', '🦊', '🐼', '🐸'];

    // Duplicamos las cartas para formar los pares y las mezclamos al azar
    $cartas = array_merge($pares, $pares);
    shuffle($cartas); // Mezclar las cartas

    // Guardamos las cartas en la sesión para mantener el estado entre peticiones
    $_SESSION['cartas'] = $cartas;

    // Inicializamos el estado de las cartas (todas ocultas al principio)
    $_SESSION['estado'] = array_fill(0, count($cartas), false); // Falso = carta no volteada

    // Inicializamos los contadores de turnos y pares encontrados
    $_SESSION['turnos'] = 0;
    $_SESSION['pares_encontrados'] = 0;

    // Array para las cartas seleccionadas por el jugador
    $_SESSION['seleccionadas'] = [];
}

// Procesar la selección de cartas cuando se hace clic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si se ha seleccionado una carta
    if (isset($_POST['carta'])) {
        $indice = $_POST['carta']; // Obtener el índice de la carta seleccionada
        
        // Si la carta ya está volteada, no hacer nada
        if ($_SESSION['estado'][$indice]) {
            // Vuelve a redirigir para evitar problemas con el formulario
            header('Location: '.$_SERVER['PHP_SELF']);
            exit;
        }

        // Volteamos la carta seleccionada
        $_SESSION['seleccionadas'][] = $indice;
        $_SESSION['estado'][$indice] = true;

        // Si tenemos dos cartas seleccionadas, verificamos si son iguales
        if (count($_SESSION['seleccionadas']) == 2) {
            $indice1 = $_SESSION['seleccionadas'][0];
            $indice2 = $_SESSION['seleccionadas'][1];

            // Verificamos si las cartas coinciden
            if ($_SESSION['cartas'][$indice1] === $_SESSION['cartas'][$indice2]) {
                $_SESSION['pares_encontrados']++; // Si coinciden, incrementamos los pares encontrados
            } else {
                // Si no coinciden, deshacemos el voltear de las cartas después de un pequeño retraso
                sleep(1); // Retraso para que el jugador vea las cartas antes de que se oculten nuevamente
                $_SESSION['estado'][$indice1] = false;
                $_SESSION['estado'][$indice2] = false;
            }

            // Incrementamos el contador de turnos
            $_SESSION['turnos']++;

            // Limpiamos las cartas seleccionadas
            $_SESSION['seleccionadas'] = [];
        }
    }
}

// Reiniciar el juego
if (isset($_POST['reiniciar'])) {
    // Si se ha solicitado reiniciar, destruimos la sesión y recargamos la página
    session_destroy();
    header('Location: jueguito.php'); // Recargamos el juego
    exit;
}

// Redirigir a la página principal
if (isset($_POST['salir'])) {
    // Si se hace clic en el botón "Salir", redirigimos al usuario a la página principal
    header('Location: principal.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - BinterMas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/styleindex.css">
    <link rel="icon" href="favicon.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <style>
       .verde {
    background-color: #A8E6CF; /* Verde suave */
    color: #1B5E20; /* Texto en verde oscuro */
}

.plata {
    background-color: #E0E0E0; /* Plata suave */
    color: #424242; /* Texto en gris oscuro */
}

.oro {
    background-color: #FFF9C4; /* Amarillo suave */
    color: #F57F20; /* Texto en naranja oscuro */
}


.popup {
    display: none; /* Esconde el popup por defecto */
    position: fixed;
    z-index: 1000; /* Asegúrate de que el popup esté por encima de otros elementos */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Fondo semi-transparente */
}

.popup-content {
    position: relative;
    margin: 15% auto;
    padding: 20px;
    background: white;
    border-radius: 5px;
    width: 80%;
    max-width: 500px;
    text-align: center;
}

.close {
    position: absolute;
    top: 10px;
    right: 15px;
    cursor: pointer;
    font-size: 24px;
}

        body {
            background-color: #f0f9f4; /* Fondo verde claro */
            color: #2c3e50; /* Texto oscuro para contraste */
            font-family: 'Arial', sans-serif;
        }

        h1 {
            color: #27ae60; /* Verde Binter */
        }

        .tablero {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            max-width: 500px;
            margin: 20px auto;
        }

        button {
            background-color: #2ecc71; /* Verde brillante */
            border: none;
            border-radius: 8px;
            padding: 20px;
            font-size: 2rem;
            color: white;
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s;
            width: 100%;
            height: 100px;
        }

        button:disabled {
            background-color: #95a5a6; /* Gris cuando la carta está volteada */
        }

        button:hover {
            transform: scale(1.05);
        }

        button:focus {
            outline: none;
        }

        .btn-reiniciar {
            background-color: #e74c3c; /* Rojo para el botón de reiniciar */
            color: white;
        }

        .btn-reiniciar:hover {
            background-color: #c0392b;
        }

        .btn-salir {
            background-color: #16a085; /* Verde más oscuro */
            color: white;
        }

        .btn-salir:hover {
            background-color: #1abc9c;
        }

        .alert {
            font-size: 1.5rem;
            color: #27ae60; /* Verde */
        }

        .anuncio-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            gap: 15px;
        }

        .anuncio {
            background-color: #27ae60; /* Verde Binter */
            color: white;
            border-radius: 8px;
            padding: 15px;
            width: 32%; /* Igualamos el ancho de los anuncios */
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .anuncio img {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 10px;
        }


        <style>
        /* Aquí va el estilo de tu página */
        .logo {
            width: 300px;
        }

        .tablero {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 20px;
        }

        .tablero button {
            font-size: 2rem;
            padding: 20px;
            background-color: #f1f1f1;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .tablero button:hover {
            background-color: #ddd;
        }

        .btn-reiniciar {
            margin-top: 20px;
        }

        footer {
            background-color: #28a745;
            color: white;
            padding: 10px;
            margin-top: 30px;
        }

        footer img {
            width: 140px;
        }

    </style>








    </style>
</head>
<body>


<body class="<?php echo isset($_SESSION['categoria']) ? $_SESSION['categoria'] : ''; ?>">

    <header class="container text-center mt-2">
        <img src="img/BinterCanarias.jpg" alt="Logo de BinterCanarias" class="img-fluid logo">
    </header>

   

    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="principal.php">BinterMas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                
                    <li class="nav-item">
                        <a class="nav-link" href="reservas/ver_reservas.php">Reserva tu Hotel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="jueguito.php">Entretenimiento</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="utilidades/otras.php">Otras Utilidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Mi cuenta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="misreservas.php">Mis Reservas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar sesión</a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>

      <!-- Seccion para rellenar y me quede bonita -->







    <div class="container text-center">
        <h1>Juego de Memoria</h1>
        <p>Turnos: <?= $_SESSION['turnos'] ?></p> <!-- Mostrar el número de turnos -->
        <p>Pares encontrados: <?= $_SESSION['pares_encontrados'] ?></p> <!-- Mostrar los pares encontrados -->

        <?php if ($_SESSION['pares_encontrados'] === count($_SESSION['cartas']) / 2): ?>
            <div class="alert alert-success">
                ¡Felicidades! Ganaste el juego en <?= $_SESSION['turnos'] ?> turnos.
            </div>

            <!-- Botones para reiniciar o salir -->
            <form method="post">
                <button type="submit" name="reiniciar" class="btn btn-reiniciar">Reiniciar Juego</button> <!-- Botón de reiniciar -->
                
            </form>
        <?php else: ?>
            <!-- Si aún no ha ganado, mostrar el tablero de cartas -->
            <form method="post">
                <div class="tablero">
                    <?php foreach ($_SESSION['cartas'] as $index => $carta): ?>
                        <button type="submit" name="carta" value="<?= $index ?>" 
                                <?= $_SESSION['estado'][$index] ? 'disabled' : '' ?>>
                            <?= $_SESSION['estado'][$index] ? $carta : '❓' ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </form>
            <!-- Botón para salir a la página principal -->
            <form method="post">
          
            </form>
        <?php endif; ?>

        <!-- Anuncios de Binter en fila -->
        <div class="anuncio-container">
            <div class="anuncio">
                <h3>¡Vuela con Binter y descubre Canarias!</h3>
                <img src="https://i.ytimg.com/vi/7_hKKApqtIo/maxresdefault.jpg" alt="Binter">
            </div>
            <div class="anuncio">
                <h3>Descubre los vuelos a tu destino ideal</h3>
                <img src="https://henryhank.es/wp-content/uploads/Mesa-de-trabajo-4-copia-5.jpg" alt="Binter">
            </div>
            <div class="anuncio">
                <h3>¡Haz tu reserva ahora y viaja a Canarias!</h3>
                <img src="https://estaticos-cdn.prensaiberica.es/clip/20ab97fd-345d-4d45-88a0-97bbcc70af3c_16-9-aspect-ratio_default_0.jpg" alt="Binter">
            </div>
        </div>

    </div>



<footer class="bg-success text-white text-center py-3 mt-5">
        <p>&copy; 2024 BinterMas. Todos los derechos reservados. <img src="img/sociales.png" width="140"></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
