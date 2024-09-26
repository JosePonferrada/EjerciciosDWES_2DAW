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
        // phpinfo();
        // echo "Bienvenido al curso de DWES";
        # Se puede usar echo o print
        
        $a = 5;
        echo getType($a);
        
        
        $a = "Pepe";
        echo "<br>".gettype($a);
        // Concatenamos el salto de línea con lo que queremos mostrar
        
        echo '<br>El valor de la variable es: $a';
        echo "<br>El valor de la variable es: $a";
        
        // Las comillas dobles detectan el valor de una variable mientras que las simples no.
        // Si colocamos una "\" (secuencia de escape) nos sirve para que no expanda una variable y busque su valor.
        
        echo "<br>El valor de la variable es: \"$a\"";

        
        echo "<br> =========================== <br>";
        
        echo "Hoy es: ".date("l, d - F - Y - H:i:s");
        echo "<br>".time();
        echo "<br>". mktime(8,30,0,9,21,2024);
        
        echo "<br>=========================<br>";
        echo $_SERVER['PHP_SELF'];
        echo "<br>=========================<br>";
        
        // Ejercicio prueba fecha Haz una página web que muestre la fecha actual en castellano, 
        // incluyendo el día de la
        // semana, con un formato similar al siguiente: "Miércoles, 13 de Abril de 2011". 
        echo "<br>=========================<br>";
        // echo date("l, d \de F \de Y");
        echo "<br>=========================<br>";
        echo date_default_timezone_set("Europe/Madrid");
        echo "<br>=========================<br>";
        
        $day = date("w");
        
        switch ($day) {
            case 0:
                $day = "Domingo";
                break;
            case 1:
                $day = "Lunes";
                break;
            case 2:
                $day = "Martes";
                break;
            case 3:
                $day = "Miércoles";
                break;
            case 4:
                $day = "Jueves";
                break;
            case 5:
                $day = "Viernes";
                break;
            case 6:
                $day = "Sábado";
                break;
            default:
                break;
        }
        
        $month = date("n");
        
        switch ($month){
            case 1:
                $month = "Enero";
                break;
            case 2:
                $month = "Febrero";
                break;
            case 3:
                $month = "Marzo";
                break;
            case 4:
                $month = "Abril";
                break;
            case 5:
                $month = "Mayo";
                break;
            case 6:
                $month = "Junio";
                break;
            case 7:
                $month = "Julio";
                break;
            case 8:
                $month = "Agosto";
                break;
            case 9:
                $month = "Septiembre";
                break;
            case 10:
                $month = "Octubre";
                break;
            case 11:
                $month = "Noviembre";
                break;
            case 12:
                $month = "Diciembre";
                break;
        }
        
        echo "Hoy es ".$day.", ".date("d")." de ".$month." de ".date("Y");
        
        ?>
         
   </body>
</html>
