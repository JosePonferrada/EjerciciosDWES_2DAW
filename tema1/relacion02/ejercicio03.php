<!doctype html>

<html>
    <head>
        <title>Ejercicio 03 - Arrays</title>
    </head>
    <body>

        <?php
        
            $numeros = array(3, 1, 4, 1, 5, 9);
            
            sort($numeros); // Ordenamos de manera ascendente
            echo "<h3>Array ordenado de manera ascendente: </h3>";
            foreach ($numeros as $value) {
                echo $value." - ";
            }
            
        ?>
        
    </body>
</html>
