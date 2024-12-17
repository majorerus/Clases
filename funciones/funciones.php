<?php
// Definimos la función que muestra los vuelos según el destino seleccionado
function mostrarVuelos($destino,$origen, $hora_inicio, $hora_fin)
{
    // Arrays de datos de vuelos: cada uno asocia un número de vuelo con distintos datos

    // Horas de salida para cada número de vuelo
    $vueloHoraSalida = [
        "NT1010" => "12:00", // Las Palmas
        "NT2010" => "12:15", // Fuerteventura
        "NT3010" => "13:30", // Tenerife Norte
        "NT1020" => "14:45", // Las Palmas
        "NT2020" => "16:00", // Fuerteventura
        "NT3020" => "08:30", // Lanzarote
        "NT1030" => "09:00", // Fuerteventura
        "NT2030" => "10:15", // Gran Canaria
        "NT3030" => "11:00", // Tenerife Norte
        "NT1040" => "11:30", // Tenerife Sur
        "NT2040" => "15:00", // La Palma
        "NT3040" => "16:15", // La Gomera
        "NT1050" => "17:00", // El Hierro
    ];

    // Aeropuertos de salida para cada número de vuelo
    $vueloAeroSalida = [
        "NT1010" => "LPA", // Las Palmas
        "NT2010" => "FUE", // Fuerteventura
        "NT3010" => "TFN", // Tenerife Norte
        "NT1020" => "LPA", // Las Palmas
        "NT2020" => "FUE", // Fuerteventura
        "NT3020" => "ACE", // Lanzarote
        "NT1030" => "FUE", // Fuerteventura
        "NT2030" => "TFN", // Tenerife Norte
        "NT3030" => "TFN", // Tenerife Norte
        "NT1040" => "TFS", // Tenerife Sur
        "NT2040" => "SPC", // La Palma
        "NT3040" => "GMZ", // La Gomera
        "NT1050" => "VDE", // El Hierro
    ];

    // Aeropuertos de llegada para cada número de vuelo
    $vueloAeroLlegada = [
        "NT1010" => "FUE", // Fuerteventura
        "NT2010" => "TFN", // Tenerife Norte
        "NT3010" => "LPA", // Las Palmas
        "NT1020" => "FUE", // Fuerteventura
        "NT2020" => "TFN", // Tenerife Norte
        "NT3020" => "LPA", // Las Palmas
        "NT1030" => "ACE", // Lanzarote
        "NT2030" => "FUE", // Fuerteventura
        "NT3030" => "LPA", // Las Palmas
        "NT1040" => "TFN", // Tenerife Norte
        "NT2040" => "GMZ", // La Gomera
        "NT3040" => "SPC", // La Palma
        "NT1050" => "TFS", // Tenerife Sur
    ];

    // Horas de llegada para cada número de vuelo (basadas en las horas de salida)
$vueloHoraLlegada = [
    "NT1010" => "13:35", // + 1h 35m desde "12:00"
    "NT2010" => "13:10", // + 55m desde "12:15"
    "NT3010" => "14:50", // + 1h 20m desde "13:30"
    "NT1020" => "15:45", // + 1h desde "14:45"
    "NT2020" => "17:20", // + 1h 20m desde "16:00"
    "NT3020" => "09:50", // + 1h 20m desde "08:30"
    "NT1030" => "10:15", // + 1h 15m desde "09:00"
    "NT2030" => "11:05", // + 50m desde "10:15"
    "NT3030" => "12:15", // + 1h 15m desde "11:00"
    "NT1040" => "12:50", // + 1h 20m desde "11:30"
    "NT2040" => "16:45", // + 45m desde "15:00"
    "NT3040" => "17:50", // + 1h 35m desde "16:15"
    "NT1050" => "18:45"  // + 1h 45m desde "17:00"
];


    // Imprimimos la cabecera de la tabla con el destino seleccionado
    echo "<h2>Vuelos a $destino</h2>";
    echo "<table class='table table-bordered table-striped vuelos-table'>
            <thead class='thead-light'>
                <tr>
                    <th>Número de Vuelo</th>
                    <th>Hora de Salida</th>
                    <th>Aeropuerto de Salida</th>
                    <th>Aeropuerto de Llegada</th>
                     <th>Hora de Llegada estimada</th>
                </tr>
            </thead>
            <tbody>";

    // Variable para verificar si se encuentran vuelos al destino
    $vuelosEncontrados = false;

    // Recorremos los vuelos y verificamos si el destino coincide y las horas están en rango
// Recorremos los vuelos y verificamos si el destino coincide y las horas están en rango
foreach ($vueloHoraSalida as $numeroVuelo => $horaSalida) {
    // Comprobamos si el vuelo tiene el origen correcto, el destino correcto y está dentro del rango de horas
    if (
        $vueloAeroSalida[$numeroVuelo] == $origen &&  // Verificar origen
        $vueloAeroLlegada[$numeroVuelo] == $destino && // Verificar destino
        $horaSalida >= $hora_inicio && $horaSalida <= $hora_fin // Verificar rango de horas
    ) {

        $horaLlegada = $vueloHoraLlegada[$numeroVuelo];
        // Si todas las condiciones se cumplen, imprimimos los datos del vuelo en una fila de la tabla
        echo "<tr>
                <td>$numeroVuelo</td>
                <td>$horaSalida</td>
                <td>{$vueloAeroSalida[$numeroVuelo]}</td>
                <td>{$vueloAeroLlegada[$numeroVuelo]}</td>
                   <td>$horaLlegada</td>
              </tr>";
        // Marcamos que se encontró al menos un vuelo
        $vuelosEncontrados = true;
    }
}

// Si no se encontraron vuelos, mostramos un mensaje
if (!$vuelosEncontrados) {
    echo "<tr>
            <td colspan='4' class='text-center'>No hay vuelos disponibles según los criterios seleccionados.</td>
          </tr>";
}


    // Si no se encontraron vuelos, mostramos un mensaje en la tabla
    if (!$vuelosEncontrados) {
        echo "<tr>
                <td colspan='4' class='text-center'>No hay vuelos disponibles a $destino en el rango de horas seleccionado.</td>
              </tr>";
    }

    // Cerramos la tabla HTML
    echo "</tbody></table>";
} ?>


