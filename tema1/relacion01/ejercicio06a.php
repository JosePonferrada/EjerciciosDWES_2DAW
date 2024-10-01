<!doctype html>

<html>
    <head>
        <title>Ejercicio 06a</title>
    </head>
    <body>  
            
        <?php

            $suma = 0;
            $i = 1;

            do {

                $suma += $i;
                $i++;

            } while ($i <= 100);

            echo "La suma de los números de 1 a 100 utilizando do-while es: $suma";

        ?>
        
    </body>
</html>
