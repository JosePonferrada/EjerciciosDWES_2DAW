<form action="" method="post" enctype="multipart/form-data">
    Código: <input type="text" name="codigo"><br>
    Nombre: <input type="text" name="nombre"><br>
    Precio: <input type="text" name="precio"><br>
    Imagen del producto: <input type="file" name="imagen"><br>

    <input type="submit" name="insertar" value="Insertar"><br>
    <input type="submit" name="mostrar" value="Mostrar"><br>
</form>

<?php
// Si un form va a subir ficheros debemos añadir un nuevo atributo en la etiqueta form
// Insertamos el atributo: enctype="multipart/form-data"
if (isset($_POST['insertar'])) {
    echo "Nombre: " . $_FILES['imagen']['name'] . "<br>";
    echo "Nombre temporal: " . $_FILES['imagen']['tmp_name'] . "<br>";
    echo "Tamaño: " . $_FILES['imagen']['size'] . "<br>";
    echo "Tipo: " . $_FILES['imagen']['type'] . "<br>";
    echo "Error: " . $_FILES['imagen']['error'] . "<br>";

    if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
        // Le concatenamos el tiempo delante del archivo para 
        // así no perder la extensión e identificar a cada archivo de manera distinta
        $fich = time() . "-" . $_FILES['imagen']['name'];
        $rutaRel = "img/$fich"; // Así podemos guardar la ruta relativa en la BBDD
        move_uploaded_file(($_FILES['imagen']['tmp_name']), $rutaRel);

        // Guardamos el fichero en la BBDD
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "objetos_bbdd");
            $conex->query("insert into producto values ('$_POST[codigo]', '$_POST[nombre]', $_POST[precio], '$rutaRel')");
        } catch (Exception $ex) {
            die("Error " . $ex->getMessage());
        }
    }
}

if (isset($_POST['mostrar'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "objetos_bbdd");
        $result = $conex->query("select * from producto");
        if ($result->num_rows) {
            while ($fila = $result->fetch_object()) {
                echo "Código: " . $fila->codigo . "<br>";
                echo "Nombre: " . $fila->nombre . "<br>";
                echo "Precio: " . $fila->precio . "<br>";
                echo "Imagen: <img src='$fila->imagen' width='50' height='50'><br><br>";
            }
        }
    } catch (Exception $ex) {
        die("Error " . $ex->getMessage());
    }
}


?>