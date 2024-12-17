<?php
include 'conexion.php';
session_start();



// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recoger datos del formulario
    $titulo = $_POST['titulo'];
    $nombre = $_POST['nombre'];
    $primer_apellido = $_POST['primer_apellido'];
    $segundo_apellido = $_POST['segundo_apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $nacionalidad = $_POST['nacionalidad'];
    $residente_canarias = isset($_POST['residente_canarias']) ? 1 : 0;
    $isla = $_POST['isla'];
    $municipio = $_POST['municipio'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $documento_tipo = $_POST['documento_tipo'];
    $documento_numero = $_POST['documento_numero'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Hash seguro
    $usuario = $_POST['usuario'];

    $numeroTarjeta = "NT10" . substr(md5(uniqid(mt_rand(), true)), 0, 6); // Tarjeta única
    $fichero_subido = NULL; // Inicialización


if ($fichero_subido == NULL){
    $fichero_subido = "";
}



    // Validar campos obligatorios
    if (!empty($nombre) && !empty($primer_apellido) && !empty($email)) {
        // Procesar subida de foto si existe
        if (!empty($_FILES['fichero_usuario']['name'])) {
            $tipo_archivo = $_FILES['fichero_usuario']['type'];
            $tamano_archivo = $_FILES['fichero_usuario']['size'];
            $tamanio_maximo = 1048576; // 1MB

            if (($tipo_archivo === 'image/png' || $tipo_archivo === 'image/jpeg') && $tamano_archivo <= $tamanio_maximo) {
                $dir_subida = 'subidos/';
                $fichero_subido = $dir_subida . sha1_file($_FILES['fichero_usuario']['tmp_name']) . basename($_FILES['fichero_usuario']['name']);

                if (!move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
                    echo '<div class="alert alert-danger">Error al subir la imagen.</div>';
                    $fichero_subido = NULL;
                }
            } else {
                echo '<div class="alert alert-warning">El archivo debe ser PNG/JPEG y menor de 1MB.</div>';
            }
        }

        // Insertar datos en la base de datos
        $query = "INSERT INTO usuarios (titulo, nombre, primer_apellido, segundo_apellido, fecha_nacimiento, nacionalidad, residente_canarias, isla, municipio, telefono, email, documento_tipo, documento_numero, contrasena, login, foto, tarjeta)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param(
                "ssssssissssssssss",
                $titulo,
                $nombre,
                $primer_apellido,
                $segundo_apellido,
                $fecha_nacimiento,
                $nacionalidad,
                $residente_canarias,
                $isla,
                $municipio,
                $telefono,
                $email,
                $documento_tipo,
                $documento_numero,
                $contrasena,
                $usuario,
                $fichero_subido,
                $numeroTarjeta
            );

            if ($stmt->execute()) {
                echo '<div class="alert alert-success">Registro exitoso.</div>';
                echo "<meta http-equiv='refresh' content='2; url=index.php'>";
            } else {
                echo '<div class="alert alert-danger">Error al registrar: ' . $stmt->error . '</div>';
            }

            $stmt->close();
        } else {
            echo '<div class="alert alert-danger">Error en la consulta: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Por favor, complete todos los campos obligatorios.</div>';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="favicon.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <style>
/* Estilo para el formulario */
form {
    background-color: #f4f4f4; /* Fondo gris claro para el formulario */
    padding: 20px;
    border-radius: 8px;
}

/* Estilo para los campos de texto */
form .form-control {
    border-color: #77C34D; /* Verde Binter para los bordes */
    box-shadow: 0 0 5px rgba(119, 195, 77, 0.5); /* Sombra sutil en verde */
}

form .form-control:focus {
    border-color: #4cae4c; /* Verde más oscuro cuando el campo está enfocado */
    box-shadow: 0 0 5px rgba(77, 172, 77, 0.5);
}

/* Estilo para el botón de enviar */
form .btn-success {
    background-color: #77C34D; /* Verde Binter */
    border-color: #77C34D;
    color: white;
}

form .btn-success:hover {
    background-color: #66b348; /* Verde más oscuro en hover */
    border-color: #66b348;
}

/* Estilo para las etiquetas */
form .form-label {
    font-weight: bold;
    color: #333; /* Color gris oscuro para las etiquetas */
}

/* Estilo para los selectores */
form .form-select {
    border-color: #77C34D; /* Verde Binter para los selectores */
}

form .form-select:focus {
    border-color: #4cae4c;
    box-shadow: 0 0 5px rgba(77, 172, 77, 0.5);
}

/* Estilo para las casillas de verificación */
form .form-check-input:checked {
    background-color: #77C34D;
    border-color: #77C34D;
}



    </style>
</head>
<body>
    <div class="container my-5">
    <h1 class="text-center text-success">Registro de Usuario</h1>
<form method="POST" enctype="multipart/form-data" action="registro.php" class="row g-3">
    <!-- Título -->
    <div class="col-md-2">
        <label for="titulo" class="form-label">Título</label>
        <select class="form-select" name="titulo" id="titulo" required>
            <option value="" disabled selected>Seleccione...</option>
            <option value="Sr.">Sr.</option>
            <option value="Sra.">Sra.</option>
            <option value="Otro">Otro</option>
        </select>
    </div>

    <!-- Nombre -->
    <div class="col-md-5">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombre" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo se permiten letras y espacios">
    </div>

    <!-- Primer Apellido -->
    <div class="col-md-5">
        <label for="primer_apellido" class="form-label">Primer Apellido</label>
        <input type="text" class="form-control" name="primer_apellido" id="primer_apellido" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo se permiten letras y espacios">
    </div>

    <!-- Segundo Apellido -->
    <div class="col-md-6">
        <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
        <input type="text" class="form-control" name="segundo_apellido" id="segundo_apellido" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo se permiten letras y espacios">
    </div>

    <!-- Fecha de Nacimiento -->
    <div class="col-md-6">
        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
        <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" required max="2006-12-31" title="Debe ser mayor de edad">
    </div>

    <!-- Nacionalidad -->
    <div class="col-md-4">
        <label for="nacionalidad" class="form-label">Nacionalidad</label>
        <input type="text" class="form-control" name="nacionalidad" id="nacionalidad" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo se permiten letras y espacios">
    </div>

    <!-- Residente en Canarias -->
    <div class="col-md-4">
        <label for="residente_canarias" class="form-label">Residente en Canarias</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="residente_canarias" id="residente_canarias">
            <label class="form-check-label" for="residente_canarias">Sí</label>
        </div>
    </div>

    <!-- Isla -->
    <div class="col-md-4">
        <label for="isla" class="form-label">Isla</label>
        <select class="form-select" name="isla" id="isla" required>
            <option value="" disabled selected>Seleccione una isla...</option>
            <option value="La Palma">La Palma</option>
            <option value="La Gomera">La Gomera</option>
            <option value="Tenerife">Tenerife</option>
            <option value="Gran Canaria">Gran Canaria</option>
            <option value="Lanzarote">Lanzarote</option>
            <option value="Fuerteventura">Fuerteventura</option>
            <option value="El Hierro">El Hierro</option>
            <option value="La Graciosa">La Graciosa</option>
        </select>
    </div>

    <!-- Municipio -->
    <div class="col-md-6">
        <label for="municipio" class="form-label">Municipio</label>
        <input type="text" class="form-control" name="municipio" id="municipio" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo se permiten letras y espacios">
    </div>

    <!-- Teléfono -->
    <div class="col-md-6">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="tel" class="form-control" name="telefono" id="telefono" required pattern="^\d{9}$" title="El teléfono debe tener 9 dígitos">
    </div>

    <!-- Email -->
    <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" required>
    </div>

    <!-- Tipo de Documento -->
    <div class="col-md-6">
        <label for="documento_tipo" class="form-label">Tipo de Documento</label>
        <select class="form-select" name="documento_tipo" id="documento_tipo" required>
            <option value="" disabled selected>Seleccione...</option>
            <option value="DNI">DNI</option>
            <option value="Pasaporte">Pasaporte</option>
        </select>
    </div>

    <!-- Número de Documento -->
    <div class="col-md-6">
        <label for="documento_numero" class="form-label">Número de Documento</label>
        <input type="text" class="form-control" name="documento_numero" id="documento_numero" required pattern="\d{8}[A-Za-z]" title="El número de documento debe tener 8 dígitos seguidos de una letra">
    </div>

    <!-- Contraseña -->
    <div class="col-md-6">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="contrasena" id="contrasena" required minlength="8" title="La contraseña debe tener al menos 8 caracteres">
    </div>

    <!-- Usuario -->
    <div class="col-md-6">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" class="form-control" name="usuario" id="usuario" required pattern="[A-Za-z0-9_]+" title="Solo se permiten letras, números y guiones bajos">
    </div>

    <!-- Subir Foto -->
    <div class="col-md-12">
        <label for="fichero_usuario" class="form-label">Subir Foto (PNG o JPEG)</label>
        <input type="file" class="form-control" name="fichero_usuario" id="fichero_usuario">
    </div>

    <!-- Botón de Enviar -->
    <div class="col-12 text-center">
        <button type="submit" class="btn btn-success">Registrarse</button>
    </div>
</form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
