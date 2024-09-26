<!doctype html>

<html>
    <head>
        <title>Ejercicio 04</title>
    </head>
    <body>

        <table border="1px solid black">
            
            
            <?php
            
                $x = 5;
                $y = 7;
                $num = 1;

                for ($index = 0; $index < $x; $index++) {
                    echo "<tr>";
                    for ($index1 = 0; $index1 < $y; $index1++) { 
                        echo "<td>".$num++."</td>";
                    }
                    echo "</tr>";
                }

            ?>

        </table>
        
    </body>
</html>
