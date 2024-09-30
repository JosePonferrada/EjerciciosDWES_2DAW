<!doctype html>

<html>
    <head>
        <title>Ejercicio 05 - Arrays</title>
    </head>
    <body>

        <?php
        
            $productos = array(
                0 => array("nombre" => "Patatas", "precio" => 3, "cantidad" => 2),
                1 => array("nombre" => "Coliflor", "precio" => 4, "cantidad" => 1),
                2 => array("nombre" => "CocaCola", "precio" => 4, "cantidad" => 5)
            );
            
            echo $productos[1]["nombre"]." - ".$productos[1]["precio"]."€";
            
            echo "<br>";
            
            echo "<table>";
            
            echo "<th></th>";
                foreach ($productos[0] as $index => $value) {
                    echo "<th>".$index."</th>";
                }
            
            foreach ($productos as $indFila => $fila) {
                    echo "<tr><td>".$indFila."</td>";
                    foreach ($fila as $indColumna => $value) {
                        echo "<td>".$value."</td>";
                    }
                    echo "</tr>";
                }
             
            echo "</table>";
            
        ?>
        
    </body>
</html>
