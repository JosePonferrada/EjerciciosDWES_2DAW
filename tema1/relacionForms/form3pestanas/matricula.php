<!doctype html>

<html>
    <head>
        <title>Matrícula</title>
    </head>
    <body>
        
        <h1>Form Matrícula</h1>

        <form action="confirma.php" method="post">
        
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
            
            <input type="submit" name="siguiente" value="Siguiente">     
            
        </form>
        
    </body>
</html>
