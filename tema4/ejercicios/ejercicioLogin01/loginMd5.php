<html>
    <head>
        <title>Login MD5</title>
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


                $claveEncript = md5($_POST['pass']);

                $result = $conex->query("select * from usuarios where usuario = '$_POST[user]' and clave = '$claveEncript'");

                if ($result->rowCount()) {

                    header("Location:datos.php");

                } else {
                    echo "Usuario o clave incorrectos";
                }
                
            } catch (PDOException $exc) {
                die("No se pudo conectar con la BBDD");
            }
            
        }
        
        ?>
        
    </body>
</html>
