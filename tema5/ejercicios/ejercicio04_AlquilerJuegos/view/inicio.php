<?php
require_once '../controller/ControllerJuego.php';

// Guardamos todos los juegos en una variable
$juegos = ControllerJuego::getAll();

?>

<html>
    <head>
        <title>Inicio</title>
        <style>
            body {
                text-align: center;
            }
            .containerJuegos {
                display: flex;
                flex-direction: row;
                gap: 10px;
                padding: 20px;
                justify-content: space-evenly;
            }
            img {
                width: 150px;
            }
            .divBienvenida{
                justify-content: start;
            }
            .divLoginRegister {
                justify-content: end;
            }
            a {
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        
        <div class="divBienvenida">
            <!-- Aquí va la bienvenida con la session -->
            
        </div>
        
        <div class="divLoginRegister">
            <a href="login.php"><button>Login</button></a>
            <a href="register.php"><button>Register</button></a>
        </div>
        
        <!-- Aquí van todos los tabs -->
        
        <h2>Juegos</h2>
        
        <?php
        showAllGames($juegos);
        ?>
        
    </body>
</html>

<?php

function showAllGames($juegos) {
    echo "<div class='containerJuegos'>";
    
    foreach ($juegos as $juego) {
        echo "<form action='' method='POST'>";
        echo "<img src='$juego->imagen' alt='$juego->nombre_juego' value='$juego->codigo'>";
        echo "</form>";
        
    }
    echo "</div>";
}

?>

