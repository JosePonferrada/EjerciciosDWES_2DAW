<?php

    /**
    * Existen arrays asociativos, escalares y mixtos.
    * Escalares -> Índices numéricos
    * Asociativos -> Índices que son cadenas.
    * Mixtos -> Ambos
    * 
    * Los arrays son dinámicos y no es necesario que sean definidos al crearlos.
    * Los arrays no tiene un tipo.
    * 
    */

    $a[8] = "Pepe";
     
    echo $a[8]."<br>";
     
    $a[2] = "Antonio";
    $a[] = "Juan";
     
    // A Juan se le asigna el índice siguiente al mayor que ya exista en el array.
    
    $a["edad"] = 25; // Al añadir el índice "edad", se convierte en un array mixto.
    $a[5] = "Rosa";
     
    // Con los índices podemos aportar información y así saber qué guardamos.
     
    // Poniendo solo $a hacemos referencia al array completo y nos devuelve el número de elementos
    echo count($a)."<br>";
     
    // La forma más habitual de usar arrays en PHP es:
    // Se puede no poner los índices pero así creará un array escalar.
    $b = array(0 => 7, 8 => "Pepe");
     
    $c = array("codigo" => 1, "nombre" => "Pepe", "apell" => "López");
    
    echo "<br>";
     
    // Con print_r podemos ver el array sin formato para ver si está bien creado
    
    print_r($c)."<br>";
    
    echo "<br>";
    
    // Con var_dump podemos comprobar el tipo de variable 
    // que estamos usando y qué valores está tomando
     
    var_dump($c)."<br>";
    
    echo "<br>";
    
    foreach ($c as $value) {
        echo $value."<br>";
    }     
    
    echo "<br>";
    
    foreach ($c as $key => $value) {
        echo $key." - ".$value."<br>";
    }
    
    //Con sort podemos ordenar el array a través de sus índices
    
    echo "<br> <<========= MATRICES ========>> <br>";
    $matriz[][] = "pepe";
    $matriz[5][] = "antonio";
    $matriz[][] = "juan";
    $matriz[0]["apellido"] = "Lopez";
    $matriz[6]["edad"] = 34;
    $matriz[6][] = "Maria";
    
    echo $matriz[0][0];
    echo "<br>";
    echo $matriz[5][0];
    echo "<br>";
    echo $matriz[6][0];
    echo "<br>";
    echo $matriz[0]["apellido"];
    echo "<br>";
    echo $matriz[6]["edad"];
    echo "<br>";
    echo $matriz[6][1];
    echo "<br>";
    
    // Cuando haya algo en blanco mira qué valor definido es el más alto y lo coloca a continuación
    // Para recorrer toda la matriz lo haremos con un forEach anidado dentro de otro
    
    foreach ($matriz as $indFila => $fila) { // Selecciona cada fila + Sacamos su índice
        echo $indFila."<br>";
        foreach ($fila as $indColumna => $value) { // Recorre esa fila + Sacamos su índice
            echo "<br>".$indColumna." - ".$value;
        }
        echo "<br>";
    }
    
    echo "<br>";
    
    echo "Filas ".count($matriz); // Si le pasamos la matriz cuenta las filas
    
    echo "<br>";
    
    // Para saber el número de columnas tenemos que preguntar por las columnas de X fila
    
    echo "Columnas ".count($matriz[6]);
    
    echo "<br>";
    
    // Si queremos contar todos los elementos le añadimos a count el segundo valor para hacer
    // una cuenta recursiva
    
    echo "Total de elementos matriz1 ". count($matriz, 1);
    
    echo "<br>";
    
    // Para definir una matriz con la función array
    // Se va definiendo por pares de índice valor todo el rato
    
    $matriz2 = array(
        0 => array("codigo" => 1, "nombre" => "Pepe", "salario" => 2000),
        1 => array("codigo" => 2, "nombre" => "María", "salario" => 3000),
        2 => array("codigo" => 3, "nombre" => "Jose", "salario" => 2500)        
    );
    
    // Para mostrar toda la matriz
    
    foreach ($matriz2 as $indFila => $fila) {
        echo $indFila."<br>";
        foreach ($fila as $indColumna => $value) {
            echo $indColumna." = ".$value."<br>";
        }
        echo "<br>";
    }
    
    echo "Total de elementos matriz2: ". count($matriz2, 1);
    
?>