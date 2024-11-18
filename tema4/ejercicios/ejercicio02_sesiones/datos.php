<html>
    <head>
        <title>Datos</title>
    </head>
    <body>
        
        <?php session_start(); ?>
        
        <a href="index.php"><input type="button" name="salir" value="Salir"></a>
        
        <?php
        
        echo "Hola ".$_SESSION['user']->Nombre." ".$_SESSION['user']->Apellidos;
        
        echo "<h1>Tus datos son:</h1>";
        
        echo "<h5>Nombre:</h5>".$_SESSION['user']->Nombre;
        echo "<h5>Apellidos:</h5>".$_SESSION['user']->Apellidos;
        echo "<h5>Dirección:</h5>".$_SESSION['user']->Direccion;
        echo "<h5>Localidad:</h5>".$_SESSION['user']->Localidad;
        echo "<h5>Usuario:</h5>".$_SESSION['user']->usuario;
        echo "<h5>Color de letra:</h5>".$_SESSION['user']->colorLetra;
        echo "<h5>Color de fondo:</h5>".$_SESSION['user']->colorFondo;
        echo "<h5>Tipo de letra:</h5>".$_SESSION['user']->tipoLetra;
        echo "<h5>Tamaño de letra:</h5>".$_SESSION['user']->sizeLetra;
        
        ?>
        
    </body>
</html>
