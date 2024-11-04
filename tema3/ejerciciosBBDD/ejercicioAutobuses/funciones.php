<?php

function getConex($db) {
    
    try {
        $conex = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8mb4;','dwes','abc123.');
        return $conex;
    } catch (PDOException $exc) {
        die("No se pudo conectar con la BBDD");
    }
}

?>