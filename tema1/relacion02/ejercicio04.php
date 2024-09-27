<!doctype html>

<html>
    <head>
        <title>Ejercicio 04 - Arrays</title>
    </head>
    <body>

        <?php
        
            $animales = array("gato", "perro", "elefante", "jirafa");
            
            echo "<p>El número de elementos es: ".count($animales)."</p>";
            
            $animales[] = "leon";
            $animales[] = "morsa";
            
            echo "<p>El número de elementos es: ".count($animales)."</p>";
            
        ?>
        
    </body>
</html>
