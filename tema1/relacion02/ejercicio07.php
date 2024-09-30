<!doctype html>

<html>
    <head>
        <title>Ejercicio 07 - Arrays</title>
    </head>
    <body>

        <?php
        
            $paises = array("España", "Francia", "Italia", "Alemania", "Portugal");
            
            echo "<br>";
            
            unset($paises[2]);
            
            foreach ($paises as $value) {
                echo "<p>".$value."</p>";
            }
            
            echo "==================================== <br>";
            
            array_pop($paises);
            
            foreach ($paises as $value) {
                echo "<p>".$value."</p>";
            }
                        
        ?>
        
    </body>
</html>
