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
                        
                        <option value="<?php echo $fila -> cod ?>"><?php echo $fila -> nombre_corto ?></option>
                        
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
            
            while($row = $stock->fetch_object()) {
                
                $tienda_result = $conex->query("select nombre from tienda where cod = '$row->tienda'");
                
                if ($tienda = $tienda_result->fetch_object()) {
                    
                    echo "<p>Tienda $tienda->nombre : $row->unidades unidades</p>";
                    
                }
                
            }
            
            ?>
            
        </div>
        
        <?php
                
            }
        
        ?>
        
    </body>
</html>
