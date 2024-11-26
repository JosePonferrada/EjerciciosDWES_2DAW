<form action="" method="post">
    Código: <input type="text" name="codigo"><br>
    Nombre: <input type="text" name="nombre"><br>
    Precio: <input type="text" name="precio"><br>
    
    <input type="submit" name="insertar" value="Insertar"><br>
</form>

<?php

require_once './Producto.php';

// Creating products
/*$p = new Producto("camisa01", "Camisa manga larga", 25);
echo $p."<br>";

$p1 = new Producto();
$p1->nuevoProducto("pantalon01", "Pantalón vaquero", 30);
echo $p1."<br>";
*/

if (isset($_POST['insertar'])) {
    $p = new Producto($_POST['codigo'], $_POST['nombre'], $_POST['precio']);
    
    if ($p->insertar()) {
        echo "Se ha insertado correctamente";
    } else {
        echo "No se pudo insertar el producto";
    }
}

?>