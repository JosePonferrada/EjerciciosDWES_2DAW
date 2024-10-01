<!doctype html>

<html>
    <head>
        <title>Ejercicio 08</title>
    </head>
    <body>  
            
        <?php

            $suma_pares = 0;
            $numero = 2;  // Primer número par

            for ($i = 1; $i <= 100; $i++) {
                
                $suma_pares += $numero;  
                $numero += 2;  
                
            }

            echo "La suma de los primeros 100 números enteros pares es: $suma_pares";

        ?>
        
    </body>
</html>
