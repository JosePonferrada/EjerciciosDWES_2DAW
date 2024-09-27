<!doctype html>

<html>
    <head>
        <title>Ejercicio 02 - Arrays</title>
    </head>
    <body>

        <?php
        
            $persona = array("nombre" => "Juan", "edad" => 35, "ciudad" => "Madrid");
            
            echo "<p>Nombre: ".$persona["nombre"].", ciudad: ".$persona["ciudad"]."</p>";
            
            $persona["profesion"] = "Ingeniero";
            
            foreach ($persona as $key => $value) {
                echo "<p>Clave: ".$key." - Valor: ".$value."</p>";
                
            }
        
        ?>
        
    </body>
</html>
