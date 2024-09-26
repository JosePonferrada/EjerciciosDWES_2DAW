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
        
        <h1>Tabla Empresa</h1>
        
        <table>
            
            <?php

                $m1 = array(
                    "Contabilidad" => array("nombre" => "Pepe", "apellido" => "López", "salario" => 2100, "edad" => 35),
                    "Marketing" => array("nombre" => "Juan", "apellido" => "Rodríguez", "salario" => 2220, "edad" => 41),
                    "Ventas" => array("nombre" => "María", "apellido" => "Sánchez", "salario" => 2315, "edad" => 38),
                    "Administracion" => array("nombre" => "Susana", "apellido" => "Ramírez", "salario" => 1850, "edad" => 53),
                    "Direccion" => array("nombre" => "Rosa", "apellido" => "Carpio", "salario" => 3550, "edad" => 58)
                    
                );
                
                echo "<th></th>";
                foreach ($m1["Contabilidad"] as $index => $value) {
                    echo "<th>".$index."</th>";
                }
                                
                foreach ($m1 as $indFila => $fila) {
                    echo "<tr><td>".$indFila."</td>";
                    foreach ($fila as $indColumna => $value) {
                        echo "<td>".$value."</td>";
                    }
                    echo "</tr>";
                }

            ?>
            
        </table>
        
    </body>
</html>
