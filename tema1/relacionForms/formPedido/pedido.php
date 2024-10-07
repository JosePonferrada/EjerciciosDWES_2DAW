<!doctype html>

<html>
    <head>
        <title>Pedido</title>
    </head>
    <body>
        
        <h1>Pedido</h1>

        <form action="confirma.php" method="post">
        
            Dirección: <input type="text" name="direc" value="<?php if (isset($_POST['cancelar'])) echo $_POST['direc']; ?>"><br>
            <br>
            
            Nº de tarjeta: <input type="text" name="tarj" value="<?php if (isset($_POST['cancelar'])) echo $_POST['tarj']; ?>"><br>
            <br>
            
            <input type="submit" name="siguiente" value="Siguiente">    
            
            
            <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
            
            <input type="hidden" name="apell" value="<?php echo $_POST['apell']; ?>">
            
        </form>
        
    </body>
</html>
