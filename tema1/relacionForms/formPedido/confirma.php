<!doctype html>

<html>
    <head>
        <title>Confirmación de datos</title>
    </head>
    <body>
        
        <h1>Confirmación de datos</h1>

        <?php 
        
            echo "Nombre: ".$_POST['nombre']."<br>";
            echo "Apellido: ".$_POST['apell']."<br>";
            
            echo "Dirección: ".$_POST['direc']."<br>";
            echo "Nº de tarjeta: ".$_POST['tarj']."<br>";
            
        ?>
        
        <form action="datos.php" method="post">
            
            <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
            
            <input type="hidden" name="apell" value="<?php echo $_POST['apell']; ?>">
            
            <input type="hidden" name="direc" value="<?php echo $_POST['direc']; ?>">
            
            <input type="hidden" name="tarj" value="<?php echo $_POST['tarj']; ?>">
        
            <input type="submit" name="cancelar" value="Cancelar">

            <input type="submit" name="confirmar" value="Confirmar">

        </form>
        
    </body>
</html>
