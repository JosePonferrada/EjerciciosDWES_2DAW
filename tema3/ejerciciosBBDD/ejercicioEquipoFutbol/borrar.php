<html>
    <head>
        <title>Borrar Jugador</title>
    </head>
    <body>

        <h1>Borrado de Jugador</h1>
        
        <!-- Form to find a player by DNI -->
        <form action="" method="post">
            Ingrese DNI del jugador a borrar:
            <input type="text" name="dniToFind"><br><br>
            <input type="submit" name="search" value="Buscar">
            
            <a href="index.php"><input type="button" name="inicio" value="Ir a inicio"></a>
            <br><br>
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
                            
                            // Form which shows the actual data of the player to be deleted
                            echo "<h2>Borrar jugador</h2>";
                            echo '<form action="" method="post">';
                            echo 'DNI: <input type="text" name="dni" value="'.$fila->DNI.'" readonly><br><br>'; // Must be readonly, if we set it to disabled an error occurs
                            echo 'Nombre: <input type="text" name="nombre" value="'.$fila->Nombre.'" readonly><br><br>';
                            echo 'Dorsal: <input type="number" name="dorsal" value="'.$fila->Dorsal.'" readonly><br><br>';
                            echo 'Posición: <input type="text" name="posicion" value="'.$fila->Posicion.'" readonly><br><br>';
                            echo 'Equipo: <input type="text" name="equipo" value="'.$fila->Equipo.'" readonly><br><br>';
                            echo 'Goles: <input type="number" name="goles" value="'.$fila->Goles.'" readonly><br><br>';
                            echo '<input type="submit" name="delete" value="Borrar">';
                            echo '<input type="submit" name="cancel" value="Cancelar">';
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
        
        if (isset($_POST['delete'])) {
            $dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            $dorsal = $_POST['dorsal'];
            $posicion = $_POST['posicion'];
            $equipo = $_POST['equipo'];
            $goles = $_POST['goles'];

            try {
                    
                $conex = new mysqli("localhost", "dwes", "abc123.", "futbol");
                $conex->set_charset("utf8mb4");

                $query = "DELETE from equipo WHERE DNI = ?";
                $stmt = $conex->prepare($query);
                $stmt->bind_param('s', $dni);

                if ($stmt->execute()) {
                    echo "<br>Los datos del jugador han sido borrados.<br>";
                    // Usamos header() para redirigir al index y mostrar el mensaje allí
                    header("Location: index.php?mensaje=Registro borrado correctamente");
                } else {
                    echo "Error al borrar los datos del jugador.";
                }
                
            } catch (Exception $exc) {
                
                die("Error al conectar<br>");
                
            }

            $conex->close();

        }
        
        ?>
        
    </body>
</html>
