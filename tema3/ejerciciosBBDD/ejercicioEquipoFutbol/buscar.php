<html>
    <head>
        <title>Buscar</title>
    </head>
    <body>

        <h1>Búsqueda de jugadores</h1>
        
        <form action="" method="post">
            Buscar por: 
            <select name="filterBuscar">
                <option value="DNI">DNI</option>
                <option value="team">Equipo</option>
                <option value="posicion">Posición</option>
            </select><br><br>
            
            Valor a buscar: <input type="text" name="info"><br><br>
            
            <a href="index.php"><input type="button" name="inicio" value="Ir a inicio"></a>
            <br><br>
            
            <input type="submit" name="search" value="Buscar">
        </form>
        
        <?php
        
        // Now we gonna validate the data
        
        $dni_flag = false; $pos_flag = false; $team_flag = false;
        
        if (isset($_POST['search'])) {
            
            switch ($_POST['filterBuscar']) {
                case 'DNI':
                    if (preg_match('/\d{8}[A-Z]/', $_POST['info'])) {    
                        $dni_flag = true;
                    }
                    break;
                
                case 'team':
                    if (preg_match('/^([a-z]+\s?)+$/i', $_POST['info'])) { 
                        $team_flag = true;
                    }
                    break;
                
                case 'posicion':
                    if (preg_match('/^[a-zA-Z]+$/', $_POST['info'])) {
                        $pos_flag = true;
                    }
                    break;

            }
            
        }
        
        // Now we have validated the data we must connect to the database and do the query
        
        if (isset($_POST['search']) && ($dni_flag || $pos_flag || $team_flag)) {
            
            try {
                $conex = new mysqli("localhost", "dwes", "abc123.", "futbol");
                $conex->set_charset("utf8mb4");

                $query = ("select * from equipo where ");
                $searchValue = $_POST['info'];

                if ($dni_flag == true) {
                    $query .= "DNI = ?";
                    $searchValue = $_POST['info'];
                }            

                elseif ($team_flag == true) {
                    $query .= "Equipo like ?";
                    $searchValue = "%".$_POST['info']."%";
                }

                elseif ($pos_flag == true) {
                    $query .= "Posicion like ?";
                    $searchValue = "%".$_POST['info']."%";
                }

                // When we have the query, we can do the preparedStatement with the query

                $stmt = $conex->prepare($query);
                $stmt ->bind_param('s', $searchValue);

                if ($stmt->execute()) {

                    $result = $stmt->get_result();
                    
                    if ($result->num_rows) {
                        
                        while ($fila = $result->fetch_object()) {

                            echo "Nombre: ".$fila->Nombre."<br>";
                            echo "DNI: ".$fila->DNI."<br>";
                            echo "Dorsal: ".$fila->Dorsal."<br>";
                            echo "Posición: ".$fila->Posicion."<br>";
                            echo "Equipo: ".$fila->Equipo."<br>";
                            echo "Goles: ".$fila->Goles."<br>";

                            echo "<br>==================================<br>";

                        }  
                        
                    } else {
                        echo "<br>No hay jugadores que cumplan con ese filtro. Inténtelo de nuevo con otro diferente.<br>";
                    }

                    

                } 


            } catch (Exception $ex) {

                die("Error al conectar<br>");

            }

            // We close the conex

            $conex->close();

        }
        
        ?>
        
    </body>
</html>
