<html>
    <head>
        <title>Añadir Viaje</title>
    </head>
    <body>

        <?php
        // Import the file with functions
        require_once './funciones.php';
        
        // Connecting to the db
        $conex = getConex('autobuses');
        
        ?>
        
        <h1>Nuevo viaje</h1>
        
        <form action="" method="post">
            
            <p>Fecha: <input type="date" name="date"></p>
            <p>Matrícula: 
                <select name="plate">
                    
                    <?php
                    
                    try {
                        
//                      $conex = new PDO('mysql:host=localhost;dbname=autobuses;charset=utf8mb4;','dwes','abc123.');
                    
                        $result = $conex->query("select * from autos");

                        if ($result->rowCount()) {

                            while ($fila = $result->fetchObject()) {
                                echo "<option value='$fila->Matricula'>$fila->Matricula</option>";
                            }

                        }
                        
                    } catch (PDOException $exc) {
                        echo "ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
                    }
                    
                    ?>
                    
                </select>

            </p>
            
            <p>Origen: <input type="text" name="origin"></p>
            <p>Destino: <input type="text" name="dest"></p>
            <p>Plazas disponibles: <input type="text" name="seats"></p>
            
            
            <p><input type="submit" name="add" value="Añadir"></p>
            
        </form>
        
        <?php
        
        $date_flag = false; $origin_flag = false; $dest_flag = false; $seats_flag = false;
        
        $general_flag = false;
        
        if (isset($_POST['add'])) {
            
            if (preg_match('#^\d{4}(-)\d{2}(-)\d{2}$#', $_POST['date'])) { // If we use the input type date we are getting the date with YYYY-MM-DD format
                                                                            // We can change the delimiters to avoid problems with "/"
                
                $array = explode("-", $_POST['date']);
                
                if (checkdate($array[1], $array[2], $array[0])) {
                        
                    $date_flag = true;

                } else {

                    echo "Fecha no válida. Verifica que el día, mes y año sean correctos";

                }

            } else {

                echo "El formato debe ser dd/mm/yyyy<br>";

            }
         
            if (preg_match('/^([a-z]+\s?)+$/i', $_POST['origin'])) {
                $origin_flag = true;
            } else {
                echo "El origen no puede estar vacío. Escribe solo letras.";
            }
                
            if (preg_match('/^([a-z]+\s?)+$/i', $_POST['dest'])) {
                /**
                 * The function strcmp() is case-sensitive and returns:
                    0 - if the two strings are equal
                    <0 - if string1 is less than string2
                    >0 - if string1 is greater than string2
                 * 
                 * The strcasecmp() function compares two strings character-by-character and returns:
                 This function is not case-sensitive
                0: - if the strings match exactly;
                -1: - if string str1 is lexicographically less than str2;
                1: - if, on the contrary, str1 is "greater than" str2.

                 */
                if (strcasecmp($_POST['origin'], $_POST['dest']) != 0) {
                    $dest_flag = true;
                } else {
                    echo "El destino no puede ser igual al origen";
                }
            } else {
                echo "El destino no puede estar en blanco ni puede incluir un caracter que no sea letras";
            }
            
            try {
               
                // Now we have to check the seats the bus has and compare it with the availables ones.
                $reg = $conex->query("select * from autos where matricula = '$_POST[plate]'");
                // Saving the seats of the bus from the object
                if ($reg->rowCount()) {
                    $busSeats = ($reg->fetchObject())->Num_plazas;
                }  
                
            } catch (PDOException $ex) {
                echo "ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
            }
            
            if ($_POST['seats'] > 0 && $_POST['seats'] <= $busSeats) {
                $seats_flag = true;
            } else {
                echo "Las plazas disponibles debe ser un valor mayor que 0 y menor que las plazas que tiene el bus.";
            }
            
            if ($date_flag && $origin_flag && $dest_flag && $seats_flag) {
                $general_flag = true;
            }
            
            if ($general_flag == true) {
                
                try{
                    
                    $res = $conex->exec("insert into viajes values ('$_POST[date]', '$_POST[plate]', '$_POST[origin]', '$_POST[dest]', '$_POST[seats]')");
                    
                    if ($res) {
                        echo "Viaje insertado";
                    } else {
                        echo "Error en la consulta";
                    }
                    
                } catch (PDOException $ex) {
                    if ($ex->errorInfo[1] == 1062) die("Ya existe un viaje con esa fecha, matrícula, origen y destino");
                    else die("ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2]);
                }
                
            }
            
        }
        
        ?>
        
    </body>
</html>
