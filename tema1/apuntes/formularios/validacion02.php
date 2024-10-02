<!doctype html>

<html>
    <head>
        <title>Ejemplo 02 - Forms</title>
    </head>
    <body>
        
        <?php

        $banderaNombre = 0; // 0 ==> Con errores // 1 ==> Correcto
        $banderaApell = 0;
        $banderaCheck = 0;
        
        if (isset($_POST['enviar'])) { // Si se pulsa el formulario: 
            // Comprobamos si nombre = "Pepe", apell que no esté vacío y si hay al menos una opción marcada

            echo "<br>";
            
            
            if (($_POST['nombre']=='Pepe')) {
                $banderaNombre = 1;
                
            } 
            
            if (!empty($_POST['apell'])) {
                $banderaApell = 1;
                
            }
            
            if (!isset(($_POST['modulos']))) {
                $banderaCheck = 1;
                                
            }
            
            if ($banderaNombre == 1 && $banderaApell == 1 && $banderaCheck == 1){
                $banderaGeneral = 1;
            } else $banderaGeneral = 0;
            
        
        }
        
        if (isset($_POST['enviar']) && $banderaGeneral == 1) { // Enviado sin errores
            
            echo $_POST['nombre']." ".$_POST['apell'];

            foreach ($_POST["modulos"] as $value) {
                echo "<p>".$value."</p>";
            }

            echo "<br><a href='validacion02.php'>Introducir otro</a>";
            
        } else {
            
            ?>
        
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        
            Nombre: <input type="text" name="nombre" 
                           value="<?php if ($banderaNombre == 1) echo $_POST['nombre']; ?>"><br>
            <?php if (isset($_POST['enviar']) && $banderaNombre == 0) echo "<h5 style= color:red>El nombre tiene que ser Pepe</h5>" ?>
            
            
            Apellido: <input type="text" name="apell" 
                           value="<?php if ($banderaApell == 1) echo $_POST['apell']; ?>"><br>
            <?php if (isset($_POST['enviar']) && $banderaNombre == 0) echo "<h5 style= color:red>El apellido no puede estar vacío</h5>" ?>
                        
            Módulos: <br>
            <?php if ($banderaCheck == 1) echo $_POST['modulos']; ?>
            <input type="checkbox" name="modulos[]" value="DWES">Desarrollo Web de Entorno Servidor<br>
            <input type="checkbox" name="modulos[]" value="DWEC">Desarrollo Web de Entorno Cliente<br>
            <input type="checkbox" name="modulos[]" value="DIW">Desarrollo de Interfaces Web<br>
            
            <input type="submit" name="enviar" value="Enviar">
            
        </form>
        
        <?php
            
        }

        ?>
        
    </body>
</html>

