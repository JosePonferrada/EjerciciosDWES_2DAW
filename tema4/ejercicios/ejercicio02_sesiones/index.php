<html>
    <head>
        <title>Index</title>
    </head>
    <body>
        
        <?php
        
        $general_error = "";
        
        // Creating the cookie that control the trys
        if (!isset($_COOKIE['intentos'])) setcookie("intentos", 3);
        
        // Blocking the access to index if we are blocked
        if ($_COOKIE['intentos'] <= 0) {
            header("Location:intentos.php");
        }
        
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
                        setcookie('intentos', "", time() - 3600); // Deleting the cookie with the trys
                        header("Location:inicio.php");                        
                    } else {
                        $error = 1;
                        echo "Login incorrecto";
                    }
                
                } else {
                    $error = 1;
                    echo "Usuario o clave incorrecta";
                }
                
                if ($error == 1) {
                    $actualTrys = $_COOKIE['intentos'] - 1;
                    setcookie ("intentos", $actualTrys);
                    $general_error = "Te quedan ".$actualTrys." intentos";
                    
                    if ($actualTrys <= 0) {
                        header("Location:intentos.php");
                    }
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
            
            <p><span class="error"><?php echo $general_error; ?></span></p>
            
        </form>
        
    </body>
</html>
