<!doctype html>

<html>
    <head>
        <title>Ejercicio 10 - Arrays</title>
    </head>
    <body>

        <?php
        
        $cadena = "Hola, buenas.";

        $contVocales = 0;

        $vocales = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U']; // Posibilidades

        for ($i = 0; $i < strlen($cadena); $i++) {
            
            $letra = $cadena[$i]; 
            
            if (in_array($letra, $vocales)) { // Comprobar si la letra es una vocal
                $contVocales++;
            }
        }

        echo "La cadena es: $cadena <br>";
        echo "El número de vocales en la cadena es: $contVocales";
        ?>

    </body>
</html>
