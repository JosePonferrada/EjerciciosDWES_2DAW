<!doctype html>

<html>
    <head>
        <title>Ejercicio 03</title>
    </head>
    <body>
       
        <?php
        
            $num1 = -40;
            $num2 = -40;
            $num3 = -50;
                        
            if ($num1 >= $num2 && $num1 >= $num3) {
                echo 'El número más grande es el '.$num1;
            } elseif ($num2 >= $num1 && $num2 >= $num3) {
                echo 'El número más grande es el '.$num2;
            } else {
                echo 'El número más grande es el '.$num3;
            }
        
        ?>
        
    </body>
</html>
