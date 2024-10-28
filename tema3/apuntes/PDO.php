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

    
?>