<?php

// Manolo will be shown on the second petition, the first one will show Antonio
setcookie("usuario", "Manolo");

// Showing the cookie
echo $_COOKIE['usuario']."<br>";

?>

<a href="index.php">Volver a inicio</a>