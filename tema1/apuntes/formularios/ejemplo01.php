<!doctype html>

<html>
    <head>
        <title>Ejemplo 01 - Forms</title>
    </head>
    <body>
        
        <h3>Método POST</h3>
        <!-- Si dejamos el action en blanco hará una solicitud al servidor del mismo fichero.
            También se puede poner el nombre del fichero, o también hacer uso de la variable
            superglobal $_SERVER["PHP_SELF"] de esta manera: -->
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        
        <!--<form action="" method="post"> -->
        <!--<form action="ejemplo01.php" method="post"> -->
        
            Nombre: <input type="text" name="nombre"><br>
            Apellido: <input type="text" name="apell"><br>    
            
            <!-- Al crear un checkbox, en NAME pondremos un array ya que podemos seleccionar más de uno -->
            <!-- TODOS los name de los checkbox del mismo grupo deben ser iguales -->
            <input type="checkbox" name="modulos[]" value="DWES">Desarrollo Web de Entorno Servidor<br>
            <input type="checkbox" name="modulos[]" value="DWEC">Desarrollo Web de Entorno Cliente<br>
            <input type="checkbox" name="modulos[]" value="DIW">Desarrollo de Interfaces Web<br>
            
            <input type="submit" name="enviar" value="Enviar">
            
        </form>
        
        <a href="procesa.php?nombre=Pepe&apell=Sanchez">Ir a procesa</a>
        
        <!-- Dará errores debido a la ejecución secuencial -->
        <!-- Con la función isset() podemos controlar si hemos enviado el formulario
            y así ejecutar el código solo cuando lo hayamos enviado.
            Siendo así que la primera vez que cargue el código solo ejecutará el código HTML -->
        
        <!-- También podemos poner todo el código al principio con una etiqueta PHP, abrir un else,
            cerrar la etiqueta, a continuación meter el código HTML y después cerrar el else con
            otra etiqueta PHP -->
        
        <?php

        if (isset($_POST['enviar'])) { // Si se pulsa el formulario: 

            echo "<br>";
            echo $_POST['nombre']." ".$_POST['apell'];

            // echo $_GET['nombre']." ".$_GET['apell'];

            // Mostramos el primer elemento marcado del checkbox

            //echo $_POST['modulos'][0];
            echo "<br>";

            // Para recorrer el array del checkbox y mostrarlo

            foreach ($_POST["modulos"] as $value) {
                echo "<p>".$value."</p>";
            }

            echo "<br><a href='ejemplo01.php'>Introducir otro</a>";
            
            // echo $_REQUEST['nombre']." ".$_REQUEST['apell'];
        }

        ?>
        
    </body>
</html>
