<!doctype html>

<html>
    <head>
        <title>Ejercicio 12 - Arrays</title>
    </head>
    <body>

        <?php
        
        $numeros = array(5, 10, 15, 20, 25);

        $suma = 0;

        foreach ($numeros as $numero) {
            
            $suma += $numero; 
            
        }

        echo "La suma de todos los elementos es: $suma";
        
        ?>
        
    </body>
</html>
