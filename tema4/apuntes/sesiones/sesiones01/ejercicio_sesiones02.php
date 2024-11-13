<?php

//setcookie("nombre", "pepe");
//setcookie("PHPSESSID", "hola");
//
//echo $_COOKIE['nombre'];

session_start();
echo $_SESSION['nombre']."<br>";

echo session_name()."<br>";

?>

<a href="ejercicio_sesiones01.php">Ir a sesion1</a>
<a href="ejercicio_sesiones03.php">Ir a sesion3</a>