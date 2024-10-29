<html>
    <head>
        <title>Introducir</title>
    </head>
    <body>

        <h1>Introduce los datos del jugador</h1>
        
        <form action="" method="post">
            
            <p>DNI: <input type="text" name="dni"></p>
            <p>Nombre: <input type="text" name="name"></p>

            <p>Dorsal: 
                <select name="dorsal">
                    <?php
                        for ($index = 1; $index <= 11; $index++) {
                            echo "<option value='$index'>$index</option>";
                        }
                    ?>
                </select>
            </p>

            <p>Posición: 
                <select name="pos[]" multiple="">
                    <option value="Portero">Portero</option>
                    <option value="Defensa">Defensa</option>
                    <option value="Centrocampista">Centrocampista</option>
                    <option value="Delantero">Delantero</option>
                </select>
            </p>
            <p>Equipo: <input type="text" name="team"></p>
            <p>Goles: <input type="text" name="goal"></p>

            <a href="index.php"><input type="button" name="inicio" value="Ir a inicio"></a>
            <br><br>
            <input type="submit" name="send" value="Aceptar">
            <br>
        
        </form>
            
        <?php 
        
        $dni_flag = false; $name_flag = false; $pos_flag = false; $team_flag = false; $goal_flag = false;
        
        $general_flag = false;
        
            if (isset($_POST['send'])) {
                
                // We have to check the data is correct, then insert
                
                if (preg_match('/\d{8}[A-Z]/', $_POST['dni'])) {    
                    $dni_flag = true;
                } else {   
                    echo "El DNI debe tener 8 números y una letra mayúscula<br>";   
                }
                
                if (preg_match('/^[a-z]+\s?[a-z]+$/i', $_POST['name'])) {
                    $name_flag = true;
                } else {
                    echo "El nombre debe contener letras solamente<br>";
                }
                
                if (isset($_POST['pos'])) {
                    $pos_flag = true;
                } else {
                    echo "Seleccione alguna posición para el jugador introducido<br>";
                }
                
                // Este patrón permite varios espacios a diferencia del patrón del nombre que solo permite un espacio
                if (preg_match('/^([a-z]+\s?)+$/i', $_POST['team'])) { 
                    $team_flag = true;
                } else {
                    echo "El nombre del equipo debe tener  letras solamente y no puede comenzar con espacios en blanco<br>";
                }
                
                if (preg_match('/^\d{1,3}$/', $_POST['goal'])) {
                    $goal_flag = true;
                } else {
                    echo "Solo puedes introducir números en los goles<br>";
                }
                
                if ($dni_flag && $name_flag && $team_flag && $goal_flag && $pos_flag) {
                    $general_flag = true;
                }
                
                if ($general_flag == true) {
                    
                    try {
                        $conex = new mysqli("localhost", "dwes", "abc123.", "futbol");
                        $conex->set_charset("utf8mb4");
                        
                        // Insertamos los datos tras conectarnos
                        // Lo separamos siempre con coma y sin espacios, no ("-")
                        $cadenaDePos = implode(",", $_POST['pos']); 
                                                
                        $conex->query("INSERT INTO equipo values ('$_POST[name]', '$_POST[dni]', "
                                . "'$_POST[dorsal]', '$cadenaDePos', '$_POST[team]', '$_POST[goal]')");
                        
                    } catch (Exception $ex) {
                                                
                        if ($ex->getCode() == 1062) {
                            die("Ya existe un registro con ese DNI. Inserte otro distinto.<br>");
                        }
                        
                        die("Error al conectar<br>");
                        
                    }
                 
//                  echo "<br>Registro insertado correctamente<br>";
                    
                    // Usamos header() para redirigir al index y mostrar el mensaje allí
                    header("Location: index.php?mensaje=Registro insertado correctamente");
                    $conex->close();
                }
                
            }

        ?>
        
    </body>
</html>
