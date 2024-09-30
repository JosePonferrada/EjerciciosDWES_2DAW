<!doctype html>

<html>
    <head>
        <title>Ejercicio 06 - Arrays</title>
    </head>
    <body>

        <?php
        
            $nombres = array("Ana", "Luis", "Carlos", "María");
            
            foreach (array_reverse($nombres) as $value) {
                echo "<p>".$value."</p>";
            }
            
            echo in_array("Carlos", $nombres);
            
            array_push($nombres, "Juan");
            
            foreach ($nombres as $value) {
                echo "<p>".$value."</p>";
                
            }
            
        ?>
        
    </body>
</html>
