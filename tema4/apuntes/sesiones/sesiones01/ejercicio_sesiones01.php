<?php

// Naming the session
// session_name("comares");

// The function to create or propagate a session is:
session_start();

echo session_name()."<br>";

echo session_id()."<br>";

$_SESSION['nombre'] = "pepe";

?>

<a href="ejercicio_sesiones02.php">Ir a sesion2</a>
<a href="ejercicio_sesiones03.php">Ir a sesion3</a>
<a href="cerrarSesion.php">Cerrar sesión</a>