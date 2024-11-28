<form action="" method="post">
    Código: <input type="text" name="codigo"><br>
    Nombre: <input type="text" name="nombre"><br>
    Precio: <input type="text" name="precio"><br>
    
    <input type="submit" name="insertar" value="Insertar"><br>
    <input type="submit" name="mostrar" value="Mostrar"><br>
    <input type="submit" name="buscar" value="Buscar"><br>
</form>

<?php

require_once '../controller/ProductoController.php';
require_once '../model/Producto.php';

if (isset($_POST['insertar'])) {
    
    $p = new Producto($_POST['codigo'], $_POST['nombre'], $_POST['precio']);
    if (ProductoController::insertar($p)) {
        echo "Insertado correctamente";
    }
    
}

if (isset($_POST['mostrar'])) {
    if ($productos = ProductoController::recuperarTodos()) {
        foreach ($productos as $value) {
            echo $value."<br>";
        }
    } else {
        echo "No hay productos en la BBDD";
    }
}

if (isset($_POST['buscar'])) {
    if ($producto = ProductoController::buscaProducto($_POST['codigo'])) {
        echo $producto;
    } else {
        echo "No se encuentra un producto con ese código";
    }
}

?>