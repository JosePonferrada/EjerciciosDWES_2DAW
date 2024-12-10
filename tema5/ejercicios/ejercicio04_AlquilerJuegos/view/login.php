<?php

    if (isset($_POST['login'])) {
        
        try {
            
            $conex = new mysqli("localhost", "dwes", "abc123.", "alquiler_juegos");
            
            $pass = md5($_POST['pass']);
            $result = $conex->query("select * from cliente where DNI= '$_POST[DNI]' and clave = '$pass'");
            
            if ($result->num_rows) {
                
                $fila = $result->fetchObject();
                
                session_start(); // Starting the session
                $_SESSION['usuario'] = $fila; // Saving the whole object
                header("Location:index.php"); // Redirecting
                
            } else {
                echo 'Login incorrecto';
            }
            
        } catch (Exception $ex) {

            die($ex->getMessage());
            
        }
        
    }

?>

<form action="" method="post">
    
    <p>Usuario: <input type="text" name="DNI"></p>
    <p>Clave: <input type="text" name="pass"></p>
    
    <input type="submit" name="login" value="Login">
    <a href="registro.php"><input type="button" value="Registro"></a>
</form>