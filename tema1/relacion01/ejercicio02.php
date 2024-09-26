<!doctype html>

<html>
    <head>
        <title>Ejercicio 02</title>
    </head>
    <body>
        <!-- Mostrar en pantalla una tabla de 10 por 10 con los números impares a partir de
        uno generado al azar. Se debe ver en el navegador los bordes de la tabla. -->

        
        <table border="1px solid black">
            
            
            <?php
            
                $x = 10;
                $y = 10;
                

                for ($index = 0; $index < $x; $index++) {
                    echo "<tr>";
                    for ($index1 = 0; $index1 < 10; $index1++) {
                        
                        do {
                            $randNum = rand(1, 100);
                        } while ($randNum % 2 == 0);
                            echo "<td>".$randNum."</td>";
                    }
                    echo "</tr>";
                }

            ?>

        </table>
        
        
    </body>
</html>
