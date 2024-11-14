<html>
    <head>
        <title>Registro</title>
    </head>
    <body>
        
        <?php
        
        $name_flag = false; $surname_flag = false; $location_flag = false; $town_flag = false; $user_flag = false; $pass_flag = false;
        
        $general_flag = false;
        
        if (isset($_POST['register'])) {
            
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $location = $_POST['location'];
            $town = $_POST['town'];
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $pass2 = $_POST['pass2'];
            
            
            // Now we gonna validate the data
            
            if (preg_match('/^[a-z]+\s?[a-z]+$/i', $name)) {
                $name_flag = true;
            } else {
                echo "El nombre debe contener letras solamente<br>";
            }

            if (preg_match('/^[a-z]+\s?[a-z]+$/i', $surname)) {
                $surname_flag = true;
            } else {
                echo "El apellido debe contener letras solamente<br>";
            }

            if (!empty($user)) {
                $user_flag = true;
            } else {
                echo "El usuario no puede estar vacío";
            }
            
            if ($pass === $pass2 && !empty($pass) && !empty($pass2)) {
                $pass_flag = true;
                $passToInsert = password_hash($pass, PASSWORD_DEFAULT);
            } else {
                echo "La contraseña no puede estar vacía y debe coincidir con la confirmación de la clave";
            }
            
            if (!empty($location)) {
                $location_flag = true;
            } else {
                echo "La dirección no puede estar vacía";
            }
            
            if (!empty($town)) {
                $town_flag = true;
            } else {
                echo "La localidad no puede estar vacía";
            }
            
            if ($name_flag && $surname_flag && $location_flag && $town_flag && $user_flag && $pass_flag) {
                $general_flag = true;
                
                try {

                    $conex = new PDO('mysql:host=localhost;dbname=sesiones;charset=utf8mb4;','dwes','abc123.');

                    $conex->exec("INSERT INTO datos (Nombre, Apellidos, Direccion, Localidad, usuario, clave, "
                            . "colorLetra, colorFondo, tipoLetra, sizeLetra) values "
                            . "('$name', '$surname', '$location', '$town', '$user', '$passToInsert', '$_POST[colorLetra]',"
                            . " '$_POST[bgColor]', '$_POST[tipoLetra]', '$_POST[letraSize]')");
                    
                    
                    // Correct insert then redirect to inicio.php
                        
                    $result = $conex->query("select * from datos where usuario = '$user'");

                    if ($result->rowCount()) {

                        $fila = $result->fetchObject();


                        // Propagating
                        session_start();

                        // Saving the whole object
                        $_SESSION['user'] = $fila;
                        header("Location:inicio.php");
                        
                    }

                } catch (PDOException $ex) {
                    
                    if ($ex->getCode() == 23000) {
                        
                        // We dont use die() here because we dont want the app to end.
                        
                        $general_message = "Ya existe un registro con ese DNI. Inserte otro distinto.";
                        //exit();
                    } elseif ($ex->getCode() == 42000) {
                        $general_message = "Ya existe un registro con ese nombre de usuario. Inserte otro distinto.";
                        //die();
                    } else {
                        $general_message = "No se pudo conectar con la BBDD";
                        //die();
                    }

                }
                
            }
            
        }
        
        ?>
        
        <h1>Introduzca los datos</h1>
        
        <form action="" method="post">
            
            <p>Nombre:<input type="text" name="name"></p>
            <p>Apellidos:<input type="text" name="surname"></p>
            <p>Dirección:<input type="text" name="location"></p>
            <p>Localidad:<input type="text" name="town"></p>
            <p>Usuario:<input type="text" name="user"></p>
            <p>Clave:<input type="text" name="pass"></p>
            <p>Repetir clave:<input type="text" name="pass2"></p>
            <p>Color de letra:
                <select id="colorLetra" name="colorLetra">
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                </select>
            </p>
            <p>Color de fondo:
                <select id="bgColor" name="bgColor">
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                </select>
            </p>
            <p>Tipo de letra:
                <select id="tipoLetra" name="tipoLetra">
                    <option value="arial">Arial</option>
                    <option value="roboto">Roboto</option>
                    <option value="times new roman">Times New Roman</option>
                </select>
            </p>
            <p>Tamaño de letra:
                <select id="letraSize" name="letraSize">
                    <option value="12">12</option>
                    <option value="14">14</option>
                    <option value="16">16</option>
                </select>
            </p>
            
            <a href="index.php"><input type="button" value="Cancelar"></a>
            <input type="submit" name="register" value="Registrar">
            
        </form>        
        
    </body>
</html>
