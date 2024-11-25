<?php

require_once 'persona.php';

class Empleado extends Persona {
    private $salario;
    
    public function __construct($name = "Antonio", $surname = "Perez", $age = 52, $salary = 1000) {
        parent::__construct($name, $surname, $age);
        $this->salario = $salary;
    }
    
    // A magic method that does the function of a getter
    // $name here means the name of the param we want to access not the name of some1
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    // A magic method that does the function of a setter
    // $name here means the name of the param we want to access not the name of some1
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }
    
    // Magic method toString can be also overloaded
    public function __toString(): string {
        return parent::__toString().", mi salario es de: ".$this->salario;
    }
    
}

?>