<?php

$datos = file_get_contents("http://localhost/EjerciciosDWES_2DAW/tema6/2.-crearServicio/server.php");
//var_dump($datos);
$trenes = json_decode($datos);

//echo $trenes;

foreach ($trenes as $tren) {
    echo "<br>Recorrido ".$tren->recorrido." a la hora ".$tren->hora." por un precio de ".$tren->precio."€<br><br>";
}

?>