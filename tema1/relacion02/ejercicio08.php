<!doctype html>

<html>
    <head>
        <title>Ejercicio 08 - Arrays</title>
    </head>
    <body>

        <?php

        $edades = array(20, 30, 40, 25, 35);

        $edad = 25;
        $posicion = array_search($edad, $edades);

        if ($posicion !== false) {

            echo "La edad $edad se encuentra en la posición: $posicion.";

        } else {
            
            echo "La edad $edad no se encontró en el array.";
        }
        ?>
        
    </body>
</html>
