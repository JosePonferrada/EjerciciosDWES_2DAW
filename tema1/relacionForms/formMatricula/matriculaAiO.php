<!doctype html>

<html>
    <head>
        <title>Matrícula</title>
    </head>
    <body>
        
        <?php
        
            if (!isset($_POST['siguiente'])) {
                
            ?>
        
        <form action="" method="post">
        
            Nombre: <input type="text" name="nombre"><br>
            <br>
            
            Apellido: <input type="text" name="apell"><br>
            <br>
            
            Idiomas: <br>
            <input type="checkbox" name="idiomas[]" value="Inglés">Inglés<br>
            <input type="checkbox" name="idiomas[]" value="Francés">Francés<br>
            <input type="checkbox" name="idiomas[]" value="Alemán">Alemán<br>
            
            <input type="submit" name="siguiente" value="Siguiente">   

        </form>
        
        <?php
        
            }
            
            if (isset($_POST['siguiente'])) {
                
                ?>
        
                <form action="" method="post">
        
                    Nº matrícula: <input type="text" name="matric"><br>
                    <br>

                    Curso: <input type="text" name="curso"><br>
                    <br>
                    
                    Precio: <input type="text" name="precio"><br>
                    <br>

                    <input type="submit" name="siguiente2" value="Siguiente">
                    
                    <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
            
                    <input type="hidden" name="apell" value="<?php echo $_POST['apell']; ?>">

                    <input type="hidden" name="idiomas" value="<?php echo implode("; ",$_POST['idiomas']); ?>">
                    
                    <!-- Otra manera de hacerlo con JSON -->
                    <!-- Si usamos JSON en un value no ponemos comillas dobles, ya que el propio JSON trae
                        comillas dobles al crearse -->
                    <input type="hidden" name="idiomas" value=<?php echo json_encode($_POST['idiomas']); ?>>


                </form>
                
        <?php
        
            }
        
            if (isset($_POST['siguiente2'])) {
                
                // var_dump($_POST);
                
                echo "Nombre: ".$_POST['nombre']."<br>";
                echo "Apellido: ".$_POST['apell']."<br>";
                
//                // Otra manera de mostrarlos
//                $idio = explode("; ", $_POST['idiomas']);
//                echo "Idiomas: ";
//                foreach ($idio as $value) {
//                    echo $value." ";
//                }

                // Otra manera de mostrarlos con JSON
                
                $idio = json_decode($_POST['idiomas']);
                
                echo "Idiomas: ";
                foreach ($idio as $value) {
                    echo $value." ";
                }
                echo "<br>";

                // echo "Idiomas: ".$_POST['idiomas']."<br>";
                
                echo "Nº de matricula: ".$_POST['matric']."<br>";
                echo "Curso: ".$_POST['curso']."<br>";
                echo "Precio: ".$_POST['precio']."<br>";
                
                
            }
            
            ?>
        
    </body>
</html>
