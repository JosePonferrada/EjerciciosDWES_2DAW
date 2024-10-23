<html>
    <head>
        <title>Ejemplo Campos Multivaluados</title>
    </head>
    <body>
        
        <form action="" method="post">
            
            DNI: <input type="text" name="dni"><br>
            Nombre: <input type="text" name="nombre"><br>
            Apellidos: <input type="text" name="apell"><br>
            Salario: <input type="text" name="salario"><br>
            Usuario: <input type="text" name="user"><br>
            Password: <input type="password" name="pass"><br>
            Idiomas: <br>
            <input type="checkbox" name="idiomas[]" value="1">Español<br>
            <input type="checkbox" name="idiomas[]" value="2">Inglés<br>
            <input type="checkbox" name="idiomas[]" value="4">Francés<br>
            <input type="checkbox" name="idiomas[]" value="8">Alemán<br>
            <input type="checkbox" name="idiomas[]" value="16">Chino<br>
            
            Estudios: 
            <select name="estudios[]" multiple="">
            
                <option value="ESO">ESO</option>
                <option value="Bachillerato">Bachillerato</option>
                <option value="CFGM">CFGM</option>
                <option value="CFGS">CFGS</option>
                
            </select><br>
            
            <input type="submit" name="guardar" value="Guardar">
            <input type="submit" name="recuperar" value="Recuperar">
            
        </form>
        
        <?php
        
        if (isset($_POST['guardar'])) {
            
            try {
                
                $idioma = 0;
                $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
                $conex->set_charset("utf8mb4");
                
                // Recorremos el array antes del insert para insertar lo seleccionado
                // IMPORTANTE inicializar la variable antes porque null + algo dará un error
                
                foreach ($_POST['idiomas'] as $value) {
                    
                    $idioma += $value;
                }
                
                $arrayEstudios = implode("-", $_POST['estudios']);
                
                $conex->query("INSERT INTO marketing values ('$_POST[dni]', '$_POST[nombre]', '$_POST[apell]', "
                        . "'$_POST[salario]', '$_POST[user]', '$_POST[pass]', $idioma, '$arrayEstudios')");
                
            } catch (Exception $exc) {
                die($exc->getMessage());
            }
            
            echo "<br>Registro insertado correctamente<br>";
            $conex -> close();
        }
        
        // ======================================================================
        
        if (isset($_POST['recuperar'])) {
            
            try {
                
                $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
                $conex->set_charset("utf8mb4");
                
                $result = $conex->query("SELECT * FROM marketing");
                
            } catch (Exception $exc) {
                die($exc->getMessage());
            }

            if ($result->num_rows) {
                
                while ($fila = $result->fetch_object()) {
                    
                    echo "Nombre: ".$fila->Nombre."<br>";
                    echo "Apellidos: ".$fila->Apellidos."<br>";
                    echo "Idiomas: ".$fila->idiomas."<br>";
                    echo "Estudios: ".$fila->estudios."<br>";
                    echo "<br> ======================== <br>";
                    
                }
                
            } else {
                
                echo "<br> No hay registros en la BBDD";
                
            }
            
        }
        
        ?>
        
    </body>
</html>
