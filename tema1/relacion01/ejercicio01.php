<!doctype html>

<html>
    <head>
        <title>Ejercicio 01</title>
    </head>
    <body>
        
    <!-- Dado un año, indicar si es bisiesto o no.
     Para determinar si un año es bisiesto, siga estos pasos:
     a) Si el año es uniformemente divisible por 4, vaya al paso b. De lo contrario,
     vaya al paso e.
     b) Si el año es uniformemente divisible por 100, vaya al paso c. De lo
     contrario, vaya al paso d.
     c) Si el año es uniformemente divisible por 400, vaya al paso d. De lo
     contrario, vaya al paso e.
     d) El año es un año bisiesto (tiene 366 días).
     e) El año no es un año bisiesto (tiene 365 días). -->


        <?php
            
            $ano = 2024;
            
            if ($ano % 4 == 0) {
                if ($ano % 100 == 0) {
                    if ($ano % 400 == 0) {
                        echo 'El año '.$ano." es un año bisiesto";
                    } else {
                        echo 'El año '.$ano." no es un año bisiesto";
                    }
                } else {
                    echo 'El año '.$ano." es un año bisiesto";
                }
            } else {
                echo 'El año '.$ano." no es un año bisiesto";
            }
        
        ?>
        
    </body>
</html>

    