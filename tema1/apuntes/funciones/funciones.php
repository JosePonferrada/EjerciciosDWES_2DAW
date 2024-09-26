<?php

    /**
     * 
     * @param type $salario
     * @param type $retenciones
     * @param type $comision
     * @return type
     * Si le ponemos los valores al crear la función, se asignarán esos valores por defecto y
     * al llamar a la función no será necesario usar todas las variables.
     * Si queremos asignar un valor por defecto lo colocamos siempre al final.
     */
    function salario_bruto ($salario, $retenciones, $comision){
        $salario += $comision;
        
        $retenciones = $salario * ($retenciones / 100);
        $salarioBruto = $salario - $retenciones;
        return $salarioBruto;
        
    }
    
    function salario_bruto2 ($retenciones, $comision, $salario = 2000){
        $salario += $comision;
        
        $retenciones = $salario * ($retenciones / 100);
        $salarioBruto = $salario - $retenciones;
        return $salarioBruto;
        
    }
    
    /**
     * 
     * @param type $salario
     * @param type $retenciones
     * @param type $comision
     * @return type
     * Con el "&" delante de la variable lo que hacemos es pasar el valor por referencia.
     * Con esto podremos acceder a esos valores al llamar a la función.
     */
    function salario_bruto3 (&$salario, &$retenciones, &$comision){
        $salario += $comision;
        
        $retenciones = $salario * ($retenciones / 100);
        $salarioBruto = $salario - $retenciones;
        
    }

?>