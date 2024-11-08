<html>
    <head>
        <title>Registro</title>
        <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #1c1c2b;
            color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        /* Contenedor del formulario */
        form {
            background-color: #2d2d3f;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
            text-align: left;
        }

        h2 {
            color: #f5f5f5;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        /* Estilos de los campos de entrada */
        p {
            margin-bottom: 1rem;
        }
        
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            margin-top: 0.5rem;
            border: 1px solid #444;
            border-radius: 5px;
            font-size: 1rem;
            color: #f5f5f5;
            background-color: #3a3a4d;
            box-sizing: border-box;
        }

        /* Botones */
        input[type="submit"],
        input[type="button"] {
            width: 100%;
            padding: 0.8rem;
            margin-top: 1rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            background-color: #8a2be2; /* púrpura */
            color: white;
        }
        
        input[type="submit"]:hover {
            background-color: #7a23c7;
        }

        input[type="button"] {
            background-color: #57576d;
            margin-top: 0.5rem;
        }

        input[type="button"]:hover {
            background-color: #474758;
        }
        
        /* Enlace para el botón de login */
        a {
            text-decoration: none;
            display: block;
        }
        
        .error {
            color: red;
            font-size: 0.9rem;
        }
        
    </style>
    </head>
    <body>
        
        <?php
        
        $dni_error = $name_error = $surname_error = $user_error = $pass_error = $general_message = "";
        $dni_flag = false; $name_flag = false; $surname_flag = false; $user_flag = false; $pass_flag = false;
        
        $general_flag = false;
        
        ?>
        
        <?php
        
        if (isset($_POST['register'])) {
            
            $dni = $_POST['DNI'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $user = $_POST['user'];
            
            
            // We have to check the data is correct, then insert
                
            if (preg_match('/\d{8}[A-Z]/', $dni)) {    
                $dni_flag = true;
            } else {   
                $dni_error = "El DNI debe tener 8 números y una letra mayúscula<br>";   
            }

            if (preg_match('/^[a-z]+\s?[a-z]+$/i', $name)) {
                $name_flag = true;
            } else {
                $name_error = "El nombre debe contener letras solamente<br>";
            }

            if (preg_match('/^[a-z]+\s?[a-z]+$/i', $surname)) {
                $surname_flag = true;
            } else {
                $surname_error = "El apellido debe contener letras solamente<br>";
            }

            if (!empty($user)) {
                $user_flag = true;
            } else {
                $user_error = "El usuario no puede estar vacío";
            }

            if (!empty($_POST['pass'])) {
                $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                $pass_flag = true;
            } else {
                $pass_error = "La contraseña no puede estar vacía";
            }

            if ($dni_flag && $name_flag && $surname_flag && $user_flag && $pass_flag) {

                $general_flag = true;

                try {

                    $conex = new PDO('mysql:host=localhost;dbname=encriptacion;charset=utf8mb4;','dwes','abc123.');

                    $affected_rows = $conex->exec("INSERT INTO usuarios (DNI, Nombre, Apellidos, usuario, clave) values ('$dni', '$name', '$surname', '$user', '$pass')");

                    // If $affected_rows === false ==> means there is an error on the query
                    // 0 means no rows affected
                    // Greater than 0 shows how many rows are affected

                    if ($affected_rows) {

                        $general_message = "Usuario insertado correctamente";

                    } 
//                    elseif ($affected_rows == 0) {
//                        $general_message = "No se introdujo ningún dato";
//                        
//                    } else {
//                        $general_message = "Hay un error en la query";
//                    }

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
        
        <form action="" method="post">
        
            <h2>Registro</h2>
            
            <p>DNI: <input type="text" name="DNI"></p>
            <p><span class="error"><?php echo $dni_error; ?></span></p>
            
            <p>Nombre: <input type="text" name="name"></p>
            <p><span class="error"><?php echo $name_error; ?></span></p>
            
            <p>Apellidos: <input type="text" name="surname"></p>
            <p><span class="error"><?php echo $surname_error; ?></span></p>
            
            <p>Usuario: <input type="text" name="user"></p>
            <p><span class="error"><?php echo $user_error; ?></span></p>
            
            <p>Clave: <input type="text" name="pass"></p>
            <p><span class="error"><?php echo $pass_error; ?></span></p>
            
            <p>
                <a href='login.php'><input type='button' name='login' value='Login'></a>
                <input type="submit" name="register" value="Registrar">

            </p>
            <p><span class="error"><?php echo $general_message; ?></span></p>
            
            
        </form>        
        
    </body>
</html>
