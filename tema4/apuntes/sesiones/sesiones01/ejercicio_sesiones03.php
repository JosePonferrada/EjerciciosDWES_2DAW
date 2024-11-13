<?php

// Naming the session
session_name("comares");

// The function to create or propagate a session is:
session_start();

echo session_name()."<br>";

$_SESSION['nombre'] = "Juan";

// To remove a session we can use

session_destroy();

session_unset();

?>
<br>
<a href="ejercicio_sesiones02.php">Ir a sesion2</a>
<a href="ejercicio_sesiones01.php">Ir a sesion1</a>