
<?php
      include ('conexion.php');  
      session_start();
      if ($_SESSION['puntos'] >= 0 && $_SESSION['puntos'] < 2500) {
        $_SESSION['categoria'] = 'verde'; // Tarjeta verde
    } elseif ($_SESSION['puntos'] >= 2500 && $_SESSION['puntos'] < 8000) {
        $_SESSION['categoria'] = 'plata'; // Tarjeta plata
    } else {
        $_SESSION['categoria'] = 'oro'; // Tarjeta oro
    }



// Obtener lista de hoteles para mostrar en el formulario
$sql = "SELECT * FROM hoteles";
$result = $conn->query($sql);

// Procesar el formulario de reserva
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idHotel = $_POST['idHotel'];
    $nombreCliente = $_POST['nombreCliente'];
    $emailCliente = $_POST['emailCliente'];
    $fechaReserva = $_POST['fechaReserva'];
    $fechaIngreso = $_POST['fechaIngreso'];
    $fechaSalida = $_POST['fechaSalida'];
    $numeroPersonas = $_POST['numeroPersonas'];

    // Insertar la reserva en la base de datos
    $sqlReserva = "INSERT INTO reservas (idHotel, nombreCliente, emailCliente, fechaReserva, fechaIngreso, fechaSalida, numeroPersonas) 
                   VALUES ('$idHotel', '$nombreCliente', '$emailCliente', '$fechaReserva', '$fechaIngreso', '$fechaSalida', '$numeroPersonas')";

    if ($conn->query($sqlReserva) === TRUE) {
        echo "Reserva realizada correctamente.";
        header("Location: ver_reservas.php"); // Redirige a la página de reservas
    } else {
        echo "Error: " . $conn->error;
    }
}




      
 





      

        
        if (isset($numero_tarjeta)) { // Comprobar si la variable $numero_tarjeta está definida y no es null
            // Si el número de la tarjeta comienza con 'NT10' (compara los primeros 4 caracteres)
            if (strpos($numero_tarjeta, 'NT10') === 0) {
                echo "<p></p>"; // Inserta un párrafo vacío (podría ser para crear un espacio)
                // Cambia el color de fondo de la página a verde (#A9DFBF)
                echo "<script>document.body.style.backgroundColor = '#A9DFBF';</script>"; // Fondo verde
            }
            // Si el número de la tarjeta comienza con 'NT20'
            elseif (strpos($numero_tarjeta, 'NT20') === 0) {
                echo "<p></p>"; // Inserta un párrafo vacío
                // Cambia el color de fondo de la página a plata (#D5D8DC)
                echo "<script>document.body.style.backgroundColor = '#D5D8DC';</script>"; // Fondo plata
            }
            // Si el número de la tarjeta comienza con 'NT30'
            elseif (strpos($numero_tarjeta, 'NT30') === 0) {
                echo "<p></p>"; // Inserta un párrafo vacío
                // Cambia el color de fondo de la página a oro (#F7DC6F)
                echo "<script>document.body.style.backgroundColor = '#F7DC6F';</script>"; // Fondo oro
            }
            // Si el número de la tarjeta no empieza con 'NT10', 'NT20' o 'NT30'
            else {
                echo "<p></p>"; // Inserta un párrafo vacío
                // Cambia el color de fondo de la página a rojo claro (#F5B7B1), probablemente para indicar un error
                echo "<script>document.body.style.backgroundColor = '#F5B7B1';</script>"; // Fondo rojo claro (error)
            }
        }

        


            
        ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - BinterMas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styleindex.css">
    <link rel="icon" href="../favicon.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
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


/* Estilo para la tabla */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    margin-top: 20px;
    border-radius: 10px; /* Bordes redondeados */
    overflow: hidden; /* Para que los bordes redondeados se vean bien */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave alrededor de la tabla */
    background-color: #ffffff; /* Fondo blanco para la tabla */
}

/* Estilo para las celdas (th, td) */
th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
    transition: background-color 0.3s; /* Transición suave en el cambio de color de fondo */
}

th {
    background-color: #0f6b81; /* Color de fondo para los encabezados */
    color: green; /* Texto blanco para los encabezados */
    font-weight: bold; /* Negrita en los encabezados */
    text-transform: uppercase; /* Mayúsculas en los encabezados */
    letter-spacing: 1px; /* Espaciado entre letras */
    padding-top: 16px; /* Espaciado superior */
    padding-bottom: 16px; /* Espaciado inferior */
}

/* Estilo para las filas alternas (tr) */
tr:nth-child(even) {
    background-color: #71d17d; /* Fondo gris claro para filas pares */
}

tr:nth-child(odd) {
    background-color: #ffffff; /* Fondo blanco para filas impares */
}

tr:hover {
    background-color: #e0f7fa; /* Color de fondo al pasar el ratón */
    transform: translateY(-2px); /* Sombra al pasar el ratón */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra adicional al pasar el ratón */
}

/* Estilo para las celdas de datos (td) */
td {
    background-color: #ffffff; /* Fondo blanco para las celdas */
    color: #333; /* Texto en negro para una mejor legibilidad */
    border-left: 1px solid #e0e0e0; /* Borde izquierdo */
    border-right: 1px solid #e0e0e0; /* Borde derecho */
}

/* Estilo de pie de tabla */
tfoot {
    background-color: #007c91;
    color: white;
    font-weight: bold;
}

tfoot td {
    text-align: right;
    padding: 10px 15px;
    border-top: 2px solid #e0e0e0; /* Borde superior para el pie */
}

/* Estilo para el botón en las celdas */
button {
    background-color: #0f6b81; /* Color de fondo para el botón */
    color: white; /* Texto blanco en el botón */
    border: none;
    padding: 8px 16px;
    border-radius: 5px; /* Bordes redondeados */
    cursor: pointer;
    transition: background-color 0.3s; /* Transición suave para el color de fondo */
}

button:hover {
    background-color: #007c91; /* Cambio de color en hover */
}

/* Estilo para las celdas con bordes redondeados */
th:first-child, td:first-child {
    border-left: none;
}

th:last-child, td:last-child {
    border-right: none;
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
<body class="<?php echo isset($_SESSION['categoria']) ? $_SESSION['categoria'] : ''; ?>"></body>

    <header class="container text-center mt-2">
        <img src="../img/BinterCanarias.jpg" alt="Logo de BinterCanarias" class="img-fluid logo">
    </header>

    <div id="carouselBackground" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselBackground" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselBackground" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselBackground" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('../img/1.jpg'); background-size: cover; height: 300px;">
                <div class="d-flex justify-content-center align-items-center text-white" style="height: 100%;">
                    <div class="p-3 bg-success text-white rounded">
                        <h1 class="m-0">Bienvenido></h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('../img/2.jpg'); background-size: cover; height: 300px;">
                <div class="d-flex justify-content-center align-items-center text-white" style="height: 100%;">
                    <div class="p-3 bg-success text-white rounded">
                        <h1 class="m-0">Explora el Mundo</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('../img/3.jpg'); background-size: cover; height: 300px;">
                <div class="d-flex justify-content-center align-items-center text-white" style="height: 100%;">
                    <div class="p-3 bg-success text-white rounded">
                        <h1 class="m-0">Viaja con Nosotros</h1>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselBackground" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselBackground" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="../principal.php">BinterMas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                
                    <li class="nav-item">
                    <a class="nav-link" href="../reservas/index.php">Reserva tu Hotel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../jueguito.php">Entretenimiento</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="../utilidades/otras.php">Otras Utilidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../perfil.php">Mi cuenta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../misreservas.php">Mis Reservas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Cerrar sesión</a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>

      <!-- Seccion para rellenar y me quede bonita -->




      <div class="container mt-5">
        <h1>Realizar una Reserva</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="idHotel" class="form-label">Selecciona el hotel</label>
                <select name="idHotel" class="form-select" required>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <option value="<?php echo $row['idHotel']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="nombreCliente" class="form-label">Nombre del Cliente</label>
                <input type="text" name="nombreCliente" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="emailCliente" class="form-label">Email del Cliente</label>
                <input type="email" name="emailCliente" class="form-control">
            </div>

            <div class="mb-3">
                <label for="fechaReserva" class="form-label">Fecha de la Reserva</label>
                <input type="date" name="fechaReserva" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="fechaIngreso" class="form-label">Fecha de Ingreso</label>
                <input type="date" name="fechaIngreso" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="fechaSalida" class="form-label">Fecha de Salida</label>
                <input type="date" name="fechaSalida" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="numeroPersonas" class="form-label">Número de Personas</label>
                <input type="number" name="numeroPersonas" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Realizar Reserva</button>
        </form>
    </div>











      <section class="container text-center mt-5">
        <h2 class="mb-4">Descubre nuestros destinos</h2>
        <p>Descubre e inspírate para tus próximas vacaciones conociendo un poco más sobre nuestros destinos. Elige el destino que mejor se adapte a ti y canjea tus puntos BinterMás.</p>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="../img/madrid.jpg" class="card-img-top" alt="Madrid">
                    <div class="card-body">
                        <h5 class="card-title">Gran Vía de Madrid</h5>
                        <p class="card-text">Vuela a Madrid con Binter con 8 salidas diarias desde Canarias y descubre una capital en todos los sentidos.</p>
                        <p class="card-text"><strong>Desde 20,89 €</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="../img/palma.jpg" class="card-img-top" alt="Palma de Mallorca">
                    <div class="card-body">
                        <h5 class="card-title">Palma de Mallorca</h5>
                        <p class="card-text">La perla del Mediterráneo. Una preciosa ciudad de estilo mediterráneo, clima agradable y fantásticas playas.</p>
                        <p class="card-text"><strong>Desde 38,75 €</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="../img/vigo.jpg" class="card-img-top" alt="Vigo">
                    <div class="card-body">
                        <h5 class="card-title">Vigo</h5>
                        <p class="card-text">Su patrimonio histórico, su costa, su agenda de ocio o la propia gastronomía gallega constituyen sus principales puntos de atracción.</p>
                        <p class="card-text"><strong>Desde 43,39 €</strong></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="../img/granada.jpg" class="card-img-top" alt="Granada">
                    <div class="card-body">
                        <h5 class="card-title">Granada</h5>
                        <p class="card-text">¡Ven a descubrir la belleza de Granada! La cuna de la historia y la cultura española, ofrece una impresionante mezcla de tradición y modernidad.</p>
                        <p class="card-text"><strong>Desde 34,01 €</strong></p>
                    </div>
                </div>
            </div>
            <!-- Aquí puedes añadir más destinos si lo deseas -->
        </div>
    </section>

<!-- Sección de Ventajas de Volar con Binter -->
<section class="container mt-5">
    <h2 class="text-center mb-4">Las ventajas de volar con nosotros</h2>
    <p class="text-center">9 de cada 10 pasajeros recomienda volar con Binter</p>

    <!-- Fila para mostrar las ventajas -->
    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <img src="../img/vuela-directo.jpg" class="img-fluid" alt="Vuela directo">
            <h5 class="mt-3">Vuela directo</h5>
            <p>Más de 200 vuelos a 30 destinos</p>
            <a href="#" class="btn btn-success">Ver más</a>
        </div>
        <div class="col-md-4 mb-4">
            <img src="../img/servicio-calidad.jpg" class="img-fluid" alt="Servicio de calidad">
            <h5 class="mt-3">Servicio de calidad</h5>
            <p>Disfruta de una experiencia de primera</p>
            <a href="#" class="btn btn-success">Ver más</a>
        </div>
        <div class="col-md-4 mb-4">
            <img src="../img/servicios-aeropuerto.jpg" class="img-fluid" alt="Servicios en aeropuerto">
            <h5 class="mt-3">Servicios en aeropuerto</h5>
            <p>Aprovecha las ventajas de BinterMás</p>
            <a href="#" class="btn btn-success">Ver más</a>
        </div>
    </div>
</section>

<!-- Sección de Promo El Rey León centrada -->
<section class="container mt-5 bg-light p-4 rounded d-flex justify-content-center">
    <div class="row align-items-center w-75 mx-auto">
        <div class="col-md-4 text-center">
            <img src="img/el-rey-leon.jpg" class="img-fluid" alt="El Rey León Promo">
        </div>
        <div class="col-md-8">
            <h3 class="text-center">El Rey León</h3>
            <p class="text-center">Vuelo + Hotel + El Rey León</p>
            <p class="text-center"><strong>3 días · Hotel 4* Doble en solo alojamiento</strong></p>
            <h4 class="text-success text-center">322 € p. p. residente</h4>
            <p class="text-center">
                <a href="https://canariasviaja.com" class="text-decoration-none">canariasviaja.com</a>
            </p>
            <p class="text-center">Compra online o llama:<br>
                <strong>+34 928 24 81 61 | 922 24 81 61</strong>
            </p>
            <div class="text-center">
                <a href="#" class="btn btn-primary">¡Reservar ya!</a>
            </div>
        </div>
    </div>
</section>


<!-- Sección de Fidelización BinterMás -->
<section class="container mt-5">
    <h2 class="text-center mb-4">Programa de fidelización BinterMás</h2>
    <div class="row text-center">
        <div class="col-md-4 mb-4">
        <img src="../img/bmas-home-2.jpg" class="img-fluid" alt="bmas-home-2">
            <h5>Clientes BinterMás satisfechos</h5>
            <p>Acumula puntos y disfruta de un mundo lleno de ventajas</p>
        </div>
        <div class="col-md-4 mb-4">
        <img src="../img/bs_banner1.jpg" class="img-fluid" alt="bs_banner1">
            <h5>Prioridad en lista de espera</h5>
            <p>Facturación preferente y peso adicional en equipaje</p>
        </div>
        <div class="col-md-4 mb-4">
        <img src="../img/email_black_24dp.svg" class="img-fluid" alt="email_black_24dp">
            <h5>Ofertas exclusivas</h5>
            <p>Más de 30 empresas asociadas y notificaciones anticipadas</p>
        </div>
    </div>
</section>

<!-- Sección de Suscripción a Ofertas -->
<section class="container mt-5 bg-success text-white p-5 rounded">
    <div class="text-center">
        <h3>No te pierdas nuestras ofertas y novedades</h3>
        <p>Recibe las últimas ofertas de vuelos, información sobre nuevas rutas y mucho más</p>
    </div>
    <form class="text-center" action="../suscripcion.php" method="POST">
    <div class="mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="Ej. pat@example.com" required>
    </div>
    <button type="submit" class="btn btn-light">Suscribirse</button>
</form>
    <p class="text-center mt-3 small">
        Los datos personales facilitados serán tratados por Binter Canarias como responsable del tratamiento, para el envío periódico de noticias, ofertas de vuelos, información sobre nuevas rutas, concursos y otras promociones. Puedes consultar nuestra <a href="#" class="text-light text-decoration-underline">Política de privacidad</a>.
    </p>
</section>


<footer class="bg-success text-white text-center py-3 mt-5">
        <p>&copy; 2024 BinterMas. Todos los derechos reservados. <img src="../img/sociales.png" width="140"></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
