<?php
// Array con sugerencias para cada isla
$sugerencias = [
    "Tenerife" => ["Visitar el Teide", "Explorar el Parque Nacional del Teide", "Relajarse en Playa de las Américas"],
    "Gran Canaria" => ["Disfrutar de las playas de Maspalomas", "Visitar el Parque Natural de Pilancones", "Recorrer las Dunas de Maspalomas"],
    "Lanzarote" => ["Visitar el Parque Nacional de Timanfaya", "Explorar los Jameos del Agua", "Disfrutar de las playas de Papagayo"],
    "Fuerteventura" => ["Relajarse en las playas de Corralejo", "Visitar el Parque Natural de Corralejo", "Practicar surf en el sur"],
    "La Palma" => ["Explorar el Parque Nacional de la Caldera de Taburiente", "Disfrutar de las vistas en el Roque de los Muchachos", "Visitar el Jardín de las Flores"],
    "La Gomera" => ["Caminar por el Parque Nacional de Garajonay", "Visitar el Parque de la Naturaleza de Sijora", "Disfrutar de las vistas desde el Mirador de Abrante"],
    "El Hierro" => ["Visitar el Mar de Las Calmas", "Explorar el Parque Natural de El Hierro", "Disfrutar de la gastronomía local"],
];

// Array con rutas de imágenes
$imagenes = [
    "Tenerife" => "images/tenerife.jpg",
    "Gran Canaria" => "images/gran_canaria.jpg",
    "Lanzarote" => "images/lanzarote.jpg",
    "Fuerteventura" => "images/fuerteventura.jpg",
    "La Palma" => "images/la_palma.jpg",
    "La Gomera" => "images/la_gomera.jpg",
    "El Hierro" => "images/el_hierro.jpg",
];
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
</head>
<body>


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
                        <h1 class="m-0">Bienvenido</h1>
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
                    <a class="nav-link" href="../reservas/ver_reservas.php">Reserva tu Hotel</a>
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
                        <a class="nav-link" href="logout.php">Cerrar sesión</a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>


<br><br>

<!-- Contenedor principal -->

<div class="form-container">
    <!-- Título del formulario -->
    <h2>Sugerencias de Viaje por Isla</h2>

    <!-- Formulario que enviará datos mediante el método POST -->
    <form method="POST">
        
        <!-- Etiqueta para el campo de selección de isla -->
        <label for="isla">Selecciona una Isla:</label>
        
        <!-- Menú desplegable para seleccionar una isla. 'required' asegura que el usuario seleccione una isla -->
        <select name="isla" id="isla" required>
            <!-- Opción predeterminada, deshabilitada y seleccionada por defecto -->
            <option value="" disabled selected>Elige una isla</option>
            
            <!-- PHP para iterar sobre el array de sugerencias y mostrar las islas en el dropdown -->
            <?php foreach (array_keys($sugerencias) as $isla): ?>
                <!-- Mostrar cada isla como una opción -->
                <option value="<?= $isla ?>"><?= $isla ?></option>
            <?php endforeach; ?>
        </select>
        
        <!-- Botón para enviar el formulario -->
        <button type="submit" class="btn-custom">Mostrar Sugerencias</button>
    </form>

    <!-- Si el formulario ha sido enviado y se ha seleccionado una isla -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['isla'])):
        // Escapar la isla seleccionada para evitar inyecciones de código
        $islaSeleccionada = htmlspecialchars($_POST['isla']); ?>
        
        <!-- Título con la isla seleccionada -->
        <h3>Sugerencias para <?= $islaSeleccionada ?>:</h3>
        
        <!-- Lista de sugerencias para la isla seleccionada -->
        <ul>
            <?php foreach ($sugerencias[$islaSeleccionada] as $sugerencia): ?>
                <!-- Mostrar cada sugerencia dentro de un ítem de lista -->
                <li><?= htmlspecialchars($sugerencia) ?></li>
            <?php endforeach; ?>
        </ul>

        <!-- Mostrar imagen de la isla seleccionada -->
        <div class="image-container">
            <!-- Imagen correspondiente a la isla seleccionada -->
            <img src="<?= $imagenes[$islaSeleccionada] ?>" alt="<?= $islaSeleccionada ?>">
        </div>
    <?php
    endif; ?>
</div>


<style>
 /* Ajustes para el contenedor del formulario */
.form-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    width: 100%;
    margin: 0 auto;
}

/* Títulos y formularios dentro del contenedor */
.form-container h2 {
    text-align: center;
    margin-bottom: 20px;
}

.form-container select, 
.form-container .btn-custom {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
}

.form-container .btn-custom {
    background-color: #007bff;
    color: white;
    border: none;
}

.form-container .btn-custom:hover {
    background-color: #0056b3;
}

/* Estilo para la imagen de la isla */
.form-container .image-container img {
    max-width: 100%;
    border-radius: 10px;
    margin-top: 20px;
}

/* Estilo de la lista de sugerencias */
.form-container ul {
    list-style-type: none;
    padding: 0;
}

.form-container ul li {
    background: #e9ecef;
    padding: 8px;
    border-radius: 5px;
    margin: 5px 0;
}

/* Ajuste para los posibles resultados */
#resultado-container {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    background-color: #f7f7f7;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

#resultado-container h1 {
    color: #007b5e;
    margin-bottom: 30px;
    font-weight: bold;
    font-size: 2em;
}

.result {
    font-size: 1.4em;
    margin-top: 20px;
    padding: 15px;
    border-radius: 10px;
    font-weight: bold;
}

.correct {
    background-color: #d4edda;
    color: #155724;
    border: 2px solid #c3e6cb;
    animation: fadeIn 0.8s ease-in-out;
}

.incorrect {
    background-color: #f8d7da;
    color: #721c24;
    border: 2px solid #f5c6cb;
    animation: shake 0.5s ease-in-out;
}

.img-container {
    margin-top: 20px;
}

.img-container img {
    width: 200px;
    height: 200px;
    border-radius: 10px;
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease-in-out;
}

.img-container img:hover {
    transform: scale(1.1);
}

/* Animaciones */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-10px); }
    50% { transform: translateX(10px); }
    75% { transform: translateX(-10px); }
}

</style>


<!-- fin principal -->



      <!-- Seccion para rellenar y me quede bonita -->

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
            <img src="../img/el-rey-leon.jpg" class="img-fluid" alt="El Rey León Promo">
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



