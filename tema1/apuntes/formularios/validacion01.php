<!doctype html>

<html>
    <head>
        <title>Ejemplo 01 - Forms</title>
    </head>
    <body>
        
        <?php

        if (isset($_POST['enviar'])) { // Si se pulsa el formulario: 

            echo "<br>";
            
            if (($_POST['nombre']=='Pepe') && !empty($_POST['apell']) && isset($_POST['modulos'])){
                echo $_POST['nombre']." ".$_POST['apell'];
                
                echo "<br>";

                foreach ($_POST["modulos"] as $value) {
                    echo "<p>".$value."</p>";
                }

                echo "<br><a href='validacion01.php'>Introducir otro</a>";
                
            } else {
                ?>
                
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

                    <!-- Añadimos el value para que mantenga el texto en el input -->
                    Nombre: <input type="text" name="nombre" value="<?php 
                        if ($_POST['nombre'] == "Pepe") echo $_POST['nombre']; ?>"><br>
                    <!-- Si el nombre es Pepe, lo mostramos pese a que haya errores en otros lados, 
                        en caso de que el nombre no sea Pepe el campo se volverá a mostrar vacío y con 
                        el mensaje de error -->
                    
                    
                    <!-- Comprobamos si el campo está vacío -->
                    <?php if (empty($_POST['nombre'])) 
                        echo "<h5 style= color:red>El nombre no puede estar vacío</h5>" ?>
                    
                    Apellido: <input type="text" name="apell" value="<?php 
                        if(!empty($_POST['apell'])) echo $_POST['apell']; ?>"><br>   
                    
                    <?php if (empty($_POST['apell'])) 
                        echo "<h5 style= color:red>El apellido no puede estar vacío</h5>" ?>
                    
                    <?php if (empty($_POST['modulos'])) 
                        echo "<h5 style= color:red>Debe seleccionar algún modulo</h5>" ?>
                    
                    <input type="checkbox" name="modulos[]" value="DWES" 
                        <?php if(isset($_POST['modulos']) && in_array("DWES", $_POST['modulos'])) echo 'checked'; ?>>Desarrollo Web de Entorno Servidor<br>
                    <input type="checkbox" name="modulos[]" value="DWEC" 
                        <?php if(isset($_POST['modulos']) && in_array("DWEC", $_POST['modulos'])) echo 'checked'; ?>>Desarrollo Web de Entorno Cliente<br>
                    <input type="checkbox" name="modulos[]" value="DIW" 
                        <?php if(isset($_POST['modulos']) && in_array("DIW", $_POST['modulos'])) echo 'checked'; ?>>Desarrollo de Interfaces Web<br>

                    <input type="submit" name="enviar" value="Enviar">

                </form>
                
            <?php
        
            }
            
        } else {
        
        ?>
            
       
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        
            Nombre: <input type="text" name="nombre"><br>
            Apellido: <input type="text" name="apell"><br>    
            
            <input type="checkbox" name="modulos[]" value="DWES">Desarrollo Web de Entorno Servidor<br>
            <input type="checkbox" name="modulos[]" value="DWEC">Desarrollo Web de Entorno Cliente<br>
            <input type="checkbox" name="modulos[]" value="DIW">Desarrollo de Interfaces Web<br>
            
            <input type="submit" name="enviar" value="Enviar">
            
        </form>
        
        <a href="procesa.php?nombre=Pepe&apell=Sanchez">Ir a procesa</a>
                
        <?php
        
        }

        ?>
        
    </body>
</html>

