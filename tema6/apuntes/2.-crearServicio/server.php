<?php

// Vamos a trabajar con trenes.sql y con la tabla tren

$conex = new PDO("mysql:host=localhost;dbname=trenes;charset=utf8mb4", "dwes", "abc123.");

// Si modificamos la URL al ejecutar y añadimos al final ?precio=28 nos mostrará aquellos trenes con precio mayor a 28
if (isset($_GET['precio'])) { // Si nos mandan el precio
    $result = $conex->query("select * from tren where precio_tourist > '$_GET[precio]'");
    
    if (isset($_GET['hora'])) {
        $result = $conex->query("select * from tren where precio_tourist > '$_GET[precio]' and hora = '$_GET[hora]'");
    }
    
} else {
    $result = $conex->query("SELECT * from tren");
}

// Esos result habrá que guardarlos en un array
$i = 0;
while ($reg = $result->fetchObject()) {
    $datos[$i]['recorrido'] = $reg->recorrido;
    $datos[$i]['hora'] = $reg->hora;
    $datos[$i]['precio'] = $reg->precio_tourist;
    $i++;
}

// Codificamos a formato JSON

echo json_encode($datos);

?>