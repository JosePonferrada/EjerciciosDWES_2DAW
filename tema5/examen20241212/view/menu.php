<?php
require_once '../model/agencia.php';
require_once '../controller/controllerAgencia.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID'])) {
    session_start();
}

// Si existe sesión del Cliente, obtenemos los datos correspondientes.
if (isset($_SESSION['logueado'])) {
    $autenticado = $_SESSION['logueado'];
}

// Si existe sesión Logueado y pulsamos sobre Cerrar sesión.
if (isset($autenticado) && isset($_POST['logout'])) {
    // Cerramos la sesión actual.
    session_unset();
    session_destroy();
    setcookie("PHPSESSID", "", time() - 50000, "/"); // Eliminación en el cliente.
    // Volvemos a cargar la página.
    header("Location:index.php");
    exit();
}
?>

<html>
    <head>
        <title>Menú</title>
    </head>
    <body>

        <?php
        // Si existe un cliente logueado, mostramos botón de Cerrar sesión.
        if (isset($autenticado)) {
            ?>
            <p><?php echo $autenticado->nombre ?></p>
            <p><?php echo $autenticado->telf ?></p>
            
            <form action="" method="POST">
                <button type="submit" name="logout">Cerrar sesión</button>
            </form>
        <?php } ?>


        <?php
        // Si existe un cliente logueado, mostramos botón de Cerrar sesión.
        if (isset($autenticado)) {
            ?>
            <a href="reservas.php"><button>Reservas</button></a>
            <a href="billetes.php"><button>Billetes</button></a>
            <?php
        }
        ?>

    </body>
</html>
