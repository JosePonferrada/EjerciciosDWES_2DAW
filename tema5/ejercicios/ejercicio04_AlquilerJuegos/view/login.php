<?php
// Importaciones.
require_once '../model/cliente.php';
require_once '../controller/controllerCliente.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID'])) session_start();

// Si existe una sesión Logueado, redirigimos a inicio.php
if (isset($_SESSION['logueado'])) {
    header("Location:inicio.php");
    exit();
}

// Si procedemos a Iniciar sesión.
if (isset($_POST['login'])) {
    // Si los campos de texto NO ESTÁN vacíos.
    if (!empty($_POST['user']) && !empty($_POST['pwd'])) {
        // Obtenemos un posible cliente según el usuario introducido.
        $cliente = ControllerCliente::getClienteById($_POST['user']);
        // Si existe cliente, comprobamos si la clave introducida es válida.
        if (ControllerCliente::isClienteValid($cliente, $_POST['pwd']) === 0) {
            // En caso afirmativo, abrimos sesión y guardamos los datos del
            // usuario logueado.
            // 
            // Vamos a establecer un tiempo de vida a la sesión.
            ini_set("session.gc_maxlifetime", 1800);
            // Establece un tiempo de expiración de 1800 segundos para la cookie de sesión.
            session_set_cookie_params(1800);
            session_start();
            $_SESSION['logueado'] = $cliente;

            // Redirigimos a Inicio.
            header("Location:inicio.php");
        } else {
            // Mensaje de error.
            $msg = "<br><br><span style='color:red'>USUARIO O CLAVE INCORRECTA!</span>";
        }
    } else {
        // Mensaje de error.
        $msg = "<br><br><span style='color:red'>USUARIO O CLAVE INCORRECTA!</span>";
    }
}
?>

<html>
    <head>
        <title>Login - MVC (alquiler_juegos)</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col py-3">
                    <h1>Iniciar sesión</h1>
                    <form action="" method="POST">
                        <div class="mb-3 mt-3">
                            <label for="usuario" class="form-label">Usuario:</label>
                            <input type="text" class="form-control" id="usuario" placeholder="Introduzca su usuario" name="user">
                        </div>
                        <div class="mb-3">
                            <label for="clave" class="form-label">Clave:</label>
                            <input type="password" class="form-control" id="clave" placeholder="Introduzca su clave" name="pwd">
                        </div>
                        <button type="submit" name="login" class="btn btn-success">Iniciar sesión</button>
                    </form>
                    <a href="registro.php"><button class="btn btn-warning">Registro</button></a>
                    <a href="inicio.php"><button class="btn btn-dark">Cancelar</button></a>
                    <!-- Mostramos el mensaje de error -->
                    <?php if (isset($_POST['login']) && isset($msg)) echo $msg; ?>
                </div>
            </div>
        </div>
    </body>
</html>