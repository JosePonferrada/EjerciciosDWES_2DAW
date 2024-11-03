<html>
    <head>
        <title>Autobús</title>
    </head>
    <body>
        
        <h1>Nuevo bus</h1>
        <form action="" method="post">
            <p>Matrícula:<input type="text" name="plate"</p>
            <p>Marca:<input type="text" name="brand"</p>
            <p>Nº plazas:<input type="text" name="seats"</p>
            <br><br>
            <input type="submit" name="add" value="Añadir">
            <a href="index.php"><input type="button" name="inicio" value="Ir a inicio"></a>
            <br><br>
        </form>
        
        <?php

        $plate_flag = false; $brand_flag = false; $seats_flag = false;
        
        $general_flag = false;
        
        if (isset($_POST['add'])) {
            
            if (preg_match('/^[0-9]{3}[A-Z]{3}$/', $_POST['plate'])) {
                $plate_flag = true;
            } else {
                echo "La matrícula debe ser 3 números seguidos de 3 letras en mayúscula";
            }
            
            if (preg_match('/^[a-zA-Z]+\s?[a-zA-Z]+?$/', $_POST['brand'])) {
                $brand_flag = true;
            } else {
                echo "La marca solo debe tener letras";
            }
            
            if (preg_match('/^\d+$/', $_POST['seats']) && $_POST['seats'] > 0) {
                $seats_flag = true;
            } else {
                echo "Introduzca un número positivo mayor que 0";
            }
            
            if ($plate_flag && $brand_flag && $seats_flag) $general_flag = true;
            
            if ($general_flag == true) {
                
                try {
                    $conex = new PDO('mysql:host=localhost;dbname=autobuses;charset=utf8mb4;','dwes','abc123.');
                    
                    $conex ->beginTransaction();
                    
                    $affected_rows = $conex->exec("INSERT INTO autos values ('$_POST[plate]','$_POST[brand]','$_POST[seats]')");
                    
                    // If $affected_rows === false ==> means there is an error on the query
                    // 0 means no rows affected
                    // Greater than 0 show how many rows are affected
                    
                    if ($affected_rows) {
                        echo "<br>Bus insertado correctamente<br>";
                        $conex->commit();
                    }
                    
                } catch (PDOException $exc) {
                    $conex->rollBack();
                    // To add message when primary key is duplicated
                    die("No se pudo conectar con la BBDD");
                }
                            
            }
            
        }
        
        ?>
        
    </body>
</html>
