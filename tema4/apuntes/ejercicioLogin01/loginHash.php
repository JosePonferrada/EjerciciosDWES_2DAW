<html>
    <head>
        <title>Login Hash</title>
    </head>
    <body>

        <form action="" method="post">
            
            <h1>Introduzca las credenciales</h1>
            
            <p>Usuario: <input type="text" name="user"></p>
            <p>Clave: <input type="text" name="pass"></p>

            <input type="submit" name="access" value="Acceder">

        </form>
        
        <?php
        
        if (isset($_POST['access'])) {
            
            try {
                $conex = new PDO('mysql:host=localhost;dbname=encriptacion;charset=utf8mb4;','dwes','abc123.');

                $result = $conex->query("select * from usuarios where usuario = '$_POST[user]'");

                if ($result->rowCount()) {
                    
                    $fila = $result->fetchObject();
                    
                    if (password_verify($_POST['pass'], $fila->clave)) {
                        
                        header("Location:datos.php");

                    } else {
                        echo "Contraseña incorrecta";
                    }

                } else {
                    echo "Usuario o contraseña incorrectos";
                }
                
            } catch (PDOException $exc) {
                die("No se pudo conectar con la BBDD");
            }
            
        }
        
        ?>
        
    </body>
</html>
