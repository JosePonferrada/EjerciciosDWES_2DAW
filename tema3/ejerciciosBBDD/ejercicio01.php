<html>
    <head>
        <title>Ejercicio 01 - BBDD Tienda</title>
    </head>
    <body>
        
        <h1>Traspaso Stock</h1>
        
        <form action="" method="post">
            
            Tienda de origen:
            <select id="origen">
                <option value="central">Central</option>
                <option value="sucursal1">Sucursal 1</option>
                <option value="sucursal2">Sucursal 2</option>
            </select>
            <br>

            Tienda de destino:
            <select id="destino">
                <option value="central">Central</option>
                <option value="sucursal1">Sucursal 1</option>
                <option value="sucursal2">Sucursal 2</option>
            </select>
            <br>
            
            Código producto: <input type="text" name="code"><br>
            
            Unidades: <input type="number" name="units"><br><br>
            
            <input type="submit" name="update" value="Actualizar"><br>
            
        </form>

        <?php

            try {
                
                $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
                
                // $conex -> autocommit(false);
                
            } catch (Exception $exc) {
                echo $ex -> getCode();
                die($exc -> getMessage());
                
            }
            
            try {
                
                if ($conex -> query("update stock set unidades = unidades - $_POST[units] "
                        . "where cod = $_POST[origen] and producto = '$_POST[code]'"))
                    
                        echo $conex -> affected_rows;
                    
                
                    $conex -> query("update stock set unidades = unidades + $_POST[units] "
                            . "where cod = $_POST[destino] and producto = '$_POST[code]'");
                
            } catch (Exception $exc) {

                echo $exc->getCode();
                
            }

                    
        ?>
        
    </body>
</html>
