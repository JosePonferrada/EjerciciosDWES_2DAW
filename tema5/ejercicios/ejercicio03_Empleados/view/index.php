<form action="" method="post">
    Email: <input type="email" name="email"><br>
    Pass: <input type="password" name="pass"><br>
    Nombre: <input type="text" name="nombre"><br>
    Salario: <input type="text" name="salario"><br>
    Departamento: <input type="text" name="dep"><br><br>
    
    <input type="submit" name="insertar" value="Insertar">
    <input type="submit" name="mostrar" value="Mostrar">
    <input type="submit" name="buscar" value="Buscar">
</form>

<?php

require_once '../controller/ControllerEmpleado.php';
require_once '../model/Empleado.php';

if (isset($_POST['insetar'])) {
    $emp = new Empleado($_POST['email'], $_POST['pass'], $_POST['nombre'], $_POST['salario'], $_POST['dep']);
    
    if (ControllerEmpleado::insertar($emp)) {
        echo "Insertado correctamente";
    }
}

if (isset($_POST['mostrar'])) {
    if ($empleados = ControllerEmpleado::getAll()) {
        foreach ($empleados as $value) {
            echo $value."<br>";
        }
    } else {
        "No hay registros en la BBDD";
    }
}

if (isset($_POST['buscar'])) {
    if ($emp = ControllerEmpleado::getEmpleadoByNombre($_POST['nombre'])) {
        echo $emp;
    } else {
        echo "No existe registro con ese nombre";
    }
}


?>