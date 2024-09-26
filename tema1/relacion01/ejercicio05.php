<!doctype html>

<html>
    <head>
        <title>Ejercicio 05</title>
    </head>
    <body>

        <table border="1px solid black">
            
            
            <?php
            
                $x = 0;
                $y = 0;
                $num = 1;

                while ($x < 5) {
                    echo "<tr>";
                    $y = 0;
                    // $x++;
                    while ($y < 7) { 
                        echo "<td>".$num++."</td>";
                        $y++;
                    }
                    echo "</tr>";
                    $x++;
                }

            ?>

        </table>
        
    </body>
</html>
