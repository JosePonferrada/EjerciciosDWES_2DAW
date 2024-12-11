<?php
// Importaciones.
require_once '../model/juego.php';
require_once '../model/cliente.php';
require_once '../controller/controllerJuego.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID']))
    session_start();

// Si no existe una sesión Logueado y el cliente no sea admin.
if (!isset($_SESSION['logueado']) || $_SESSION['logueado']->tipo === 'cliente') {
    header("Location:inicio.php");
    exit();
}

// Si pulsamos sobre Agregar juego.
if (isset($_POST['insert'])) {
    // Comprobamos si los campos están vacíos.
    if (!empty($_POST['name']) && !empty($_POST['year']) 
            && !empty($_POST['console']) && !empty($_POST['price']) 
            && !empty($_FILES['image']) && $_FILES['image']['size'] > 0 
            && !empty($_POST['details'])) {
        
        // Obtenemos la ruta de la imagen a subir a la BD
        // (después de subirla al server).
        $ruta = uploadImageToServer('image');
        
        // Obtenemos el código del juego (primary key).
        $codigo = ControllerJuego::generateCodigoJuego($_POST['name'], $_POST['console']);
        
        // Creamos un objeto Juego con los datos.
        $juego = new Juego($codigo, $_POST['name'], $_POST['console'], $_POST['year'], $_POST['price'], "NO", $ruta, $_POST['details']);
        
        // Realizamos la inserción.
        ControllerJuego::insertJuego($juego);
        
        // Volvemos a inicio.
        header("Location:inicio.php");
    }
} else {
    // Mensaje de error.
    $msg = "<br><br><span style='color:red'>No puede haber campos de texto vacíos!</span>";
}
?>

<html>
    <head>
        <title>Nuevo juego - MVC (alquiler_juegos)</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col py-3">
                    <h1>Nuevo juego</h1>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 mt-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Introduzca el nombre" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="anio" class="form-label">Año:</label>
                            <input type="text" class="form-control" id="anio" placeholder="Introduzca el año" name="year">
                        </div>
                        <div class="mb-3">
                            <label for="consola" class="form-label">Consola:</label>
                            <input type="text" class="form-control" id="consola" placeholder="Introduzca la consola" name="console">
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio:</label>
                            <input type="text" class="form-control" id="precio" placeholder="Introduzca el precio" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen:</label>
                            <input type="file" class="form-control" id="imagen" placeholder="Introduzca la imagen" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea id="descripcion" class="form-control" name="details"
                                      rows="3" cols="5"></textarea>
                        </div>
                        <button type="submit" name="insert" class="btn btn-success">Agregar juego</button>
                    </form>
                    <a href="inicio.php"><button class="btn btn-dark">Volver a Inicio</button></a>
                    <!-- Mostramos el mensaje de error -->
                    <?php if (isset($_POST['insert']) && isset($msg)) echo $msg; ?>                                        
                </div>
            </div>
        </div>
    </body>
</html>

<?php

/**
 * 
 * @param type $image_input
 * @return bool
 */
function uploadImageToServer($image_input) {
    // Si el fichero se ha subido correctamente al servidor, nombre temporal.
    if (is_uploaded_file($_FILES[$image_input]['tmp_name'])) {
        // Vamos a utilizar la fecha de subida del fichero para diferenciar entre fichero iguales.
        // Para ello, utilizamos la función time(). Si colocamos el tiempo concatenado al final
        // del nombre, sobreescribe la extesión, por lo que lo agregamos delante.
        $fich = time() . "_" . $_FILES[$image_input]['name'];
        // Si queremos guardar la ruta completa del fichero en la BD.
        $ruta = "../assets/" . $fich;
        // Cambiamos la ubicación del fichero subido, de esta manera
        // no perderemos el fichero (puesto que es temporal; desaparece tras acabar script).
        move_uploaded_file($_FILES[$image_input]['tmp_name'], $ruta);
    } else {
        $ruta = false;
    }
    return $ruta;
}
?>