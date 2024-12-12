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
        <title>Reservas</title>
    </head>
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
            
            <form action="" method="post">
                
                <p>Dni cliente: <input type="text" name="dni"></p>
                
                <p><input type="submit" name="buscar" value="Buscar"></p>
                
            </form>
        
         
            <?php
            
            if (isset($_POST['buscar'])) {

                try {

                    $conex = new Conexion();

                    $result = $conex->query("select * from cliente where dni = '$_POST[dni]'");

                    if ($result->rowCount()) {

                        $fila = $result->fetchObject();
                        // Si existe el cliente 
                        echo "El cliente $fila->nombre $fila->apellidos tiene las siguientes reservas:";
                        
                        echo "<form action='' method='post'>";
                        
                        echo "<table>
                                <thead>
                                    <th>Recorrido</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Tipo Billete</th>
                                    <th>Precio</th>
                                    <th>Acción</th>
                                </thead>
                                <tbody>";
                        
                        // Hacemos una consulta para ver las reservas con ese dni
                        
                        $result2 = $conex->query("select * from billete where dni = '$fila->dni'");
                        
                        if ($result2->rowCount()) {
                            while ($fila2 = $result2->fetchObject()) {
                                echo "<tr>";
                                echo "<td>$fila2->recorrido</td>";
                                echo "<td>$fila2->fecha</td>";
                                echo "<td>$fila2->hora</td>";
                                echo "<td>$fila2->tipo</td>";
                                echo "<td>$fila2->precio</td>";
                                echo "<td><input type='submit' name='anular' value='Anular'></td>";
                                echo "</tr>";
                            }
                        }
                        
                        $dni = isset($fila2->dni) ? $fila2->dni : '';

                    } else {
                        $msg = "No se encuentra el cliente con DNI $dni , debe añadir sus datos";
                    }

                } catch (PDOException $ex) {
                    echo "ERROR: ".$ex->errorInfo[1]." => ".$ex->errorInfo[2];
                }
                
                echo "</tbody>
                    </table>";
                echo "</form>";
                
                
            }
            
            ?>
            
            <span><?php if (isset($msg)) echo $msg; ?></span>
            
    </body>
</html>
