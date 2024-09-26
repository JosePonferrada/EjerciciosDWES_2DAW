<!doctype html>

<html>
    <head>
        <title>title</title>
    </head>
    <body>
        <?php
            
            require_once 'funciones.php';
            include_once 'cabecera.php';
            
        ?>
        
        Aquí estaría el contenido de mi web. <br>
        
        <?php
            
            $sal = 1000;
            $ret = 2;
            $com = 100;
            
            echo "El salario bruto es: ".salario_bruto($sal, $ret, $com)."<br>";
            echo "El salario es: ".$sal."<br>";
            
            
            salario_bruto2($ret, $com);
            echo "El salario es: ".$sal."<br>";
            echo "Las retenciones son: ".$ret."<br>";
        
            echo "El salario bruto es: ". salario_bruto3($sal, $ret, $com)."<br>";
            echo "El salario es: ".$sal."<br>";
            echo "Las retenciones son: ".$ret;
            
        ?>
        
    </body>
</html>
