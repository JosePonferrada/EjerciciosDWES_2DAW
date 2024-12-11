<?php
// Importaciones.
require_once '../model/juego.php';
require_once '../model/cliente.php';
require_once '../model/alquiler.php';
require_once '../controller/controllerJuego.php';
require_once '../controller/controllerAlquiler.php';

// Obtenemos los datos del juego seleccionado en Inicio.
if (isset($_POST['cod_juego'])) {
    // Guardamos el juego en la sesión.
    session_start();
    $_SESSION['juego'] = ControllerJuego::getJuegoById($_POST['cod_juego']);
    // Sacamos el juego y el cliente de la sesión.
    $juego = $_SESSION['juego'];
}

// 
if (!isset($_POST['cod_juego']) && isset($_COOKIE['PHPSESSID'])) {
    session_start();
}

// Si no existe un juego en la sesión.
if (!isset($_SESSION['juego'])) {
    // Volvemos a cargar la página.
    header("Location:inicio.php");
}

// Si pulsamos sobre Modificar.
if (isset($_POST['modify'])) {
    // Sacamos los datos de los inputs y los guardamos en un objeto Juego.
    $j = new Juego($_SESSION['juego']->codigo, $_POST['name'], $_POST['console'], $_POST['year'], 
            $_POST['price'], $_SESSION['juego']->alquilado, $_SESSION['juego']->imagen, $_POST['details']);
    
    // Realizamos la modificacion.
    ControllerJuego::updateJuego($_SESSION['juego']->codigo, $j);
    
    // Eliminamos solo el juego de la sesión.
    unset($_SESSION['juego']);
    
    // Volvemos a cargar la página Inicio.
    header("Location:inicio.php");
}

// Si pulsamos sobre Eliminar.
if (isset($_POST['delete'])) {
    $juego = $_SESSION['juego'];
    ControllerJuego::deleteJuego($juego->codigo);
    // Eliminamos solo el juego de la sesión.
    unset($_SESSION['juego']);
    // Volvemos a cargar la página.
    header("Location:inicio.php");
}

// Si pulsamos sobre Alquilar.
if (isset($_POST['rent'])) {
    // Comprobamos si existe un usuario conectado.
    if (isset($_SESSION['logueado'])) {
        // Procedemos a realizar la operación de Alquilar.
        $juego = $_SESSION['juego'];
        $cliente = $_SESSION['logueado'];
        // Método de inserción (en caso afirmativo, actualizamos la tabla Juegos
        // para indicar que el juego se encuentra alquilado).
        if (ControllerAlquiler::insertAlquiler($juego->codigo, $cliente->dni)
                && ControllerJuego::rentJuego($juego->codigo)) {
            // Eliminamos solo el juego de la sesión.
            unset($_SESSION['juego']);
            // Redirigimos a Inicio.
            header("Location:inicio.php");
        } else {
            // Mensaje de error.
            $msg = "<br><br><span style='color:red'>ERROR. No se ha podido alquilar el juego!</span>";
        }
    } else {
        // Redirigimos a Iniciar sesión.
        header("Location:login.php");
    }
}

// Si pulsamos sobre Volver a Inicio.
if (isset($_POST['go_back'])) {
    // Eliminamos solo el juego de la sesión.
    unset($_SESSION['juego']);
    // Redirigimos a Inicio.
    header("Location:inicio.php");
    exit();
}

// Si el cliente es admin, podrá realizar ciertas acciones.
if (isset($_SESSION['logueado']) && $_SESSION['logueado']->tipo === "admin") {
    $isAdmin=true;
}
?>

<html>
    <head>
        <title>Ficha juego - MVC (alquiler_juegos)</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col pt-3 pb-5">
                    <h1>Ficha juego</h1>
                    <form action="" method="POST">
                        <button type="submit" name="go_back" class="btn btn-dark">Volver a Inicio</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <!-- Columna izquierda -->
                <div class="col-4 text-center">
                    <div class="row d-flex flex-column">
                        <!-- Imagen -->
                        <div class="col pb-4">
                            <img src="<?php echo $juego->imagen; ?>" width="300px" height="350px" alt="Imagen de Juego"/>
                        </div>
                        <!-- Acciones -->
                        <div class="col">
                            <?php
                            // Si el juego no está alquilado, mostramos botón.
                            if (strcasecmp($juego->alquilado, "no") === 0) {
                                ?>
                                <form action="" method="POST">
                                    <button type="submit" name="rent" class="btn btn-primary w-50 fs-4">Alquilar</button>
                                </form>
                                <?php
                            } else {
                                // En caso contrario, mostramos mensaje y fecha de devolución.
                                $alquiler = ControllerAlquiler::getAlquilerByJuegoAlquilado($juego->codigo);
                                // Por defecto, el alquiler son de 7 días contando desde el día de alquiler.
                                //
                                // Le sumamos 7 días a la fecha de alquiler del juego seleccionado.
                                $fecha_7_dias = strtotime("+7 days", strtotime($alquiler->fecha_alquiler));
                                // Obtenemos una fecha con el formato deseado.
                                $fecha_devolucion = date("d-m-Y", $fecha_7_dias);
                                
                                echo "<div>";
                                echo "<p><strong>El juego está alquilado!</strong></p>";
                                echo "<p><strong>Fecha de devolución prevista:</strong> $fecha_devolucion</p>";
                                echo "</div>";
                            }
                            ?>
                            <!-- Mostramos el mensaje de error -->
                            <?php if (isset($_POST['rent']) && isset($msg)) echo $msg; ?>
                        </div>
                    </div>
                </div>
                <!-- Columna derecha - Detalles -->
                <div class="col-8">
                    <h2>Datos</h2>
                    <form action="" method="POST">
                        <div class="my-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="name" 
                                   value="<?php echo $juego->nombre_juego; ?>" <?php echo !isset($isAdmin)?"readonly":""; ?>>
                        </div>
                        <div class="my-3">
                            <label for="anio" class="form-label">Año:</label>
                            <input type="text" class="form-control" id="anio" name="year" 
                                   value="<?php echo $juego->anio; ?>" <?php echo !isset($isAdmin)?"readonly":""; ?>>
                        </div>
                        <div class="my-3">
                            <label for="consola" class="form-label">Consola:</label>
                            <input type="text" class="form-control" id="consola" name="console" 
                                   value="<?php echo $juego->nombre_consola; ?>" <?php echo !isset($isAdmin)?"readonly":""; ?>>
                        </div>
                        <div class="my-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea id="descripcion" class="form-control" name="details"
                                      rows="3" cols="5" <?php echo !isset($isAdmin)?"readonly":""; ?>><?php echo $juego->descripcion; ?></textarea>
                        </div>        
                        <div class="my-3">
                            <label for="precio" class="form-label">Precio(€):</label>
                            <input type="text" class="form-control" id="precio" name="price" 
                                   value="<?php echo $juego->precio; ?>" <?php echo !isset($isAdmin)?"readonly":""; ?>>
                        </div>
                        <?php
                        if (isset($isAdmin)) {
                            ?>
                        <div class="my-3 d-flex justify-content-end gap-3">
                             <button type="submit" name="modify" class="btn btn-warning">Modificar</button>
                             <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
                        </div>
                            <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>