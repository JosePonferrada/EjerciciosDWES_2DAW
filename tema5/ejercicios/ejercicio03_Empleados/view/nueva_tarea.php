<?php

require_once '../controller/conexion.php';
require_once '../controller/controllerEmpleado.php';
require_once '../controller/controllerTarea.php';
require_once '../controller/controllerRealiza.php';
require_once '../model/empleado.php';
require_once '../model/tarea.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID'])) session_start();

// Si no existe sesión, redirigir a Index
if (!isset($_SESSION['logueado'])) {
    header("Location:index.php");
    exit();
} else {
    $autenticado = $_SESSION['logueado'];
}

// Si pulsamos sobre Crear tarea.
if (isset($_POST['crear'])) {
    if (!empty($_POST['nombre'])
            && !empty($_POST['fecha_fin'])
            && !empty($_POST['fecha_inicio'])
            && !empty($_POST['participantes'])) {
        
        // Guardamos los datos correspondientes en objeto Tarea.
        $tarea = new Tarea(null, $_POST['nombre'], $_POST['fecha_inicio'], $_POST['fecha_fin']);
        // Insertamos.
        $id_tarea = ControllerTarea::insertar($tarea);
        
        // Sacamos a los participantes.
        $participantes = $_POST['participantes'];
        // Insertamos en tabla realiza los participantes de dicha tarea.
        ControllerRealiza::insertRealiza($id_tarea, $participantes);
    }
}

// Obtenemos a todos los empleados.
$empleados = ControllerEmpleado::getAll();

?>

<html>
    <head>
        <title>Nueva tarea (MVC - Empleados)</title>
    </head>
    <body>
        <h1>Nueva tarea</h1>
        <form action="" method="POST">
            <p>Nombre: <input type="text" name="nombre"></p>
            <p>Fecha inicio: <input type="date" name="fecha_inicio"></p>
            <p>Fecha fin: <input type="date" name="fecha_fin"></p>
            <p>Participantes:
                <select name="participantes[]" multiple="">
                    <?php
                    // Agregamos como opción a todos los empleados a
                    // excepción del empleado logueado.
                    foreach ($empleados as $emp) {
                        if ($emp->email !== $autenticado->email 
                                && $emp->departamento === $autenticado->departamento) {
                            echo "<option value='$emp->email'>" . $emp->nombre . "</option>";
                        }
                    }
                    ?>
                </select>
            </p>
            <button type="submit" name="crear">Crear tarea</button>
        </form>
    </body>
</html>