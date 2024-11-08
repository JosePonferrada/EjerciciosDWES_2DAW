<html>
    <head>
        <title>Datos</title>
        <style>
            
            /* Reset básico */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: Arial, sans-serif;
                background-color: #f5f7fa;
                color: #333;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                margin: 0;
            }

            /* Contenedor principal */
            .container {
                background-color: #fff;
                width: 90%;
                max-width: 500px;
                padding: 30px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                text-align: center;
            }

            /* Título */
            .container h2 {
                color: #333;
                font-size: 24px;
                margin-bottom: 20px;
            }

            /* Información del usuario */
            .container p {
                font-size: 16px;
                margin: 10px 0;
                color: #555;
            }

            /* Botón de cerrar sesión */
            .logout-button {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                font-size: 16px;
                font-weight: bold;
                color: #fff;
                background-color: #ff6b6b;
                border: none;
                border-radius: 5px;
                text-decoration: none;
                transition: background-color 0.3s ease;
                cursor: pointer;
            }

            .logout-button:hover {
                background-color: #ff4c4c;
            }

            .logout-button:active {
                background-color: #e04a4a;
            }
            
        </style>
    </head>
    <body>
        
        <?php
        
        if (!isset($_COOKIE['user'])) {
            
            header("Location: login.php");
            exit();
            
        } 
        
        if (isset($_COOKIE['lastAccess'])) {
            
            echo "<h2>Bienvenido de nuevo ".$_COOKIE['name']." ".$_COOKIE['surname'].", tu último acceso fue el ".date("d/m/Y H:i:s", $_COOKIE['lastAccess'])."</h2>";
            
        } else {
            
            echo "<h2>Es la primera vez que entras, bienvenido ".$_COOKIE['name']." ".$_COOKIE['surname']." </h2>";
            setcookie("lastAccess", time(), time() + (30 * 24 * 60 * 60));
            
        }
        
        ?>
        
        <form action="" method="post">
            
            <input type="submit" name="logout" value="Salir" class="logout-button">
            
        </form>

        <?php
        
        if (isset($_POST['logout']) && !isset($_COOKIE['remember'])) {
            
            setcookie("user", "", time() - 3600);
            setcookie("pass", "", time() - 3600);
            setcookie("name", "", time() - 3600);
            setcookie("surname", "", time() - 3600);
            setcookie("lastAccess", time() - 3600);
            header("Location: login.php");
            exit();
            
        } else if (isset($_POST['logout']) && isset($_COOKIE['remember'])) {
            
            header("Location: login.php");
            exit();
            
        }
        
        ?>
        
    </body>
</html>
