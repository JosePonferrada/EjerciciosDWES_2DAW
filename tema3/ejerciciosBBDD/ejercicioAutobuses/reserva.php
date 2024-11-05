<html>
    <head>
        <title>Reserva viaje</title>
    </head>
    <body>

        <?php
        
        require_once './funciones.php';
        
        $conex = getConex('autobuses');
        
        $date_flag = false; $origin_flag = false; $dest_flag = false; $seats_flag = false;
        
        $general_flag = false;
        
//        if (isset($_POST['consult'])) {
//            
//            if (preg_match('#^\d{4}(-)\d{2}(-)\d{2}$#', $_POST['date'])) { // If we use the input type date we are getting the date with YYYY-MM-DD format
//                                                                            // We can change the delimiters to avoid problems with "/"
//                
//                $array = explode("-", $_POST['date']);
//                
//                if (checkdate($array[1], $array[2], $array[0])) {
//                        
//                    $date_flag = true;
//
//                } else {
//
//                    echo "Fecha no válida. Verifica que el día, mes y año sean correctos";
//
//                }
//
//            } else {
//
//                echo "El formato debe ser dd/mm/yyyy<br>";
//
//            }
//         
//            if (preg_match('/^([a-z]+\s?)+$/i', $_POST['origin'])) {
//                $origin_flag = true;
//            } else {
//                echo "El origen no puede estar vacío. Escribe solo letras.";
//            }
//                
//            if (preg_match('/^([a-z]+\s?)+$/i', $_POST['dest'])) {
//                /**
//                 * The function strcmp() is case-sensitive and returns:
//                    0 - if the two strings are equal
//                    <0 - if string1 is less than string2
//                    >0 - if string1 is greater than string2
//                 * 
//                 * The strcasecmp() function compares two strings character-by-character and returns:
//                 This function is not case-sensitive
//                0: - if the strings match exactly;
//                -1: - if string str1 is lexicographically less than str2;
//                1: - if, on the contrary, str1 is "greater than" str2.
//
//                 */
//                if (strcasecmp($_POST['origin'], $_POST['dest']) != 0) {
//                    $dest_flag = true;
//                } else {
//                    echo "El destino no puede ser igual al origen";
//                }
//            } else {
//                echo "El destino no puede estar en blanco ni puede incluir un caracter que no sea letras";
//            }
//            
//            if ($date_flag && $origin_flag && $dest_flag) {
//                $general_flag = true;
//            }
//            
//            
//        }
        
        ?>
        
        <h1>Reserva de viaje</h1>
        
        <form action="" method="post">
            
            <p>Fecha: <input type="date" name="date" value="<?php if ($date_flag) echo $_POST['date']; ?>"></p>
            <p>Origen: 
                <select name="origin">
                    
                    <?php
                    try {
                        
                        $result = $conex->query("SELECT Origen FROM viajes GROUP BY Origen");
                        
                        if ($result->rowCount()) {
                            while ($fila = $result->fetchObject()) {
                                echo "<option value='$fila->Origen' ";
                                // Keeping origin selected if we add it.
                                if ($origin_flag && ($_POST['origin'] == $fila->Origen)) echo "selected";
                                echo ">$fila->Origen</option>";
                            }
                        }
                        
                    } catch (PDOException $ex) {
                        echo "ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
                    }
                    ?>
                    
                </select>
            </p>
            <p>Destino: 
                <select name="dest">
                    
                    <?php
                    try {
                        
                        $result = $conex->query("SELECT Destino FROM viajes GROUP BY Destino");
                        
                        if ($result->rowCount()) {
                            while ($fila = $result->fetchObject()) {
                                echo "<option value='$fila->Destino' ";
                                // Keeping destination selected if we add it.
                                if ($dest_flag && ($_POST['dest'] == $fila->Destino)) echo "selected";
                                echo ">$fila->Destino</option>";
                            }
                        }
                        
                    } catch (PDOException $ex) {
                        echo "ERROR! ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
                    }
                    ?>
                    
                </select>
            </p>
            
            <p><input type="submit" name="consult" value="Consultar"></p>
            
        </form>
        
        <?php
        
        if (isset($_POST['consult'])) {
            
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
            
            if ($date_flag && $origin_flag && $dest_flag) {
                $general_flag = true;
                
                try {
                    
                    $reg = $conex->query("SELECT * FROM viajes WHERE Fecha = '$_POST[date]' AND Origen = '$_POST[origin]' AND Destino = '$_POST[dest]'");

                    if ($reg->rowCount()) {
                        $consulta = $reg->fetchObject();

                        // Asignar los valores obtenidos de la consulta
                        $_POST['freeSeats'] = $consulta->Plazas_libres;

                        ?>

                        <form action="" method="post">
                            <p>Fecha: <input type="date" name="date" value="<?php echo $_POST['date']; ?>" readonly=""></p>
                            <p>Origen: <input type="text" name="origin" value="<?php echo $_POST['origin']; ?>" readonly=""></p>
                            <p>Destino: <input type="text" name="dest" value="<?php echo $_POST['dest']; ?>" readonly=""></p>
                            <p>Plazas disponibles: <input type="text" name="freeSeats" value="<?php echo $_POST['freeSeats']; ?>" readonly=""></p>
                            <p>Plazas a reservar: <input type="text" name="resSeats"></p>
                            <input type="submit" name="reserve" value="Reservar">
                        </form>

                        <?php

                    } else {
                        echo "No hay ningún viaje desde $_POST[origin] hasta $_POST[dest] en la fecha: $_POST[date]";
                    }

                } catch (PDOException $exc) {
                    die ("ERROR: ".$exc->errorInfo[1]." => ".$exc->errorInfo[2]);
                }
                
            }
            
        }
            
        
        ?>
        
        
        <?php
        
        if (isset($_POST['reserve'])) {
            
            if ($_POST['freeSeats'] >= $_POST['resSeats'] && $_POST['resSeats'] > 0) {
                $seats_flag = true;
            } else {
                echo "El número de plazas a reservar debe ser menor o igual que las plazas disponibles y distinto de 0";
            }
            
            if ($seats_flag == true) {
                
                try {
                    
                    $newSeats = ($_POST['freeSeats'] - $_POST['resSeats']);
                    
                    $res = $conex->exec("update viajes set Plazas_libres = $newSeats where Fecha = '$_POST[date]' and Origen = '$_POST[origin]' and Destino = '$_POST[dest]'");
                    
                    if ($res) {
                        echo "Ha reservado $_POST[resSeats] plazas para ir a $_POST[dest] desde $_POST[origin] el día: $_POST[date]";
                    } elseif ($res === 0) {
                        echo "No se ha actualizado ningún dato";
                    } else {
                        echo "Ocurrió un error en la ejecución de la consulta";
                    }
                    
                } catch (PDOException $ex) {
                    echo "ERROR: ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
                }
                
            }
            
        }
        
        ?>
        
    </body>
</html>
