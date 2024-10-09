<!doctype html>

<html>
    <head>
        <title>Generación de la matriz</title>
    </head>
    <body>
        
        <?php 
        
            $rowFlag = 0; $colFlag = 0; $sqMatrix = 0; // 1 means true
            
            $option = intval($_REQUEST['id']);
            
            if (isset($_GET['enviar'])) {
                
                // Para que is_int() sea true deberá tener el número solo sin comillas dentro del paréntesis
                if (!empty($_GET['rows']) && $_GET['rows'] > 0 && is_int((int)$_GET['rows'])) {
                    
                    
                    $rowFlag = 1;
                    
                }
                
                if (!empty($_GET['cols']) && $_GET['cols'] > 0 && is_numeric($_GET['cols'])) {
                    
                    $colFlag = 1;
                    
                }
                
                if ($option == 4 && $_GET['rows'] === $_GET['cols'] && $colFlag == 1 && $rowFlag = 1) {
                    
                    $sqMatrix = 1;
                    
                } else {
                    
                    echo "<h4>La matriz no es cuadrada, por lo que no se puede calcular la suma de la diagonal</h4>";
                    
                }
                
            }
            
            // Vemos qué opcion ha escogido
            
            if (isset($_GET['enviar']) && $colFlag == 1 && $rowFlag == 1){
                
                switch ($option) {
                    case 1:
                        // Llamamos a la función 1
                        echo "Probando función 1";

                        break;

                    default:
                        echo "Elige una opción válida";
                        break;
                }
                
            }
        
        ?>

        <h3>Matriz a generar</h3>
        
        <form action="" method="get">
            
            Filas: <input type="number" name="rows">
            <?php if (isset($_GET['enviar']) && $rowFlag == 0) echo "Introduce un número mayor que 0"; ?>
            <br>
            Columnas: <input type="number" name="cols" value="">
            <?php if (isset($_GET['enviar']) && $colFlag == 0) echo "Introduce un número mayor que 0"; ?>
            <br><br>
            <input type="submit" name="enviar" value="Enviar">
            
            <!--<input type="hidden" name="option" value="<?php if (isset($_GET['enviar'])) $option; ?>"> -->
                        
        </form>
        
        <?php
        
        var_dump($_GET['id']);
        
        ?>
        
    </body>
</html>
