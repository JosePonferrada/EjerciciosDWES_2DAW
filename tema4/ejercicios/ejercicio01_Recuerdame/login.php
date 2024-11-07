<html>
    <head>
        <title>Login</title>
        
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
        input[type="password"],
        input[type="checkbox"] {
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
        
        input[type="checkbox"] {
            width: auto;
            margin-right: 0.5rem;
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
        
        /* Enlace para el botón de registro */
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
        
        $general_error = $pass_error = "";
            
        if (isset($_POST['access'])) {
            
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            
            if (!empty($user) && !empty($pass)) {
                
                try {
                    $conex = new PDO('mysql:host=localhost;dbname=encriptacion;charset=utf8mb4;','dwes','abc123.');

                    $result = $conex->query("select * from usuarios where usuario = '$user'");

                    if ($result->rowCount()) {

                        $fila = $result->fetchObject();

                        if (password_verify($pass, $fila->clave)) {

                            if (isset($_POST['remember'])) {

                                setcookie("user", $fila->usuario, time() + (30 * 24 * 60 * 60));
                                setcookie("name", $fila->Nombre, time() + (30 * 24 * 60 * 60));
                                setcookie("surname", $fila->Apellidos, time() + (30 * 24 * 60 * 60));


                            } else {

                                setcookie("user", $fila->usuario, 0);
                                setcookie("name", $fila->Nombre, 0);
                                setcookie("surname", $fila->Apellidos, 0);

                            }

                            header("Location: datos.php");
                            exit();

                        } else {
                            $pass_error = "Contraseña incorrecta";
                        }

                    } else {
                        $general_error = "Usuario o contraseña incorrectos";
                    }

                } catch (PDOException $exc) {
                    $general_error = "No se pudo conectar con la BBDD";
                    die();
                }
                
            } else {
                $general_error = "El usuario y/o contraseña no pueden estar vacíos";
            }
            
        }
        
        ?>

        <form action="" method="post">
            
            <h2>Login</h2>
            
            <p>Usuario: <input type="text" name="user" value="<?php echo isset($_COOKIE['user']) ? $_COOKIE['user'] : ''; ?>"></p>
            
            <p>Clave: <input type="text" name="pass" value="<?php echo isset($_COOKIE['pass']) ? $_COOKIE['pass'] : ''; ?>"></p>
            <p><span class="error"><?php echo $pass_error; ?></span></p>
                        
            <p>Recuérdame <input type="checkbox" name="remember" <?php echo isset($_COOKIE['user']) ? 'checked' : ''; ?>></p>
            
            <p>
                <input type="submit" name="access" value="Acceder">
                <a href='registro.php'><input type='button' name='register' value='Registrar'></a>
                
            </p>
            
            <p><span class="error"><?php echo $general_error; ?></span></p>
            
        </form>
                
    </body>
</html>
