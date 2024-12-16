<?php

$datos = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=Lucena,es&units=metric&appid=f1f129072fa78e11b1b511ebaf30c41a");

// echo $datos;

$datos_decode = json_decode($datos);

var_dump($datos_decode);

echo "<br>En la ciudad de ".$datos_decode->name." tendrá la siguiente temperatura: <br>";
echo "Mínima: ".$datos_decode->main->temp_min;

?>
