<!doctype html>

<html>
    <head>
        <title>Confirma</title>
    </head>
    <body>
        
        <h1>Form Confirmación</h1>

        <?php 
        
            echo "Nombre: ".$_POST['nombre']."<br>";
            echo "Apellido: ".$_POST['apell']."<br>";
            
            echo "Nº matrícula: ".$_POST['numMatricula']."<br>";
            echo "Curso: ".$_POST['curso']."<br>";
            echo "Precio: ".$_POST['precio']."<br>";
        
        ?>
        
    </body>
</html>
