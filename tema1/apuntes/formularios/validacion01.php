<!doctype html>

<html>
    <head>
        <title>Ejemplo 01 - Forms</title>
    </head>
    <body>
        
        <?php

        if (isset($_POST['enviar'])) { // Si se pulsa el formulario: 

            echo "<br>";
            
            if (!empty($_POST['nombre']) && !empty($_POST['apell']) && isset($_POST['modulos'])){
                echo $_POST['nombre']." ".$_POST['apell'];
                
                echo "<br>";

                foreach ($_POST["modulos"] as $value) {
                    echo "<p>".$value."</p>";
                }

                echo "<br><a href='ejemplo01.php'>Introducir otro</a>";
                
            } else {
                ?>
                
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">


                    Nombre: <input type="text" name="nombre"><br>
                    
                    <!-- Comprobamos si el campo está vacío -->
                    <?php if (empty($_POST['nombre'])) 
                        echo "<h5 style= color:red>El nombre no puede estar vacío</h5>" ?>
                    
                    Apellido: <input type="text" name="apell"><br>    
                    <?php if (empty($_POST['apell'])) 
                        echo "<h5 style= color:red>El apellido no puede estar vacío</h5>" ?>
                    
                    <?php if (empty($_POST['modulos'])) 
                        echo "<h5 style= color:red>Debe seleccionar algún modulo</h5>" ?>
                    <input type="checkbox" name="modulos[]" value="DWES">Desarrollo Web de Entorno Servidor<br>
                    <input type="checkbox" name="modulos[]" value="DWEC">Desarrollo Web de Entorno Cliente<br>
                    <input type="checkbox" name="modulos[]" value="DIW">Desarrollo de Interfaces Web<br>

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

