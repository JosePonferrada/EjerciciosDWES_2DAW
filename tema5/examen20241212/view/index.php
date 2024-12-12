<?php

require_once '../controller/controllerAgencia.php';
//require_once '../controller/Conexion.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID'])) session_start();

// Si existe una sesión Logueado, redirigimos a inicio.php
if (isset($_SESSION['logueado'])) {
    header("Location:menu.php");
    exit();
}

// Si procedemos a Iniciar sesión.
if (isset($_POST['login'])) {
    
    $usuario = $_POST['user'];
    // Si los campos de texto NO ESTÁN vacíos.
    if (!empty($_POST['user']) && !empty($_POST['pass'])) {
        // Obtenemos una posible agencia según el usuario introducido.
        $agencia = ControllerAgencia::getAgenciaByUsu($usuario);
        
        if($agencia->usuario === $_POST['pass']) {
            // En caso afirmativo, abrimos sesión y guardamos los datos del
            // usuario logueado.
            // 
            // Vamos a establecer un tiempo de vida a la sesión.
            ini_set("session.gc_maxlifetime", 30000);
            // Establece un tiempo de expiración de 1800 segundos para la cookie de sesión.
            session_set_cookie_params(30000);
            session_start();
            $_SESSION['logueado'] = $agencia;

            // Redirigimos a Menu.
            header("Location:menu.php");
        } else {
            $msg = "Error en el login, revisa las credenciales";
        }
        
    } else {
        $msg = "Pero no me dejes los campos vacíos...";
    }
    
}

?>

<html>
    <head>
        <title>Index</title>
    </head>
    <body>
        
        <h1>Inicio de sesión</h1>
        
        <form action="" method="POST">
            
            <p>Usuario: <input type="text" name="user"></p>
            <p>Clave: <input type="password" name="pass"></p>
            
            <input type="submit" name="login" value="Iniciar sesión">        
            
        </form>
        
        <span><?php if (isset($msg)) echo $msg; ?></span>
        
    </body>
</html>
