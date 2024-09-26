<!doctype html>

<html>
    <head>
        <title>Ejercicio 01 - Matrices</title>
    </head>
    <body>
        
        <style>
            
            table, td, th {
                padding: 1em;
                border-collapse: collapse;
                border: 1px solid black;
                font-family: Cascadia Code;
            }
            
        </style>    
        
        <h1>Tabla $_SERVER</h1>
        
        <table>
            
            <th>Indice</th>
            <th>Valor</th>

            <?php

                foreach ($_SERVER as  $key => $value) {
                    echo "<tr><td>".$key."</td><td>".$value."</td></tr>";
                }

            ?>
            
        </table>
        
    </body>
</html>
