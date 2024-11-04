<html>
    <head>
        <title>Modifica/Borra un viaje</title>
    </head>
    <style>
        table, th, td {
            border-collapse: collapse;
            border: 1px solid black;
        }
        
        th, td {
            padding: 5px;
            text-align: center;
        }
        
    </style>
    
    <body>

        <?php
        // Import the file with functions
        require_once './funciones.php';
        
        // Connecting to the db
        $conex = getConex('autobuses');
        
        $date_flag = false; $origin_flag = false; $dest_flag = false; $seats_flag = false; $plate_flag = false;
        
        $general_flag = false;
        
        ?>
        
        <h1>Modifica/Borra un viaje</h1>
        
        <?php
        
        try {
            
            $result = $conex->query("select Fecha, Matricula, Origen, Destino, Num_plazas, Plazas_libres from viajes join autos using (Matricula)");
            
            if ($result->rowCount()) {
                
                ?>
        
        <table>
            
            <tr>
                <th>Fecha</th><th>Matrícula</th><th>Origen</th><th>Destino</th><th>Plazas</th><th>Plazas libres</th><th>Acción</th>
            </tr>
            
            <?php
            
                while ($fila = $result->fetchObject()){

                    echo "<tr>";

                    echo "<td>$fila->Fecha</td><td>$fila->Matricula</td><td>$fila->Origen</td><td>$fila->Destino</td><td>$fila->Num_plazas</td><td>$fila->Plazas_libres</td>";
                    echo "<td><form action='' method='post'>";
                    echo "<input type='submit' name='mod' value='Modificar'> ";
                    echo "<input type='submit' name='delete' value='Borrar'>";
                    // Keeping the data for future querys.
                    echo "<input type='hidden' name='originalDate' value='$fila->Fecha'>";
                    echo "<input type='hidden' name='originalPlate' value='$fila->Matricula'>";
                    echo "<input type='hidden' name='originalOrigin' value='$fila->Origen'>";
                    echo "<input type='hidden' name='originalDest' value='$fila->Destino'>";
                    echo "<input type='hidden' name='originalFreeSeats' value='$fila->Plazas_libres'>";
                    echo "<input type='hidden' name='originalTotalSeats' value='$fila->Num_plazas'>";
                    echo "</form></td>";
                    echo "</tr>";
                }
            
            ?>
            
        </table>
        <br><a href="index.php">Volver al Menú</a><br><br>
        
        <?php
        
            } else {
                echo "No existen registros en la BBDD";
            }
            
        } catch (PDOException $exc) {
            echo "ERROR: ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
        }
                
        
        if (isset($_POST['mod'])) {
            
            ?>
            
        <form action="" method="post">
            
            Fecha: <input type="date" name="newDate" value="<?php echo $_POST['originalDate']; ?>"><br>
            
            Matrícula: <select name="plate">
            <?php
                try {
                    
                    $result = $conex->query("SELECT * FROM autos");
                    
                    if ($result->rowCount()) {
                        while ($fila = $result->fetchObject()) {
                            echo "<option value='$fila->Matricula' ";
                            // Keeping the plate selected.
                            if (isset($_POST['mod']) && $_POST['originalPlate'] == $fila->Matricula) echo "selected";
                            else if ($plate_flag && $_POST['plate'] == $fila->Matricula) echo "selected";
                            echo ">$fila->Matricula</option>";
                        }
                    }
                } catch (PDOException $ex) {
                    echo "ERROR: ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
                }
            
            ?>
            
            </select><br>
            
            Origen: <input type="text" name="newOrigin" value="<?php echo $_POST['originalOrigin']; ?>"><br>
            Destino: <input type="text" name="newDest" value="<?php echo $_POST['originalDest']; ?>"><br>
            Plazas Libres: <input type="number" name="newFreeSeats" value="<?php echo $_POST['originalFreeSeats']; ?>"><br>

            <!-- Hiddens -->
                        
            <input type="hidden" name="originalDate" value="<?php echo $_POST['originalDate']; ?>">
            <input type="hidden" name="originalPlate" value="<?php echo $_POST['originalPlate']; ?>">
            <input type="hidden" name="originalOrigin" value="<?php echo $_POST['originalOrigin']; ?>">
            <input type="hidden" name="originalDest" value="<?php echo $_POST['originalDest']; ?>">
            <input type="hidden" name="originalFreeSeats" value="<?php echo $_POST['originalFreeSeats']; ?>">
            <input type="hidden" name="originalTotalSeats" value="<?php echo $_POST['originalTotalSeats']; ?>">
            
            <input type="submit" name="update" value="Guardar Cambios">
            
        </form>
            
                
            <?php
            
        }
            
        if (isset($_POST['update'])) {

            if (preg_match('#^\d{4}(-)\d{2}(-)\d{2}$#', $_POST['newDate'])) { // If we use the input type date we are getting the date with YYYY-MM-DD format
                                                                        // We can change the delimiters to avoid problems with "/"

                $array = explode("-", $_POST['newDate']);

                if (checkdate($array[1], $array[2], $array[0])) {

                    $date_flag = true;

                } else {

                    echo "Fecha no válida. Verifica que el día, mes y año sean correctos";

                }

            } else {

                echo "El formato debe ser dd/mm/yyyy<br>";

            }

            if (preg_match('/^([a-z]+\s?)+$/i', $_POST['newOrigin'])) {
                $origin_flag = true;
            } else {
                echo "El origen no puede estar vacío. Escribe solo letras.";
            }

            if (preg_match('/^([a-z]+\s?)+$/i', $_POST['newDest'])) {
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
                if (strcasecmp($_POST['newOrigin'], $_POST['newDest']) != 0) {
                    $dest_flag = true;
                } else {
                    echo "El destino no puede ser igual al origen";
                }
            } else {
                echo "El destino no puede estar en blanco ni puede incluir un caracter que no sea letras";
            }

            if ($_POST['newFreeSeats'] > 0 && $_POST['newFreeSeats'] <= $_POST['originalTotalSeats']) {
                $seats_flag = true;
            } else {
                echo "Las plazas disponibles debe ser un valor mayor que 0 y menor que las plazas que tiene el bus.";
            }

            if ($date_flag && $origin_flag && $dest_flag && $seats_flag) {

                $general_flag = true;

                try {

                    $res = $conex->exec("update viajes set Fecha = '$_POST[newDate]', Matricula = '$_POST[plate]', Origen = '$_POST[newOrigin]', Destino = '$_POST[newDest]', Plazas_libres = '$_POST[newFreeSeats]'"
                        . " where Fecha = '$_POST[originalDate]' and Matricula = '$_POST[originalPlate]' AND Origen='$_POST[originalOrigin]' AND Destino='$_POST[originalDest]'");

                    if ($res) {
                        echo "Viaje modificado";
                    } else if ($res === 0) {
                        echo "No se ha actualizado ningún dato";
                    } else {
                        echo "Ha ocurrido un error en la ejecución de la consulta";
                    }

                } catch (Exception $ex) {

                }

            }

        }
        
        if (isset($_POST['delete'])) {
            
            $res = $conex->exec("delete from viajes where Fecha = '$_POST[originalDate]' and Matricula = '$_POST[originalPlate]' and Origen = '$_POST[originalOrigin]' and Destino = '$_POST[originalDest]'");
            
            if ($res) {
                echo "Viaje borrado";
            } else if ($res === 0) {
                echo "No se ha borrado ningún dato";
            } else {
                echo "Ha ocurrido un error en la ejecución de la consulta";
            }
            
        }
        
        ?>
        
    </body>
</html>
