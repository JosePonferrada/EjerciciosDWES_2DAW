<!doctype html>

<html>
    <head>
        <title>Ejercicio 09 - Arrays</title>
    </head>
    <body>

        <?php
        
        $numeros = array(12, 5, 8, 21, 3);

        // Decimos que el primer número es el máximo y el mínimo
        $maximo = $numeros[0];
        $minimo = $numeros[0];

        foreach ($numeros as $numero) {
        
            if ($numero > $maximo) $maximo = $numero;
            
            if ($numero < $minimo) $minimo = $numero;
            
        }

        
        echo "El valor máximo es: $maximo<br>";
        echo "El valor mínimo es: $minimo";
        
        ?>
        
    </body>
</html>
