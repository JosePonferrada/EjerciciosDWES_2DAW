<?php

// Starting a buffer
// ob_start();

$a = "Antonio";
echo "Hola<br>";

// Creating a cookie named usuario with the value Antonio and with an exp-time of an hour (time() + 3600)
setcookie("usuario", "Antonio");

if (isset($_COOKIE['usuario'])) {
    echo $_COOKIE['usuario']."<br>";
}

// To access the value of the cookie we use the name of the cookie
// echo $_COOKIE['usuario'];

// To see the length of the buffer
// echo ob_get_length();

//If we set a date before now, the cookie is deleted
// setcookie("usuario", "Antonio", time() - 1);

// To change the output_buffering size we must config php.ini
// If we set it to 0, we must send the headers first of all in order to avoid an error
// PHP code with headers before HTML output => No errors

// To end the buffer and send the content of it
// ob_end_flush();

?>

<!-- We are going to show the cookie through other file -->
<a href="cookieClient.php">Muestra la cookie</a>