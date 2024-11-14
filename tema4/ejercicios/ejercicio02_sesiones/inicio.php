<html>
    <head>
        <title>Inicio</title>
    </head>
    <body>
        
        <form action="" method="post">
            
            <a href="index.php"><input type="button" name="salir" value="Salir"></a>

            <?php
            // Propagating
            session_start();

            echo "Hola ".$_SESSION['user']->Nombre." ".$_SESSION['user']->Apellidos;

            ?>

            <h1>Bienvenido a nuestra web</h1>

            <a href="datos.php">Ver mis datos</a><br><br>
            <a href="modifica.php">Modificar datos</a>

        </form>
    </body>
</html>
