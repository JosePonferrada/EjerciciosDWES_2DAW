<!doctype html>

<html>
    <head>
        <title>Ejercicio 08</title>
    </head>
    <body>  
            
        <?php

            $a = 15;
            $b = 7;
            $c = 12;
            
            if ($a >= $b && $a >= $c) {
            
                if ($b >= $c) {
                
                    echo "$a, $b, $c";
                                    
                } else {
                    
                    echo "$a, $c, $b";
                }
                
            } elseif ($b >= $a && $b >= $c) {
                
                if ($a >= $c) {
                
                    echo "$b, $a, $c";
                    
                } else {
                
                    echo "$b, $c, $a";
                }
                
            } else {
                
                if ($a >= $b) {
                
                    echo "$c, $a, $b";
                    
                } else {
                    
                    echo "$c, $b, $a";
                }
            }

        ?>
        
    </body>
</html>
