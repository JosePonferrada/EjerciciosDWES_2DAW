<?php 

    // Para las consultas preparadas usaremos el método prepare en vez del query()
    
//    try {
//
//        $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
//        
//        // Obtenemos un objeto del tipo mysqli_stmt en la variable $stmt
//        // Mandamos la instrucción al servidor de BBDD para que la analice y busque errores
//        
//        // $stmt = $conex -> prepare("INSERT INTO tienda values (4, 'Sucursal3', 123456789)");
//        
//        // Si queremos preparar una instrucción que se va a ejecutar varias veces usaremos el comodín '?'
//        
//        $stmt = $conex -> prepare("INSERT INTO tienda values (?, ?, ?)");
//        
//        $cod = 5; $telf = "111111111"; $nombre = "Sucursal5";
//        
//        // Asignamos un valor a cada parámetro (el primer parámetro indica el tipo de valores) NO SE PUEDEN USAR LITERALES
//        // i => Número entero
//        // d => Número real
//        // s => Cadena de texto
//        // b => Contenido en formato binario (BLOB)
//        $stmt -> bind_param('iss', $cod, $nombre, $telf);
//        
//        // Para ejecutar la instrucción usaremos execute()
//        
//        if ($stmt -> execute()) {
//            echo "Registro insertado correctamente";
//        }
//        
//        echo $stmt -> affected_rows;
//        
//    } catch (Exception $ex) {
//
//        die($ex -> getMessage());
//        
//    }


    // CONSULTAS PREPARADAS QUE DEVUELVEN RESULTADOS

    try {
        
        $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
        
        $stmt = $conex -> prepare("select * from tienda where cod > ?");
        
        $cod = 2;
        
        $stmt -> bind_param('i', $cod);
        
        $stmt -> execute();
        
        $stmt -> bind_result($codigo, $tienda, $telefono); // Guardamos los resultados en esas variables
        
        while ($stmt -> fetch()) {
            echo "Código: ".$codigo."<br>";
            echo "Tienda: ".$tienda."<br>";
            echo "Teléfono: ".$telefono."<br><br>";
        }
        
        // Otra manera de hacerlo
        
        echo "==============================================<br>";
        
        $stmt->execute(); //Ejecutamos de nuevo la instrucción para que lo muestre de nuevo
        
        $result = $stmt->get_result();
        
        while ($fila = $result->fetch_object()) {
            echo "Código: ".$fila->cod."<br>";
            echo "Tienda: ".$fila->nombre."<br>";
            echo "Teléfono: ".$fila->tlf."<br><br>";
        }
        
    } catch (Exception $ex) {

        die($ex -> getMessage());
        
    }

?>