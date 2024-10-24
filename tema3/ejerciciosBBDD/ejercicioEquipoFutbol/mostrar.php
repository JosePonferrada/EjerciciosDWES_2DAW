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
                    echo "Apellidos: ".$fila->Apellidos."<br>";
                    
                    
                }
                
            } else {
                
                echo "<br> No hay jugadores en la BBDD";
                
            }

        echo "<a href='index.html'><input type='button' name='inicio' value='Ir a inicio'></a>";
        
        ?>
        
    </body>
</html>
