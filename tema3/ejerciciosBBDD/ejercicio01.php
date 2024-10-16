<html>
    <head>
        <title>Ejercicio 01 - BBDD Tienda</title>
    </head>
    <body>
        
        <h1>Traspaso Stock</h1>
        
        <form action="" method="post">
            
            Tienda de origen:
            <select id="origen" name="origen">
                <option value="1">Central</option>
                <option value="2">Sucursal 1</option>
                <option value="3">Sucursal 2</option>
            </select>
            <br>

            Tienda de destino:
            <select id="destino" name="destino">
                <option value="1">Central</option>
                <option value="2">Sucursal 1</option>
                <option value="3">Sucursal 2</option>
            </select>
            <br>
            
            Código producto: <input type="text" name="code"><br>
            
            Unidades: <input type="number" name="units"><br><br>
            
            <input type="submit" name="update" value="Actualizar"><br>
            
        </form>

        <?php

        if (isset($_POST['update'])){
            
            try {
                
                $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
                
                // $conex -> autocommit(false);
                
            } catch (Exception $exc) {
                
                die("Error al conectar");
                
            }
            
            try {
                
                $conex -> autocommit(false);
                
                $conex -> query("UPDATE stock set unidades = unidades - $_POST[units] where "
                        . "tienda = $_POST[origen] AND producto = '$_POST[code]' AND "
                        . "unidades >= $_POST[units]");
                
                if (!$conex -> affected_rows) 
                    echo "Número de unidades no disponible en stock";
                
                else {
                  
                    $conex -> query("UPDATE stock set unidades = unidades + $_POST[units] where "
                        . "tienda = $_POST[destino] AND producto = '$_POST[code]'");
                    
                    if (!$conex -> affected_rows) // Si no hay registro de ese producto en la tienda, se crea
                        $conex -> query("INSERT INTO stock values('$_POST[code]', $_POST[destino], "
                                . "$_POST[units])");
                    
                }   
                
                $conex -> commit();
                
                echo "Operación completada con éxito";
                                
            } catch (Exception $exc) {

                $conex -> rollback();
                echo "Error. No se ha podido realizar el traspaso de stock";
                
            }
            
            $conex -> close();
            
        }
            
        ?>
        
    </body>
</html>
