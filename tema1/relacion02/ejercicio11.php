<!doctype html>

<html>
    <head>
        <title>Ejercicio 11 - Arrays</title>
    </head>
    <body>

        <?php
        
        $numeros = array(10, 20, 30, 40, 50);

        $suma = 0;
        
        foreach ($numeros as $numero) {
            
            $suma += $numero;
            
        }

        $promedio = $suma / count($numeros);

        echo "La suma de los números es: $suma <br>";
        echo "El promedio de los números es: $promedio";
        ?>
        
    </body>
</html>
