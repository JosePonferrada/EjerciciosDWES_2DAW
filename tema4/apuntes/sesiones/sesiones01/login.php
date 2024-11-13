<?php

    if (isset($_POST['login'])) {
        
        try {
            
            $conex = new PDO('mysql:host=localhost;dbname=encriptacion;charset=utf8mb4;','dwes','abc123.');
            
            $pass = md5($_POST['pass']);
            $result = $conex->query("select * from usuarios where usuario = '$_POST[user]' and clave = '$pass'");
            
            if ($result->rowCount()) {
                
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
    
    <p>Usuario: <input type="text" name="user"></p>
    <p>Clave: <input type="text" name="pass"></p>
    
    <input type="submit" name="login" value="Login">
</form>