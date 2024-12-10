<?php

if (isset($_POST['register'])) {
    
    try {
        
        $conex = new mysqli("localhost", "dwes", "abc123.", "alquiler_juegos");
            
        $pass = md5($_POST['pass']);
        
        $conex->query("INSERT into cliente values ('$_POST[DNI]', '$_POST[nombre]', '$_POST[apell]', '$_POST[direc]', '$pass')");
        
        
        
        if ($result->num_rows) {
            
            
            
        }
        
    } catch (Exception $ex) {

    }
    
}

?>

<form action="" method="post">
    <p>DNI: <input type="text" name="DNI"></p>
    <p>Nombre: <input type="text" name="nombre"></p>
    <p>Apellidos: <input type="text" name="apell"></p>
    <p>Dirección: <input type="text" name="direc"></p>
    <p>Clave: <input type="text" name="pass"></p>
    
    <a href="login.php"><input type="button" value="Login"></a>
    <input type="submit" name="register" value="Registrar">
</form>