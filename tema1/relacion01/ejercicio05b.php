<!doctype html>

<html>
    <head>
        <title>Ejercicio 05b</title>
    </head>
    <body>

        <table border="1px solid black">
            
            
            <?php
            
                $x = 5;
                $y = 7;
                $num = 1;

                do {
                    echo "<tr>";
                    $y = 0;
                    // $x++;
                    do { 
                        echo "<td>".$num++."</td>";
                        $y++;
                    } while ($y < 7);
                    echo "</tr>";
                    $x++;
                } while ($x < 5);

            ?>

        </table>
        
    </body>
</html>
