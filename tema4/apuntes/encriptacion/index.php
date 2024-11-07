<?php

$cadena = "Antonio";
$cadena2 = "Antonio";

// Showing the hash
// MD5 uses the same codification always

echo md5($cadena)."<br>";
echo md5($cadena2)."<br>";

// This encryptation changes every time we exec the code, so its never the same
// More difficult to solve
// Cant be compared like on md5

$clave = password_hash($cadena, PASSWORD_DEFAULT);
echo password_hash($cadena2, PASSWORD_DEFAULT)."<br>";

// The method password_verify() uses as params => ($password, $hash) and returns boolean
if (password_verify($cadena2, $clave)) {
    echo "Clave correcta";
} else {
    echo "Clave incorrecta";
}

?>