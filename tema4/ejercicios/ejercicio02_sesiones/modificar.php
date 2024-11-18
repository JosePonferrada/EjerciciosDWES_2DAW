<html>
    <head>
        <title>Modificar</title>
    </head>
    <body>
        
        <a href="index.php"><input type="button" name="salir" value="Salir"></a>
        
        <?php
            // Propagating
            session_start();

            echo "Hola ".$_SESSION['user']->Nombre." ".$_SESSION['user']->Apellidos;

        ?>
        
        <form action="" method="post">
            
            <p>Nombre:<input type="text" name="name" value="<?php echo $_SESSION['user']->Nombre ?>" readonly=""></p>
            <!--<p><span class="error"><?php echo $name_error; ?></span></p>-->
            
            <p>Apellidos:<input type="text" name="surname" value="<?php echo $_SESSION['user']->Apellidos ?>" readonly=""></p>
            <!--<p><span class="error"><?php echo $surname_error; ?></span></p>-->
            
            <p>Dirección:<input type="text" name="location" value="<?php echo $_SESSION['user']->Direccion ?>"></p>
            <!--<p><span class="error"><?php echo $location_error; ?></span></p>-->
            
            <p>Localidad:<input type="text" name="town" value="<?php echo $_SESSION['user']->Localidad ?>"></p>
            <!--<p><span class="error"><?php echo $town_error; ?></span></p>-->
            
            <p>Usuario:<input type="text" name="user" value="<?php echo $_SESSION['user']->usuario ?>" readonly=""></p>
            <!--<p><span class="error"><?php echo $user_error; ?></span></p>-->
            
<!--        <p>Clave:<input type="text" name="pass"></p>
            <p>Repetir clave:<input type="text" name="pass2" readonly=""></p>
            <p><span class="error"><?php echo $pass_error; ?></span></p>-->
            
            <p>Color de letra:
                <input type="text" value="<?php echo $_SESSION['user']->colorLetra ?>"
            </p>
            <p>Color de fondo:
                <input type="text" value="<?php echo $_SESSION['user']->colorFondo ?>"
            </p>
            <p>Tipo de letra:
                <input type="text" value="<?php echo $_SESSION['user']->tipoLetra ?>"
            </p>
            <p>Tamaño de letra:
                <input type="text" value="<?php echo $_SESSION['user']->sizeLetra ?>"
            </p>
            
            <br><br>
            <a href="inicio.php"><input type="button" value="Volver"></a>
            <input type="submit" name="modify" value="Modificar">
            
            <!--<p><span class="error"><?php echo $general_message; ?></span></p>-->
            
        </form>
        
    </body>
</html>
