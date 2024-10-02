<!doctype html>

<html>
    <head>
        <title>Ejercicio 13 - Arrays</title>
    </head>
    <body>

        <?php
        
        $numeros = array(10, 20, 10, 30, 40, 20, 50, 30);

        $noDuplicados = array();

        foreach ($numeros as $numero) {
        
            if (!in_array($numero, $noDuplicados)) {
            
                $noDuplicados[] = $numero; 
                
            }
            
        }

        echo "Array sin duplicados: ";
        echo implode(" , ", $noDuplicados); // Implode — Join array elements with a string
        
        ?>

    </body>
</html>
