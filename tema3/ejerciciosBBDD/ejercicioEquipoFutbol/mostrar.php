<html>
    <head>
        <title>Mostrar</title>
    </head>
    <body>

        <h1>Lista de jugadores</h1>
        
        <?php
        
        try {
            $conex = new mysqli("localhost", "dwes", "abc123.", "futbol");
            $conex->set_charset("utf8mb4");
            
            $result = $conex->query("SELECT * FROM equipo");
        } catch (Exception $exc) {
            die("Error en la conexión");
        }

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
                
                echo "<br> No hay jugadores en la BBDD";
                
            }

        echo "<a href='index.php'><input type='button' name='inicio' value='Ir a inicio'></a>";
        
        ?>
        
    </body>
</html>
