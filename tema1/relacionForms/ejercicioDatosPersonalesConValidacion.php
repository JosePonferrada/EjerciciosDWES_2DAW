<!doctype html>

<html>
    <head>
        <title>Datos personales con validación</title>
    </head>
    <body>
                
        <?php
        
        if (!isset($_POST['siguiente']) && !isset($_POST['siguiente2'])) {
                
        ?>
        
        <h3>Primera ventana</h3>
        
        <form action="" method="post">
            
            <p>Nombre: <input type="text" name="name">
            <?php if (empty($_POST['name'])) echo "<h5 style= color:red>El nombre no puede estar vacío</h5>" ?></p>
            
            <p>Apellidos: <input type="text" name="surname">
            <?php if (empty($_POST['surname'])) echo "<h5 style= color:red>El apellido no puede estar vacío</h5>" ?></p>
            
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
            
            <input type="submit" name="siguiente" value="Siguiente">
            
        </form>
        
        <?php
        
            }
        
        if (isset($_POST['siguiente'])) {
            
            ?>
        
        <h3>Segunda ventana</h3>
     
        <form action="" method="post">
            
            Sexo: <input type="radio" name="sexo" value="Hombre"><span>Hombre</span>
            <input type="radio" name="sexo" value="Mujer"><span>Mujer</span>
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
            
            Edad: <input type="text" name="edad">
            <br><br>
            
            <input type="submit" name="siguiente2" value="Siguiente">
            
            <!-- Campos ocultos -->
            
            <input type="hidden" name="name" value="<?php if (isset($_POST['siguiente'])) echo $_POST['name']; ?>">
            <input type="hidden" name="surname" value="<?php if (isset($_POST['siguiente'])) echo $_POST['surname']; ?>">
            
            <input type="hidden" name="aficion" value="<?php if (isset($_POST['siguiente'])) echo implode(", ", $_POST['aficion']); ?>">
            
        </form>
        
        
        <?php
            
        }
        
        if (isset($_POST['siguiente2'])) {
        
            echo "<h3>Datos</h3>";
            
            echo $_POST['name']." ".$_POST['surname']."<br>";
                
            echo "Sexo: ".$_POST['sexo']."<br>";

            echo "Edad: ".$_POST['edad']."<br>";

            echo "Estado civil: ".$_POST['estado']."<br>";

            echo "Aficiones: ".$_POST['aficion'];
            echo "<br>";

            echo "Estudios: ";
            foreach ($_POST["estudios"] as $value) {
                echo $value." ";
            }
            echo "<br>";

            echo "<br><a href='ejercicioDatosPersonalesConValidacion.php'>Introducir otro</a>";

        }
        
        
        
        ?>
        
    </body>
    
</html>