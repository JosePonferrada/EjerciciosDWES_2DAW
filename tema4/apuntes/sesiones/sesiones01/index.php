<?php

session_start(); // Propagating

echo $_SESSION['usuario']->Nombre." ".$_SESSION['usuario']->Apellidos;

?>