<html>
    <head>
        <title>Ejemplo RegExp</title>
    </head>
    <body>

        <form action="" method="post">
            
            DNI: <input type="text" name="DNI"><br> 
            Nombre: <input type="text" name="name"><br>
            Fecha de nacimiento(dd-mm-yyyy): <input type="text" name="birth"><br>
            Email: <input type="email" name="email"><br>
            Edad: <input type="number" name="age"><br>
            <input type="submit" name="send" value="Aceptar"><br>
            
        </form>
        
        <?php
        
        $dni_flag = false; $name_flag = false; $date_flag = false; $email_flag = false; $age_flag = false;
        
        $general_flag = false;

            if (isset($_POST['send'])) {
                
                if (preg_match('/\d{8}[A-Z]/', $_POST['DNI'])) {
                    
                    $dni_flag = true;
                    
                } else {
                    
                    echo "El DNI debe tener 8 números y una letra mayúscula<br>";
                    
                }
                
                if (preg_match('/^[a-z]{1,30}$/i', $_POST['name'])) {
                    
                    $name_flag = true;
                    
                } else {
                    
                    echo "El nombre debe tener entre 1 y 30 letras solamente<br>";
                    
                }
                
                if (preg_match('/^\d{2}(-)\d{2}(-)\d{4}$/', $_POST['birth'])) {
                    
                    // Se valida el formato y luego necesitamos ver que sea correcta
                    
                    // Para ver que es correcta
                    
                    $array = explode("-", $_POST['birth']); // El método explode() devuelve un array
                    
                    if (checkdate($array[1], $array[0], $array[2])) {
                        
                        $date_flag = true;
                        
                    } else {
                        
                        echo "Fecha no válida. Verifica que el día, mes y año sean correctos";
                        
                    }
                    
                } else {
                    
                    echo "El formato debe ser dd-mm-yyyy<br>";
                    
                }
                
                if (preg_match('/^[a-z0-9._+-]+@[a-z0-9._-]+\.(com|org|es)$/i', $_POST['email'])) {
                    
                    $email_flag = true;
                    
                } else {
                    
                    echo "El email está incorrecto, introduce otro con dominio .com, .org o .es<br>";
                    
                }
                
                if (preg_match('/^\d{1,3}$/', $_POST['age']) && $_POST['age'] >= 18) {
                    
                    $age_flag = true;
                    
                } else {
                    
                    echo "Debes ser mayor de 18 años<br>";
                    
                }

                if ($dni_flag == true && $name_flag == true && $date_flag == true && $email_flag == true && $age_flag == true) {
                    
                    $general_flag = true;
                    echo "Los datos introducidos son correctos<br>";
                    
                } else {
                    
                    echo "Los datos introducidos no son correctos<br>";
                    
                }
                
            }
        
        ?>
        
    </body>
</html>
