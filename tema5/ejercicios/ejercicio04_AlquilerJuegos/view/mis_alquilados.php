<?php
// Importaciones.
require_once '../model/cliente.php';
require_once '../model/juego.php';
require_once '../model/alquiler.php';
require_once '../controller/controllerJuego.php';
require_once '../controller/controllerAlquiler.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID'])) {
    session_start();
}

// Si existe sesión del Cliente, obtenemos los datos correspondientes.
if (isset($_SESSION['logueado'])) {
    $autenticado = $_SESSION['logueado'];
} else {
    header("Location:inicio.php");
}

// Si existe sesión Logueado y pulsamos sobre Cerrar sesión.
if (isset($autenticado) && isset($_POST['logout'])) {
    // Cerramos la sesión actual.
    session_unset();
    session_destroy();
    setcookie("PHPSESSID", "", time() - 3600, "/"); // Eliminación en el cliente.
    // Volvemos a cargar la página.
    header("Location:inicio.php");
    exit();
}

// Si pulsamos sobre Devolver.
if (isset($_POST['devolver'])) {
    // Actualizamos el registro en la tabla Alquiler, agregando la
    // fecha de devolucion (fecha actual) y el precio total a pagar.
    ControllerAlquiler::devolverJuego($_POST['devolver'], $_POST['precio']);
    // Cambiamos el estado del juego en la tabla Juegos.
    ControllerJuego::liberarJuego($_POST['cod_juego']);
    // Volvemos a cargar la página actual.
    header("Location:mis_alquilados.php");
    exit();
}
?>

<html>
    <head>
        <title>Mis alquilados - MVC (alquiler_juegos)</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col pt-4 pb-2">
                    <?php
                    // Si existe un cliente logueado, mostramos botón de Cerrar sesión.
                    if (isset($autenticado)) {
                        ?>
                        <label for="form-logout">Hola, <?php echo $autenticado->nombre . " " . $autenticado->apellidos; ?></label>
                        <a class="ps-3" href="inicio.php"><button class="btn btn-info">Inicio</button></a>
                        <form class="d-inline-block" id="form-logout" action="" method="POST">
                            <button type="submit" name="logout" class="btn btn-dark">Cerrar sesión</button>
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col pb-5">
                    <h1>Mis alquilados</h1>
                </div>
            </div>
            <!-- Listamos los alquileres activos -->
            <table>
                <?php showAlquileresActivos(ControllerAlquiler::getAlquileresActivosByCliente($autenticado->dni)); ?>
            </table>            
        </div>
    </body>
</html>

<?php

/**
 * 
 * @param type $fecha_devolucion
 * @return type
 */
function calcularDiasPasados($fecha_devolucion) {
    // Convertimos la fecha prevista a formato de tiempo (timestamp)
    $fechaPrevista = strtotime($fecha_devolucion);
    // Obtenemos la fecha actual en formato de tiempo (timestamp)
    $fechaActual = strtotime(date('Y-m-d'));
    // Calculamos la diferencia en segundos y la convertimos a días
    $diferenciaSegundos = $fechaActual - $fechaPrevista;
    $diasPasados = $diferenciaSegundos / (24 * 60 * 60);
    // Convertimos a entero para evitar decimales
    return (int) $diasPasados;
}

/**
 * 
 * @param type $fecha_alquiler
 * @return type
 */
function getFechaDevolucionPrevista($fecha_alquiler) {
    // Le sumamos 7 días a la fecha de alquiler del juego seleccionado.
    $fecha_7_dias = strtotime("+7 days", strtotime($fecha_alquiler));
    // Obtenemos una fecha con el formato deseado.
    return $fecha_devolucion = date("d-m-Y", $fecha_7_dias);
}

/**
 * 
 * @param type $alquileres
 */
function showAlquileresActivos($alquileres) {
    if ($alquileres) {
        foreach ($alquileres as $a) {
            // Obtenemos el juego del alquiler.
            $j = ControllerJuego::getJuegoById($a->cod_juego);
            // Mostramos todos los datos.
            echo "<tr>";
            // Imagen.
            echo "<td class='pb-5'>";
            echo "<img src='$j->imagen' width='200px' height='250px' alt='Cover $j->nombre_juego'>";
            echo "</td>";
            // Datos.
            echo "<td class='px-5'>";
            echo "<p><strong>Nombre:</strong> $j->nombre_juego</p>";
            echo "<p><strong>Fecha de alquiler:</strong> " . date("d-m-Y", strtotime($a->fecha_alquiler)) . "</p>";
            echo "<p><strong>Fecha de devolución prevista:</strong> " . getFechaDevolucionPrevista($a->fecha_alquiler) . "</p>";
            // Mostramos el precio que debería pagar el usuario al devolver.
            // Precio del juego + 1€ por día pasado.
            $dias = calcularDiasPasados(getFechaDevolucionPrevista($a->fecha_alquiler));
            // El precio será el del juego (no ha habido retrasos en la devolución)
            if ($dias <= 0)
                $precio = $j->precio;
            // En caso contrario, aumentamos el precio con la cantidad de días pasados.
            else
                $precio = ($j->precio + $dias);
            echo "<p><strong>Precio alquiler:</strong> " . $precio . "€</p>";
            echo "</td>";
            // Botón Devolver.
            echo "<td>";
            echo "<form action='' method='POST'>";
            echo "<input type='hidden' name='cod_juego' value='$j->codigo'>";
            echo "<input type='hidden' name='precio' value='$precio'>";
            echo "<button type='submit' name='devolver' value='$a->id' class='btn btn-primary fs-3'>Devolver</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    } ELSE {
        echo "NO HAY JUEGOS ALQUILADOS POR ESTE CLIENTE EN LA BD!";
    }
}
?>