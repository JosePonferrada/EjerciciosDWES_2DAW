<!doctype html>

<html>
    <head>
        <title>Ejercicio 06c</title>
    </head>
    <body>  
            
        <?php

            $suma = 0;
            
            for ($i = 1; $i <= 100; $i++) {
            
                $suma += $i;
                
            }

            echo "La suma de los números de 1 a 100 utilizando for es: $suma";

        ?>
        
    </body>
</html>
