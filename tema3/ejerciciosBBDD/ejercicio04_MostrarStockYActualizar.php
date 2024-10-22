<html>
    <head>
        <title>Ejercicio Con Selects</title>
    </head>
    <style>
        
        h1 {margin-bottom:0;}
        #encabezado {background-color:#ddf0a4;}
        #contenido {background-color:#EEEEEE;height:600px;}
        #pie {background-color:#ddf0a4;color:#ff0000;height:30px;}

    </style>
    <body>

        <?php
        
            try {
                
                $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
                
                // $conex -> autocommit(false);
                
            } catch (Exception $exc) {
                
                die("Error al conectar");
                
            }
        
        ?>
        
        <div id="encabezado">
            
            <h1>Selecciona el producto</h1>
            
            <form action="" method="post">
                
                <p>
                
                    Producto: 
                    <select id="product" name="product">
                        <?php
                        
                        $selectedItem = isset($_POST['product']) ? $_POST['product'] : '';
                            
                        try {
                            
                            // Si hacemos la consulta poniendo solo el campo que queremos, mostrará los campos
                            // ordenados alfabéticamente
                        
                            $result = $conex -> query("SELECT cod, nombre_corto FROM producto");  
                            while ($fila = $result -> fetch_object()) { // Si es null lo tomará como falso y parará
                                        
                                // Marcar como seleccionado el producto que el usuario ha escogido
                                $selected = ($fila->cod == $selectedItem) ? 'selected' : '';                                
                                echo "<option value='$fila->cod' $selected>$fila->nombre_corto</option>";

                        ?>
                        
                        <!--<option value="<?php echo $fila -> cod ?>"><?php echo $fila -> nombre_corto ?></option>-->
                        
                        <?php 
                        
                            } 

                        } catch (Exception $ex) {
                            
                            die($ex -> getMessage());
                        
                        }
                        
                        ?>
                    </select>

                    <input type="submit" name="show" value="Mostrar Stock">
                    
                </p>
                            
            </form>
            
        </div>
        
        <?php
        
            if (isset($_POST['show'])) {
                
                ?>
        
        <div id="contenido">
            
            <h1>Stock del producto en las tiendas</h1>
            
            <?php
            
            $stock = $conex->query("select tienda, unidades from stock where producto ='$_POST[product]'");
            
            echo "<form action='' method='post'>";
            
            while($row = $stock->fetch_object()) {
                
                $tienda_result = $conex->query("select nombre from tienda where cod = '$row->tienda'");
                
                if ($tienda = $tienda_result->fetch_object()) {
                    
                    // IMPORTANTE poner como name algo[] para tomarlo como un checkbox
                    echo "<p>Tienda $tienda->nombre : <input type='text' name='unidades[$row->tienda]' value='$row->unidades'> unidades</p>";
                    
                }
                
            }
            
            echo "<input type='submit' name='update' value='Actualizar'>";
            
            echo "<input type='hidden' name='producto' value='$_POST[product]'>";
            
            // Podemos hacerlo mediante 2 arrays o poniendo como índice del array unidades, el código de la tienda
//            echo "<input type='hidden' name='tienda[]' value='$row->tienda'";
            
            echo "</form>";
            
            ?>
            
        </div>
        
            <?php
            
            }
            
            if (isset($_POST['update'])) {
                
                try {
                    
                    $stmt = $conex ->prepare("UPDATE stock set unidades = ? where producto = ? and tienda = ?");
                
                    $producto = $_POST['producto']; // Guardamos el código del producto en una variable
                    
                    // Recorremos cada iteración
                    
                    foreach ($_POST['unidades'] as $tienda => $unidades) {
                        
                        $stmt ->bind_param("isi", $unidades, $producto, $tienda);

                        $stmt ->execute();
                        
                    }
                    
                    echo "Stock actualizado correctamente";
                    
                } catch (Exception $exc) {
                    
                    echo "No se pudo actualizar el stock";
                    
                }
                   
            }
        
        ?>
        
    </body>
</html>
