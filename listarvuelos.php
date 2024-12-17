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

// Inicializar variables para la búsqueda
$origen = isset($_GET['origen']) ? $_GET['origen'] : '';
$destino = isset($_GET['destino']) ? $_GET['destino'] : '';
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';

// Construir la consulta SQL
$sql = "SELECT * FROM vuelos WHERE 1=1"; // Esto asegura que siempre se devuelvan resultados

// Añadir condiciones a la consulta según los parámetros proporcionados
if ($origen) {
    $sql .= " AND origen = ?";
}
if ($destino) {
    $sql .= " AND destino = ?";
}
if ($fecha) {
    $sql .= " AND DATE(fechaHora) = ?";
}

// Preparar la sentencia
$stmt = $conn->prepare($sql);

// Vincular parámetros
$params = [];
if ($origen) {
    $params[] = $origen;
}
if ($destino) {
    $params[] = $destino;
}
if ($fecha) {
    $params[] = $fecha;
}

// Si hay parámetros, vincularlos
if ($params) {
    $stmt->bind_param(str_repeat("s", count($params)), ...$params);
}

// Ejecutar la consulta
$stmt->execute();
$result = $stmt->get_result();














      // Verificar si el usuario está logueado
      if (!isset($_SESSION['dni'])) {
          // Si no hay usuario en la sesión, redirigir al login
          header('Location: index.php');
          exit;
      }
      
      // Obtener los datos del usuario desde la sesión
      $nombreUsuario = htmlspecialchars($_SESSION['nombre']);  
      
      // Consulta SQL para obtener más información si es necesario
      $sql = "SELECT * FROM usuarios WHERE nombre = '$nombreUsuario'";
      
      // Ejecutar la consulta
      $resultado = $conn->query($sql);
      
      // Verificar si se encontró el usuario
      if ($resultado->num_rows > 0) {
          // Procesar los resultados
          $usuarioData = $resultado->fetch_assoc();
          // Ejemplo de mostrar el nombre del usuario
         
      } else {
          echo "No se encontró el usuario.";
      }
      
      // Cerrar la conexión
      $conn->close();
      
      

        
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

.table {
            background-color: #ffffff; /* Fondo blanco para la tabla */
            border-radius: 8px; /* Bordes redondeados */
            overflow: hidden; /* Asegura que los bordes redondeados se apliquen */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
        }

        .table thead {
            background-color: #4CAF50; /* Verde oscuro para el encabezado */
            color: white; /* Color del texto del encabezado */
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f9f9f9; /* Fondo gris claro para filas impares */
        }

        .table tbody tr:nth-child(even) {
            background-color: #e8f5e9; /* Fondo verde muy claro para filas pares */
        }

        .table tbody tr:hover {
            background-color: #c8e6c9; /* Fondo verde más intenso al pasar el ratón */
        }

        .table th, .table td {
            padding: 15px; /* Espaciado interno */
            text-align: center; /* Alineación del texto */
        }

        .table th {
            font-weight: bold; /* Negrita en encabezados */
        }
    </style>
</head>
<body class="<?php echo isset($_SESSION['categoria']) ? $_SESSION['categoria'] : ''; ?>"></body>

    <header class="container text-center mt-2">
        <img src="img/BinterCanarias.jpg" alt="Logo de BinterCanarias" class="img-fluid logo">
    </header>

    <div id="carouselBackground" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselBackground" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselBackground" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselBackground" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('img/1.jpg'); background-size: cover; height: 300px;">
                <div class="d-flex justify-content-center align-items-center text-white" style="height: 100%;">
                    <div class="p-3 bg-success text-white rounded">
                        <h1 class="m-0">Bienvenido, <?php echo $nombreUsuario; ?></h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('img/2.jpg'); background-size: cover; height: 300px;">
                <div class="d-flex justify-content-center align-items-center text-white" style="height: 100%;">
                    <div class="p-3 bg-success text-white rounded">
                        <h1 class="m-0">Explora el Mundo</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('img/3.jpg'); background-size: cover; height: 300px;">
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
            <a class="navbar-brand" href="principal.php">BinterMas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                
                    <li class="nav-item">
                    <a class="nav-link" href="reservas/index.php">Reserva tu Hotel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="jueguito.php">Entretenimiento</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="utilidades/micuenta.php">Otras Utilidades</a>
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


      <div class="container mt-5">
        <h2 class="text-center mb-4">Buscar Vuelos Disponibles</h2>
        
        <!-- Formulario de búsqueda -->
        <form method="GET" action="listarvuelos.php" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="origen">Origen:</label>
                        <select name="origen" id="origen" class="form-control">
                            <option value="">Seleccione</option>
                            <option value="TFN" <?php echo ($origen == 'TFN') ? 'selected' : ''; ?>>TFN</option>
                            <option value="FUE" <?php echo ($origen == 'FUE') ? 'selected' : ''; ?>>FUE</option>
                            <option value="LPA" <?php echo ($origen == 'LPA') ? 'selected' : ''; ?>>LPA</option>
                            <option value="ACE" <?php echo ($origen == 'ACE') ? 'selected' : ''; ?>>ACE</option>
                            <option value="TFS" <?php echo ($origen == 'TFS') ? 'selected' : ''; ?>>TFS</option>
                            <option value="GMZ" <?php echo ($origen == 'GMZ') ? 'selected' : ''; ?>>GMZ</option>
                            <option value="SPC" <?php echo ($origen == 'SPC') ? 'selected' : ''; ?>>SPC</option>
                            <option value="VDE" <?php echo ($origen == 'VDE') ? 'selected' : ''; ?>>VDE</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="destino">Destino:</label>
                        <select name="destino" id="destino" class="form-control">
                            <option value="">Seleccione</option>
                            <option value="TFN" <?php echo ($destino == 'TFN') ? 'selected' : ''; ?>>TFN</option>
                            <option value="FUE" <?php echo ($destino == 'FUE') ? 'selected' : ''; ?>>FUE</option>
                            <option value="LPA" <?php echo ($destino == 'LPA') ? 'selected' : ''; ?>>LPA</option>
                            <option value="ACE" <?php echo ($destino == 'ACE') ? 'selected' : ''; ?>>ACE</option>
                            <option value="TFS" <?php echo ($destino == 'TFS') ? 'selected' : ''; ?>>TFS</option>
                            <option value="GMZ" <?php echo ($destino == 'GMZ') ? 'selected' : ''; ?>>GMZ</option>
                            <option value="SPC" <?php echo ($destino == 'SPC') ? 'selected' : ''; ?>>SPC</option>
                            <option value="VDE" <?php echo ($destino == 'VDE') ? 'selected' : ''; ?>>VDE</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fecha">Fecha (YYYY-MM-DD):</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo htmlspecialchars($fecha); ?>">
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Buscar Vuelos</button>
            </div>
        </form>

        <!-- Listado de Vuelos -->
        <?php if ($result->num_rows > 0) { ?>
            <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Vuelo</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha y Hora</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($vuelo = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $vuelo['IdVuelo']; ?></td>
                    <td><?php echo $vuelo['NumVuelo']; ?></td>
                    <td><?php echo $vuelo['origen']; ?></td>
                    <td><?php echo $vuelo['destino']; ?></td>
                    <td><?php echo $vuelo['fechaHora']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                No se encontraron vuelos disponibles con los criterios proporcionados.
            </div>
        <?php } ?>

        <div class="text-center mt-3">
            <a href="misreservas.php" class="btn btn-secondary">Volver al inicio</a>
        </div>
    </div>












      <section class="container text-center mt-5">
        <h2 class="mb-4">Descubre nuestros destinos</h2>
        <p>Descubre e inspírate para tus próximas vacaciones conociendo un poco más sobre nuestros destinos. Elige el destino que mejor se adapte a ti y canjea tus puntos BinterMás.</p>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="img/madrid.jpg" class="card-img-top" alt="Madrid">
                    <div class="card-body">
                        <h5 class="card-title">Gran Vía de Madrid</h5>
                        <p class="card-text">Vuela a Madrid con Binter con 8 salidas diarias desde Canarias y descubre una capital en todos los sentidos.</p>
                        <p class="card-text"><strong>Desde 20,89 €</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="img/palma.jpg" class="card-img-top" alt="Palma de Mallorca">
                    <div class="card-body">
                        <h5 class="card-title">Palma de Mallorca</h5>
                        <p class="card-text">La perla del Mediterráneo. Una preciosa ciudad de estilo mediterráneo, clima agradable y fantásticas playas.</p>
                        <p class="card-text"><strong>Desde 38,75 €</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="img/vigo.jpg" class="card-img-top" alt="Vigo">
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
                    <img src="img/granada.jpg" class="card-img-top" alt="Granada">
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
            <img src="img/vuela-directo.jpg" class="img-fluid" alt="Vuela directo">
            <h5 class="mt-3">Vuela directo</h5>
            <p>Más de 200 vuelos a 30 destinos</p>
            <a href="#" class="btn btn-success">Ver más</a>
        </div>
        <div class="col-md-4 mb-4">
            <img src="img/servicio-calidad.jpg" class="img-fluid" alt="Servicio de calidad">
            <h5 class="mt-3">Servicio de calidad</h5>
            <p>Disfruta de una experiencia de primera</p>
            <a href="#" class="btn btn-success">Ver más</a>
        </div>
        <div class="col-md-4 mb-4">
            <img src="img/servicios-aeropuerto.jpg" class="img-fluid" alt="Servicios en aeropuerto">
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
        <img src="img/bmas-home-2.jpg" class="img-fluid" alt="bmas-home-2">
            <h5>Clientes BinterMás satisfechos</h5>
            <p>Acumula puntos y disfruta de un mundo lleno de ventajas</p>
        </div>
        <div class="col-md-4 mb-4">
        <img src="img/bs_banner1.jpg" class="img-fluid" alt="bs_banner1">
            <h5>Prioridad en lista de espera</h5>
            <p>Facturación preferente y peso adicional en equipaje</p>
        </div>
        <div class="col-md-4 mb-4">
        <img src="img/email_black_24dp.svg" class="img-fluid" alt="email_black_24dp">
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
    <form class="text-center" action="suscripcion.php" method="POST">
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
        <p>&copy; 2024 BinterMas. Todos los derechos reservados. <img src="img/sociales.png" width="140"></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
