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
        
        <div>
            
            <h1>Selecciona el producto</h1>
            
            <form action="" method="post">
                
                <p>
                
                    Producto: 
                    <select id="product" name="product">
                        <?php
                            
                            $result = $conex -> query("SELECT nombre_corto FROM producto");
                            while ($fila = $result -> fetch_object()) { // Si es null lo tomará como falso y parará
                        ?>
                        <option value="value"><?php echo $fila -> nombre_corto ?></option>
                        
                        <?php
                        
                            }
                        
                        ?>
                    </select>

                
                </p>
                            
            </form>
            
        </div>
        
    </body>
</html>
