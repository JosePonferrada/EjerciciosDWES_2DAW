<!doctype html>

<html>
    <head>
        <title>Ejercicio 01 - Forms</title>
    </head>
    <body>
        
        <?php
        
        $banNom = 0; $banApell = 0; $banSex = 0; $banEdad = 0; $banEstado = 0; $banMain = 0;
        
        //IF para banderas
            if(isset($_POST['enviar']))  {
                
                if (!empty($_POST['nombre'])) $banNom = 1;
                
                if (!empty($_POST['apell'])) $banApell = 1;
                
                if (!empty($_POST['edad']) && ($_POST['edad'] >= 18)) $banEdad = 1;
                
                
                
            }
        
        ?>
        
        
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            
            Nombre: <input type="text" name="nombre">
                <?php if (empty($_POST['nombre'])) echo "<h5 style= color:red>El nombre no puede estar vacío</h5>" ?>
            <br><br>
            
            Apellidos: <input type="text" name="apell">
                <?php if (empty($_POST['apell'])) echo "<h5 style= color:red>El apellido no puede estar vacío</h5>" ?>
            <br><br>
            
            Sexo: <input type="radio" name="sexo" value="Hombre"><span>Hombre</span>
            <input type="radio" name="sexo" value="Mujer"><span>Mujer</span>
                
                <br><br>
            
            Edad: <input type="text" name="edad">
            <br><br>
            
            Estado civil: 
            <select name="estado">
                <option value="selecciona">Selecciona uno</option>
                <option value="Soltero">Soltero</option>
                <option value="Casado">Casado</option>
                <option value="Divorciado">Divorciado</option>
                <option value="Pareja de hecho">Pareja de hecho</option>
            </select><br>
            <br>
            
            <!-- Si se va a almacenar más de un valor el name SIEMPRE será un array -->
            Aficiones: 
            <input type="checkbox" name="aficion[]" value="Cine">
            <label for="aficion1">Cine</label>

            <input type="checkbox" name="aficion[]" value="Lectura">
            <label for="aficion2">Lectura</label>

            <input type="checkbox" name="aficion[]" value="TV">
            <label for="aficion3">TV</label>

            <input type="checkbox" name="aficion[]" value="Deporte">
            <label for="aficion4">Deporte</label>

            <input type="checkbox" name="aficion[]" value="Música">
            <label for="aficion5">Música</label>
            <br><br>
            
            Estudios: 
            <select name="estudios[]" multiple>
                <option value="ESO">ESO</option>
                <option value="Bachillerato">Bachillerato</option>
                <option value="CFGM">CFGM</option>
                <option value="CFGS">CFGS</option>
                <option value="Universidad">Universidad</option>
            </select>
            <br><br>
            
            <input type="submit" name="enviar" value="Enviar">
            
        </form>

        <?php
        
            if(isset($_POST['enviar'])) {
                
                echo $_POST['nombre']." ".$_POST['apell']."<br>";
                
                echo "Sexo: ".$_POST['sexo']."<br>";
                
                echo "Edad: ".$_POST['edad']."<br>";
                
                echo "Estado civil: ".$_POST['estado']."<br>";
                
                echo "Aficiones: ";
                foreach ($_POST["aficion"] as $value) {
                    echo $value." ";
                }
                echo "<br>";
                
                echo "Estudios: ";
                foreach ($_POST["estudios"] as $value) {
                    echo $value." ";
                }
                echo "<br>";
                
                echo "<br><a href='ejercicioDatosPersonales.php'>Introducir otro</a>";
                
            }
        
        ?>

    </body>
</html>
