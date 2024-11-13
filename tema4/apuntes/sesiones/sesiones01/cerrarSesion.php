<?php

// Opening the session (by propagation)
session_start();

// Removing 

session_destroy(); // Physic side

session_unset(); // Memory side

// To remove the cookie on the client side
setcookie("PHPSESSID", '', time() - 3600, "/");

// The last parameter will search that cookie on the root


echo $_SESSION['nombre'];

?>

<a href="ejercicio_sesiones01.php">Ir a sesion1</a>