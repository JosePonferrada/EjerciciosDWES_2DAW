<?php

    try {
        
        $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
        $result = $conex -> query("SELECT * FROM marketing");
        if ($result -> num_rows) {
            
            // fetch_all() saca todos los registros en forma de array (matriz escalar)
            while ($fila = $result -> fetch_object()) { // Si es null lo tomará como falso y parará
                
                echo $fila -> Nombre;
                echo "<br>";
                            
            }
            
            // fetch_all(MYSQLI_ASSOC) = Matriz asociativa
            // fetch_all(MYSQLI_NUM) = Matriz escalar
            // fetch_all(MYSQLI_BOTH) = Duplica la matriz y crea una de cada tipo
            
            // fetch_array() saca el siguiente registro en un array
            // Funciona fila a fila
            // 
            // Por defecto la información estará duplicada, por lo que podemos acceder a la info
            // mediante los índices escalares o asociativos
            // Podemos usar MYSQL_... para especificar qué array queremos que devuelva
            // 
            // Con data_seek() podemos mover el puntero al índice que queramos para volver 
            // a leer desde la fila que queramos

            // Con la función fetch_assoc() podemos hacer lo mismo que con fetch_array(MYSQLI_ASSOC)
            // Con fetch_row() nos muestra la fila solo con índices escalares
            
            // También tenemos fetch_object() que va sacando cada fila y la mete en un objeto
            // Para acceder a los datos => Lo podemos hacer llamando a los atributos del 
            // objeto por el nombre de las columnas de la tabla
            
        } else {
            
            echo "No hay ningún registro en la BBDD";
            
        }
        
    } catch (Exception $ex) {

    }

?>