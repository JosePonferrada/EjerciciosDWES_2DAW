<html>
    <head>
        <title>Inyección SQL</title>
    </head>
    <body>
        
        <form action="" method="post">
            
            Usuario: <input type="text" name="user"><br>
            Contraseña: <input type="text" name="pass"><br> 
            <input type="submit" name="send" value="Enviar"><br>
            <input type="submit" name="send2" value="Enviar"><br>
            
        </form>
           
        <?php // Login with query => Allows injection
        
            if (isset($_POST['send'])) {
                
                try {
                    
                    $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
                
                    $conex->set_charset("utf8mb4");
                    
                    $result = $conex ->query("SELECT * FROM marketing where usuario = BINARY '$_POST[user]' "
                            . "and password = BINARY '$_POST[pass]'");
                    // Si agregamos BINARY, la consulta la hará siendo caseSensitive porque compara en binario
                    
                } catch (Exception $exc) {
                    
                    die($exc->getMessage());
                    
                }
                    
                if ($result->num_rows) {
                    
                    echo "Credenciales correctas<br>";
                    
                    $fila = $result ->fetch_object();
                    
                    echo "Nombre: ".$fila->Nombre." - Apellidos: ".$fila->Apellidos."<br>";
                    echo "Usuario: ".$fila->usuario." - Contraseña: ".$fila->password."<br>";
                    
                } else {
                    
                    echo "Credenciales incorrectas<br>";
                    
                }
                
            }
        
        ?>
        
        <?php // Login with prepare statement
        
        // En este ejemplo no se puede obtener ningún registro mediante inyección SQL (loquesea' OR '1'='1)
        
            if (isset($_POST['send2'])) {
                
                try {
                    
                    $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
                
                    $conex->set_charset("utf8mb4");
                    
                    $stmt = $conex ->prepare("SELECT * FROM marketing where usuario = ? "
                            . "and password = ?");
                    // Si agregamos BINARY, la consulta la hará siendo caseSensitive porque compara en binario
                    
                } catch (Exception $exc) {
                    
                    die($exc->getMessage());
                    
                }
                
                $stmt ->bind_param("ss", $_POST['user'], $_POST['pass']);
                    
                if ($stmt->execute()) {
                    
                    $result = $stmt ->get_result();

                    if ($result->num_rows) {

                        echo "Credenciales correctas<br>";

                        $fila = $result ->fetch_object();

                        echo "Nombre: ".$fila->Nombre." - Apellidos: ".$fila->Apellidos."<br>";
                        echo "Usuario: ".$fila->usuario." - Contraseña: ".$fila->password."<br>";

                    } else {
                    
                        echo "Credenciales incorrectas<br>";
                    
                    }
                    
                }
                
            }
        
        ?>
        
    </body>
</html>

