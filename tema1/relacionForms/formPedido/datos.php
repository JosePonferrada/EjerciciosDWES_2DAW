<!doctype html>

<html>
    <head>
        <title>Datos</title>
    </head>
    <body>
        
        <h1>Datos</h1>

        <form action="pedido.php" method="post">
        
            Nombre: <input type="text" name="nombre" value="<?php if (isset($_POST['cancelar'])) echo $_POST['nombre']; ?>"><br>
            <br>
            
            Apellido: <input type="text" name="apell" value="<?php if (isset($_POST['cancelar'])) echo $_POST['apell']; ?>"><br>
            <br>
            
            <input type="submit" name="siguiente" value="Siguiente">   
                       
            <?php 
            
                if (isset($_POST['cancelar'])) {
                    
                    ?>
            
                    <input type="hidden" name="direc" value="<?php echo $_POST['direc']; ?>">

                    <input type="hidden" name="tarj" value="<?php echo $_POST['tarj']; ?>">

                    <input type="hidden" name="cancelar" value="<?php echo $_POST['cancelar']; ?>">

            <?php
            
                }
                
                ?>
            
        </form>
        
    </body>
</html>
