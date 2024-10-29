<?php

    // Para crear una conexión

    try {
        // Podemos establecer diferentes preferencias desde el array opciones e insertar ese array al final en la conexión
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4", 
            PDO::ATTR_CASE => PDO::CASE_LOWER); 
        
        $conex = new PDO('mysql:host=localhost;dbname=dwes;charset=utf8mb4', 'dwes', 'abc123.');
        
        $conex->beginTransaction();
        
        $reg = $conex->exec("UPDATE stock set unidades=100 where producto='3DSNG'");
        $reg2 = $conex->exec("UPDATE stock set unidades=100 where producto='3DSNG'");
        
        $conex->commit();
        
        if ($reg && $reg2) {
            echo 'Registros actualizados correctamente';
        } elseif ($reg === 0) {
            echo 'No se ha realizado la actualización porque no se encuentra el producto';
        } else {
            echo 'ERROR al realizar la actualización';
        }
        
    } catch (PDOException $exc) {
        
        $conex->rollBack();
        echo $exc->getMessage();
        
    }

    
    // CONSULTA
    
    try {
        // Devuelve un objeto de la clase PDOStatement
        $result = $conex->query("SELECT * FROM producto");
        echo "<br>Números de registros devueltos: ".$result->rowCount()."<br>";
        
        // Vamos a recorrer los resultados y mostrarlos
//        while ($fila = $result->fetch()) {
//            
//            echo "Nombre: ".$fila['nombre_corto']."<br>";
//            
//        }
//        
        // Otra forma de recorrer los resultados y mostrarlos
//        while ($fila = $result->fetch(PDO::FETCH_OBJ)) {
//            
//            echo "Nombre: ".$fila->nombre_corto."<br>";
//            
//        }
        
        // Otra forma distinta de recorrer los resultados y mostrarlos
        while ($fila = $result->fetchObject()) {
            
            echo "Nombre: ".$fila->nombre_corto."<br>";
            
        }
        
    } catch (PDOException $exc) {
        echo $exc->getMessage();

    }

    // CONSULTAS PREPARADAS
    
    echo "<br>============================================<br>";
    
    $menor = 100;
    $mayor = 200;
    
    try {
                
//        $result = $conex->prepare("SELECT * FROM producto where PVP between ? and ?");
        // Se le puede dar un nombre poniendo los 2 puntos delante
        $result = $conex->prepare("SELECT * FROM producto where PVP between :pvp1 and :pvp2");
        // De esta manera se asignan los valores si usamos las interrogaciones
        $result->bindParam(1, $menor);
        $result->bindParam(2, $mayor);
        
        // Así se le asignan los valores si usamos los nombres
//        $result->bindParam(":pvp1", $menor);
//        $result->bindParam(":pvp2", $mayor);
        
        // Otra opción es pasarle un array con los parámetros
        $result->execute(array(":pvp1" => $menor, ":pvp2" => $mayor));
        
//        $result->execute();
        echo "Filas devueltas: ".$result->rowCount()."<br>";
        
        while ($fila = $result->fetchObject()) {
            echo "<br>Nombre: ".$fila->nombre_corto."<br>";
        }
        
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }

    
?>