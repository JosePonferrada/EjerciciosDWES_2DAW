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
        
        <h1>Menú</h1>
        
        <div>
            <a href="autobus.php">1.- Añadir autobús</a><br><br>
            <a href="viaje.php">2.- Añadir viaje</a><br><br>
            <a href="modificaBorra.php">3.- Modificar/Borrar viaje</a><br><br>
            <a href="reserva.php">4.- Reservar</a><br><br>
        </div>
    </body>
</html>
