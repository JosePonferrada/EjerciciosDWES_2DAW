<!doctype html>

<html>
    <head>
        <title>Ejercicio 07</title>
    </head>
    <body>  
            
        <?php

            $suma_cuadrados = 0;

            for ($i = 1; $i <= 100; $i++) {
                
                $suma_cuadrados += $i * $i;  
                
            }

            echo "La suma de los cuadrados de los primeros 100 números enteros es: $suma_cuadrados";

        ?>
        
    </body>
</html>
