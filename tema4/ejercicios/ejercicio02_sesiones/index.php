<html>
    <head>
        <title>Index</title>
    </head>
    <body>
        
        <?php
        
        if (isset($_POST['login'])) {
            
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            
            try {
                
                $conex = new PDO('mysql:host=localhost;dbname=sesiones;charset=utf8mb4;','dwes','abc123.');

                $result = $conex->query("select * from datos where usuario = '$user'");

                if ($result->rowCount()) {

                    $fila = $result->fetchObject();

                    if (password_verify($pass, $fila->clave)) {
                        
                        // Creating the session and storing the whole object on $_SESSION['user']
                        session_start();
                        $_SESSION['user'] = $fila;
                        header("Location:inicio.php");
                    } else {
                        echo "Login incorrecto";
                    }
                
                } else {
                    echo "Usuario o clave incorrecta";
                }
            } catch (PDOException $ex) {
                die("ERROR. No se pudo establecer la conexión con la BBDD");
            }
                    
            
        }
        
        ?>
        
        <h1>Login</h1>
        
        <form action="" method="post">
            
            <p>Usuario: <input type="text" name="user"></p>
            <p>Clave: <input type="text" name="pass"></p>
            
            <a href="registro.php"><input type="button" value="Registro"></a>
            <input type="submit" name="login" value="Entrar">
            
        </form>
        
    </body>
</html>
