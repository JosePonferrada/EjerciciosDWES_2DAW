<html>
    <head>
        <title>Ejemplo RegExp</title>
    </head>
    <body>

        <?php
        
        $dni_flag = false; $name_flag = false; $date_flag = false; $email_flag = false; $age_flag = false;
        
        $general_flag = false;

            if (isset($_POST['send'])) {
                
                if (preg_match('/\d{8}[A-Z]/', $_POST['dni'])) {
                    
                    $dni_flag = true;
                    
                }
                
                if (preg_match('/[a-z]{1,30}/i', $_POST['name'])) {
                    
                    $name_flag = true;
                    
                }
                
                if (preg_match('/\d{2}(-)\d{2}(-)\d{4}/', $_POST['date'])) {
                    
                    // Se valida el formato y luego necesitamos ver que sea correcta
                    
                    $date_flag = true;
                    
                }
                
                if (preg_match('/^\w+(@)[a-z]*(.)(com|es|org)/', $_POST['email'])) {
                    
                    $email_flag = true;
                    
                }
                
                if (preg_match('/\d{1,3}/', $_POST['age'])) {
                    
                    $age_flag = true;
                    
                }
                
            }
        
        ?>
        
        <form action="" method="post">
            
            DNI: <input type="text" name="DNI"><br> 
            Nombre: <input type="text" name="name"><br>
            Fecha de nacimiento: <input type="date" name="birth"><br>
            Email: <input type="email" name="email"><br>
            Edad: <input type="number" name="age"><br>
            <input type="submit" name="send" value="Aceptar"><br>
            
        </form>
        
    </body>
</html>
