<?php

class Empleado {
    private $email;
    private $pass;
    private $nombre;
    private $salario;
    private $departamento;
    
    public function __construct($email, $pass, $nombre, $salario, $departamento) {
        $this->email = $email;
        $this->pass = $pass;
        $this->nombre = $nombre;
        $this->salario = $salario;
        $this->departamento = $departamento;
    }
    
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
    public function __toString(): string {
        return "Soy el empleado " . $this->nombre
                . " con email: " . $this->email
                . ", salario: " . $this->salario
                . " y del departamento: " . $this->departamento;
    }
    
    
    
}

?>