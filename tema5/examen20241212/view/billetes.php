<?php

require_once '../controller/Conexion.php';
require_once '../model/agencia.php';
require_once '../controller/controllerAgencia.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID'])) {
    session_start();
}

// Si existe sesión del Cliente, obtenemos los datos correspondientes.
if (isset($_SESSION['logueado'])) {
    $autenticado = $_SESSION['logueado'];
}

// Si existe sesión Logueado y pulsamos sobre Cerrar sesión.
if (isset($autenticado) && isset($_POST['logout'])) {
    // Cerramos la sesión actual.
    session_unset();
    session_destroy();
    setcookie("PHPSESSID", "", time() - 50000, "/"); // Eliminación en el cliente.
    // Volvemos a cargar la página.
    header("Location:index.php");
    exit();
}

?>

<html>
    <head>
        <title>Billetes</title>
    </head>
    <style>
        th, td {
            padding: 10px;
        }
    </style>
        
    <body>

        <?php
        // Si existe un cliente logueado, mostramos botón de Cerrar sesión.
        if (isset($autenticado)) {
            ?>
            <p><?php echo $autenticado->nombre ?></p>
            <p><?php echo $autenticado->telf ?></p>
            <a href="menu.php"><input type="button" name="volver" value="Volver"></a>
            <form action="" method="POST">
                <button type="submit" name="logout">Cerrar sesión</button>
            </form>
        <?php } ?>
            
            
            <h1>Billetes reservados</h1>
            
            <form action="" method="post">
                
                <p>Recorrido: 
                    <select name="rec">

                        <?php

                        try {
                            
                            $conex = new Conexion();

                            $result = $conex->query("select recorrido from tren group by recorrido");

                            if ($result->rowCount()) {

                                while ($fila = $result->fetchObject()) {
                                    echo "<option value='$fila->recorrido'>$fila->recorrido</option>";
                                }

                            }

                        } catch (PDOException $exc) {
                            echo "ERROR: ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
                        }

                        ?>

                    </select>

                </p>
                
                <p>Fecha: <input type="date" name="fecha"></p>
                
                <p>Recorrido: 
                    <select name="horas">

                        <?php

                        try {

                            $result2 = $conex->query("select hora from tren group by hora");

                            if ($result2->rowCount()) {

                                while ($fila2 = $result2->fetchObject()) {
                                    echo "<option value='$fila2->hora'>$fila2->hora</option>";
                                }

                            }

                        } catch (PDOException $exc) {
                            echo "ERROR: ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
                        }

                        ?>

                    </select>

                </p>
                
                <p><input type="submit" name="buscar" value="Buscar"></p>
                
            </form>
        
    </body>
</html>

<?php

if (isset($_POST['buscar'])) {
    
    // Sacamos lo elegido en el form
    
    $recorrido = $_POST['rec'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['horas'];
    
    echo "Reservas para $recorrido el día $fecha a las $hora";
    
    // Mostramos la tabla con las reservas
    
    ?>

<table>
    <thead>
        <th>DNI</th>
        <th>Nombre y Apellidos</th>
        <th>Telef</th>
        <th>Tipo Billete</th>
        <th>Precio</th>
        <th>Pago</th>
    </thead>
    <tbody>
        
        <?php
        
            try {

                $result3 = $conex->query("select * from cliente join billete using (dni) where recorrido = '$recorrido' and fecha = '$fecha' and hora = '$hora'");

                if ($result3->rowCount()) {

                    while ($fila3 = $result3->fetchObject()) {
                        echo "<tr>";
                        echo "<td>$fila3->dni</td>";
                        echo "<td>$fila3->nombre $fila3->apellidos</td>";
                        echo "<td>$fila3->telf</td>";
                        echo "<td>$fila3->tipo</td>";
                        echo "<td>$fila3->precio</td>";
                        echo "<td><a href='tarjetas.php'>Tarjeta</a></td>";
                        echo "</tr>";
                    }

                }

            } catch (PDOException $ex2) {
                echo "ERROR: ".$ex2->errorInfo[1]." => ".$ex2->errorInfo[2];
            }

        
        ?>
        
    </tbody>
</table>

<?php
    
}

?>