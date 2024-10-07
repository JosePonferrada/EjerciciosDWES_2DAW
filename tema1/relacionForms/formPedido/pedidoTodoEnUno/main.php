<!doctype html>

<html>
    <head>
        <title>Form Pedido Todo en uno</title>
    </head>
    <body>
        
        <?php
        
            if (!isset($_POST['siguiente']) && !isset($_POST['siguiente2'])) {
                
                ?>
        
        <form action="" method="post">
            
            Nombre: <input type="text" name="nombre" value="<?php if (isset($_POST['cancelar'])) echo $_POST['nombre']; ?>"><br>
            <br>
            
            Apellido: <input type="text" name="apell" value="<?php if (isset($_POST['cancelar'])) echo $_POST['apell']; ?>"><br>
            <br>
            
            <input type="submit" name="siguiente" value="Siguiente">   
            
            <input type="hidden" name="cancelar" value="<?php if (isset($_POST['cancelar'])) echo $_POST['cancelar']; ?>">
            
            <input type="hidden" name="direc" value="<?php if (isset($_POST['cancelar'])) echo $_POST['direc']; ?>">

            <input type="hidden" name="tarj" value="<?php if (isset($_POST['cancelar'])) echo $_POST['tarj']; ?>">            
            
            
        </form>
        
        <?php
        
            }
        
            if (isset($_POST['siguiente'])) {
                
                ?>
        
        <form action="" method="post">
            
            Dirección: <input type="text" name="direc" value="<?php if (isset($_POST['cancelar'])) echo $_POST['direc']; ?>"><br>
            <br>
            
            Nº de tarjeta: <input type="text" name="tarj" value="<?php if (isset($_POST['cancelar'])) echo $_POST['tarj']; ?>"><br>
            <br>
            
            <input type="submit" name="siguiente2" value="Siguiente">
            
            <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
            
            <input type="hidden" name="apell" value="<?php echo $_POST['apell']; ?>">
            
        </form>
             
        <?php
        
            }
            
            if (isset($_POST['siguiente2'])) {
                
                echo "Nombre: ".$_POST['nombre']."<br>";
                echo "Apellido: ".$_POST['apell']."<br>";

                echo "Dirección: ".$_POST['direc']."<br>";
                echo "Nº de tarjeta: ".$_POST['tarj']."<br>";

                ?>
        
                <form action="" method="post">

                    <input type="submit" name="cancelar" value="Cancelar">

                    <input type="submit" name="confirmar" value="Confirmar">
                    
                    <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
            
                    <input type="hidden" name="apell" value="<?php echo $_POST['apell']; ?>">

                    <input type="hidden" name="direc" value="<?php echo $_POST['direc']; ?>">

                    <input type="hidden" name="tarj" value="<?php echo $_POST['tarj']; ?>">

                </form>
                <?php
                
            }
            
            ?>
        
    </body>
</html>
