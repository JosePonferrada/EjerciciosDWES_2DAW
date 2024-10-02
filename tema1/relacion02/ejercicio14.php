<!doctype html>

<html>
    <head>
        <title>Ejercicio 14 - Arrays</title>
    </head>
    <body>

        <?php
        
        $numeros = array(10, 20, 10, 30, 20, 30, 30, 40);

        $frecuencia = array(); // Frecuencia será un array que se "agrupará" por cada número

        foreach ($numeros as $numero) {
            
            if (isset($frecuencia[$numero])) {
            
                $frecuencia[$numero]++; // Incrementamos si ya ha aparecido
                
            } else {
                
                $frecuencia[$numero] = 1; // Inicializamos el contador en 1 si aparece por primera vez
                
            }
        }

        echo "Frecuencia de cada elemento:<br>";
        
        foreach ($frecuencia as $numero => $count) {
        
            echo "$numero aparece $count veces <br>";
            
        }
        
        ?>

    </body>
</html>
