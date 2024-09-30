<?php

echo $_POST['nombre']." ".$_POST['apell'];

// echo $_GET['nombre']." ".$_GET['apell'];

// Mostramos el primer elemento marcado del checkbox

//echo $_POST['modulos'][0];
echo "<br>";

// Para recorrer el array del checkbox y mostrarlo

foreach ($_POST["modulos"] as $value) {
    echo "<p>".$value."</p>";
}

// echo $_REQUEST['nombre']." ".$_REQUEST['apell'];

?>