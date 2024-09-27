<!doctype html>

<html>
    <head>
        <title>Ejercicio 01 - Arrays</title>
    </head>
    <body>

        <?php
        
            $colores = array("rojo", "verde", "azul", "amarillo");
            
            echo $colores[0]."<br>";
            echo $colores[2]."<br>";
            
            $colores[] = "naranja";
            
            for ($index = 0; $index < count($colores); $index++) {
                echo $colores[$index]." - ";
            }
        
        ?>
        
    </body>
</html>
