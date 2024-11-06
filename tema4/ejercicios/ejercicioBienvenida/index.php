<?php

// Creating the cookie
setcookie("usuario", "Jose", time() + (3600 * 24 * 365));

if (isset($_COOKIE['usuario'])) {
    echo "Hola, ".$_COOKIE['usuario']." tu último acceso fue ".date("d/M/Y H:s", time())."<br>";
} else {
    "Bienvenido ".$_COOKIE['usuario'].", gracias por su visita";
}

?>