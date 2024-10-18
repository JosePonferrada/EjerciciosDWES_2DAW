<html>
    <head>
        <title>Ejercicio 03 - Inserts Multitablas</title>
    </head>
    <body>
        
        <form action="" method="post">
            
            DNI: <input type="text" name="dni"><br><br>
            Nombre: <input type="text" name="name"><br><br>
            Apellidos: <input type="text" name="surname"><br><br>
            Salario: <input type="text" name="salary"><br><br>
            
            Idiomas: <br>
            <input type="checkbox" name="idiomas[]" value="Inglés">
            <label for="idioma1">Inglés</label><br>
            <input type="checkbox" name="idiomas[]" value="Francés">
            <label for="idioma2">Francés</label><br>
            <input type="checkbox" name="idiomas[]" value="Alemán">
            <label for="idioma3">Alemán</label><br>
            <input type="checkbox" name="idiomas[]" value="Chino">
            <label for="idioma4">Chino</label><br><br>
            
            <input type="submit" name="add" value="Añadir">
            
        </form>
        
        <?php
        
            try {
                
                $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
                
                $conex->set_charset("utf8mb4");
                
                $conex -> autocommit(false);
                
            } catch (Exception $exc) {
                
                die("Error al conectar");
                
            }
       
            // ======================= Si pulsamos añadir ==========================
            
            try {
                
                if (isset($_POST['add'])) {
                
                    $conex->query("INSERT INTO marketing values ('$_POST[dni]', '$_POST[name]', '$_POST[surname]', $_POST[salary])");

                    if ($conex->affected_rows) {

                        $stmt = $conex -> prepare("insert into idiomas values ('$_POST[dni]', ?)");
                        
                        foreach ($_POST["idiomas"] as $value) {
                         
                            $stmt -> bind_param("s", $value);
                            
                            $stmt -> execute();
                            
                        }
                        
                    }
                    
                    if ($conex -> commit()) echo "Registros insertados correctamente";
                    
                }
                                
            } catch (Exception $ex) {

                $conex -> rollback();
                die($ex -> getMessage());
                
            }
        
        ?>
        
    </body>
</html>
