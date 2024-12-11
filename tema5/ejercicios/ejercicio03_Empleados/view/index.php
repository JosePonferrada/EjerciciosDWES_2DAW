<?php
require_once '../controller/conexion.php';
require_once '../controller/controllerEmpleado.php';
require_once '../model/empleado.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID'])) session_start();

// Si existe una sesión Logueado, redirigimos a inicio.php
if (isset($_SESSION['logueado'])) {
    header("Location:inicio.php");
    exit();
}

if (isset($_POST['login'])) {
    if (!empty($_POST['email']) && !empty($_POST['pwd'])) {
        // Obtenemos el posible empleado.
        $emp = ControllerEmpleado::findById($_POST['email']);
        // Cotejamos la contraseña introducida con la establecida en el registro.
        if ($emp && verifyPassword($emp) === 0) {
            // Abrimos sesión.
            ini_set("session.gc_maxlifetime", 1800);
            // Establece un tiempo de expiración de 1800 segundos para la cookie de sesión.
            session_set_cookie_params(1800);
            session_start();
            $_SESSION['logueado'] = $emp;

            // Redirigimos a Inicio.
            header("Location:inicio.php");
            exit();
        } else {
            // Mensaje de error.
        $msg = "<br><span style='color:red'>USUARIO O CLAVE INCORRECTA!</span>";
        }
    } else {
        // Mensaje de error.
        $msg = "<br><span style='color:red'>USUARIO O CLAVE INCORRECTA!</span>";
    }
}
?>

<html>
    <head>
        <title>Login (MVC - Empleados)</title>
    </head>
    <body>
        <h1>Login</h1>
        <form action="" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
            <label for="pwd">Password:</label>
            <input type="password" name="pwd" id="pwd">
            <input type="submit" name="login" value="Iniciar sesión">
        </form>
        <!-- Mostramos el mensaje de error -->
        <?php if (isset($_POST['login']) && isset($msg)) echo $msg; ?>
    </body>
</html>

<?php

/**
 * 
 * @param type $e
 * @return bool
 */
function verifyPassword($e) {
    if ($e != null) {
        $encript = md5($_POST['pwd']);
        $result = strcasecmp($e->pass, $encript);
    } else {
        $result = false;
    }
    return $result;
}

?>