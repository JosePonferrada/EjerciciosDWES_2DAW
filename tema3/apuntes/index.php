<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        // Creamos una conexión
        // $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");

        // Alternativa
        // $conex = new mysqli("localhost", "dwes", "abc123.");
        // $conex -> select_db("empleados");

        // Con la manera alternativa, mantenemos las conexiones de las BBDDs abiertas
        // Es decir, con el select_db podemos acceder a varias BBDDs con esa misma conexión

        // Devuelve la versión de MySQL Server
        // echo $conex -> server_info;

        // Muestra errores producidos en la BBDD
        // echo $conex -> connect_errno." - ".$conex -> connect_error;

        // Para OCULTAR errores usaremos error_reporting()
        // error_reporting(0);
        // Esto dará un error porque no existe la BBDD
        // $conex2 = new mysqli("localhost", "dwes", "abc123.", "empleados2");

        // $driver = new mysqli_driver();
        // $driver -> report_mode = MYSQLI_REPORT_ERROR;
        
            if (isset($_POST['insertar'])) {
                
                // Para atrapar los errores usamos un try-catch

                try {
                    $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");

                    // Es recomendable que al hacer la conexión, le digamos que codificación de caracteres usaremos
                    $conex -> set_charset("utf8mb4");
                    
                    $conex -> autocommit(false); // Con esto desactivamos el autocommit

                    // echo "Hola";
                } catch (Exception $ex) {
                    die($ex -> getMessage()); // die() mata la ejecución

                    // Personalizamos el mensaje de error
                    if ($ex -> getCode() == 1045) die("Error en las credenciales de acceso");
                    if ($ex -> getCode() == 1049) die("Error en el nombre de la BBDD");
                    echo $ex -> getCode();
                }

                // ===================================================

                // Para realizar consultas en la BBDD usaremos la función query()
                // Dependiendo de si la consulta devuelve datos o no, se usará de manera diferente
                // Si devuelve datos, devolverá un objeto mysqli_result en el que estarán todos los datos

                // ===================================================

                try {

                    // Ejemplo de los que no devuelven resultado

                    if ($conex -> query("insert into marketing(dni, nombre, apellidos, salario) values "
                            . "('$_POST[dni]', '$_POST[nombre]', '$_POST[apellidos]', $_POST[salario])")) {
                    // Esa query, devolverá un true o false dependiendo de si hay error o no
                    // Si se inserta correctamente mostramos un mensaje
                    echo "Registro insertado correctamente - ".$conex->affected_rows;

                    }
                    // Actualizamos el registro 
                    $conex ->query("update marketing set salario = 3000 where dni = '11111111A'");
                    echo "<br>Update: ".$conex->affected_rows."<br>";

                    $conex -> query("delete from marketing where salario > 2000");
                    echo "<br>Borrado: ".$conex->affected_rows."<br>";

                    // Si no da ningún error hacemos el commit
                    $conex -> commit();
                    
                } catch (Exception $exc) {
                    if ($exc -> getCode() == 1062) echo "Ya existe un registro con ese DNI <br>";
                    
                    // echo $exc -> getCode()." - ".$exc -> getMessage();
                    
                    $conex -> rollback(); // En caso de tener un error hacemos un rollback
                    echo "ERROR";
                }
                
                // Antes de cerrar la conexión dejamos el autocommit como en un principio
                $conex -> autocommit(true);
                
                // Cerramos la conexión manualmente, aunque se cierra auto al finalizar el script
                $conex -> close(); 
                
            }
            
                    
        ?>
        
        <!-- Ahora vamos a recoger los datos mediante un formulario -->
        
        <form action="" method="post">
            
            DNI: <input type="text" name="dni"><br>
            Nombre: <input type="text" name="nombre"><br>
            Apellidos: <input type="text" name="apellidos"><br>
            Salario: <input type="text" name="salario"><br>
            
            <input type="submit" name="insertar" value="Insertar">
            
        </form>
        

        
    </body>
</html>
