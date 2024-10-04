<!doctype html>

<html>
    <head>
        <title>Completo</title>
    </head>
    <body>
        
        <h1>Form Personal</h1>



        <?php

            if (isset($_POST['siguiente'])) {

            ?>

            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

                Nº matrícula: <input type="text" name="numMatricula"><br>
                <br>

                Curso: 
                <select name="curso">
                    <option value="1º ESO">1º ESO</option>
                    <option value="2º ESO">2º ESO</option>
                    <option value="3º ESO">3º ESO</option>
                    <option value="4º ESO">4º ESO</option>
                </select><br>
                <br>

                Precio: <input type="text" name="precio"><br>
                <br>

                <!-- Para hacer que lleguen los datos desde el primer form al último, deberemos ir arrastrando
                    los datos a través de un elemento oculto (type="hidden"). Estos elementos no se muestran -->
                <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">

                <input type="hidden" name="apell" value="<?php echo $_POST['apell']; ?>">

                <input type="submit" name="siguiente2" value="Siguiente">     

            </form>

        <?php

            }
            
            elseif (isset($_POST['siguiente2'])) {
        
                echo "Nombre: ".$_POST['nombre']."<br>";
                echo "Apellido: ".$_POST['apell']."<br>";

                echo "Nº matrícula: ".$_POST['numMatricula']."<br>";
                echo "Curso: ".$_POST['curso']."<br>";
                echo "Precio: ".$_POST['precio']."<br>";
                
                echo "<a href=\"varianteTodoEnUno.php\">Volver a inicio</a>";
                
            }

            else {
                
                ?>
                
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

                    Nombre: <input type="text" name="nombre"><br>
                    <br>

                    Apellido: <input type="text" name="apell"><br>
                    <br>

                    <input type="submit" name="siguiente" value="Siguiente">   
                    
                </form>
                
        <?php
        
            }

        ?>
        
    </body>
</html>
