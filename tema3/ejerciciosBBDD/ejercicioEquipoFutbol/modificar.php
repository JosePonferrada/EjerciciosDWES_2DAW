<html>
    <head>
        <title>Modificar Jugador</title>
    </head>
    <body>

        <h1>Modificar Información de Jugador</h1>
        
        <!-- Form to find a player by DNI -->
        <form action="" method="post">
            Ingrese DNI del jugador a modificar:
            <input type="text" name="dniToFind"><br><br>
            <input type="submit" name="search" value="Buscar">
        </form>
        
        <?php

        if (isset($_POST['search'])) {
            $dni = $_POST['dniToFind'];

            // Format validation of DNI
            if (preg_match('/\d{8}[A-Z]/', $dni)) {
                
                try {
                    
                    $conex = new mysqli("localhost", "dwes", "abc123.", "futbol");
                    $conex->set_charset("utf8mb4");

                    $query = "SELECT * FROM equipo WHERE DNI = ?";
                    $stmt = $conex->prepare($query);
                    $stmt->bind_param('s', $dni);

                    if ($stmt->execute()) {
                        $result = $stmt->get_result();

                        if ($fila = $result->fetch_object()) {
                            
                            // Form which shows the actual data of the player to be modified
                            echo "<h2>Modificar datos del jugador</h2>";
                            echo '<form action="" method="post">';
                            echo 'DNI: <input type="text" name="dni" value="'.$fila->DNI.'" readonly><br><br>'; // Must be readonly, if we set it to disabled an error occurs
                            echo 'Nombre: <input type="text" name="nombre" value="'.$fila->Nombre.'"><br><br>';
                            echo 'Dorsal: <input type="number" name="dorsal" value="'.$fila->Dorsal.'"><br><br>';
                            echo 'Posición: <input type="text" name="posicion" value="'.$fila->Posicion.'"><br><br>';
                            echo 'Equipo: <input type="text" name="equipo" value="'.$fila->Equipo.'"><br><br>';
                            echo 'Goles: <input type="number" name="goles" value="'.$fila->Goles.'"><br><br>';
                            echo '<input type="submit" name="modify" value="Guardar Cambios">';
                            echo '</form>';
                            
                        } else {
                            
                            echo "<br>No se encontró ningún jugador con el DNI insertado.<br>";
                            
                        }
                    }
                    
                } catch (Exception $ex) {

                    die("Error al conectar<br>");
                    
                }
                
                $conex->close();
                
            } else {
                echo "Formato de DNI incorrecto. ";
            }
            
        }

        if (isset($_POST['modify'])) {
            $dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            $dorsal = $_POST['dorsal'];
            $posicion = $_POST['posicion'];
            $equipo = $_POST['equipo'];
            $goles = $_POST['goles'];

            try {
                    
                $conex = new mysqli("localhost", "dwes", "abc123.", "futbol");
                $conex->set_charset("utf8mb4");

                $query = "UPDATE equipo SET Nombre = ?, Dorsal = ?, Posicion = ?, Equipo = ?, Goles = ? WHERE DNI = ?";
                $stmt = $conex->prepare($query);
                $stmt->bind_param('sissis', $nombre, $dorsal, $posicion, $equipo, $goles, $dni);

                if ($stmt->execute()) {
                    echo "<br>Los datos del jugador han sido actualizados exitosamente.<br>";
                    // Usamos header() para redirigir al index y mostrar el mensaje allí
                    header("Location: index.php?mensaje=Modificación realizada correctamente");
                } else {
                    echo "Error al actualizar los datos del jugador.";
                }
                
            } catch (Exception $exc) {
                
                die("Error al conectar<br>");
                
            }

            $conex->close();

        }
        
        ?>
        
    </body>
</html>
