<html>
    <head>
        <title>Index</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <!-- Recogemos el mensaje y se muestra el mensaje de lo que 
        hayamos hecho ya que lo hemos llamado mensaje en todos lados -->
        <?php
            if (isset($_GET['mensaje'])) {
                echo "<h3>$_GET[mensaje]</h3>";
            }
        ?>
        
        <h1>Índice</h1>
        
        <div>
            <a href="introducir.php">1.- Introducir datos</a><br><br>
            <a href="mostrar.php">2.- Mostrar datos</a><br><br>
            <a href="buscar.php">3.- Buscar</a><br><br>
            <a href="modificar.php">4.- Modificar datos</a><br><br>
            <a href="borrar.php">5.- Borrar</a><br><br>
        </div>
    </body>
</html>
