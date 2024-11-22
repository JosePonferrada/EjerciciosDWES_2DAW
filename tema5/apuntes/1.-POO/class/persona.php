<?php

class Persona {
    public $nombre;
    public $apellidos;
    public $edad;
    public static $counter=0;
    
    // To call a magic method like constructor, we start with __
    // We can overload a method assigning default values on constructor

    public function __construct($name="Antonio", $surname="Perez", $age=52) {
        $this->nombre=$name;
        $this->apellidos=$surname;
        $this->edad=$age;
        self::$counter++;
    }
    
    // A magic method to do something when removing an instance
    // This function is executed when using unset()
    public function __destruct() {
        self::$counter--;
    }
    
//    public function __clone(): void {
//        self::$counter++;
//        
//    }
    
    // We can overload a method by using the magic method:
    // $method will be the method name and the args will be the params needed to that method
    public function __call(string $method, array $arguments): void {
        // If the method is not found in the class
        if ($method == "modify") {
            if (count($arguments) == 1) { // If we send just an argument it will mod the name
                $this->nombre = $arguments[0];
            }
            if (count($arguments) == 2) { // If we send just an argument it will mod the name
                $this->nombre = $arguments[0];
                $this->apellidos = $arguments[1];
            }
            if (count($arguments) == 3) { // If we send just an argument it will mod the name
                $this->nombre = $arguments[0];
                $this->apellidos = $arguments[1];
                $this->edad = $arguments[2];            
            }
        }
    }    
        
    // A method to access the counter
    public static function getCounter() {
        return self::$counter;
    }
    
    // A method to lower the counter (Static ==> to access via class)
    public static function removePersona() {
        self::$counter--;
    }
    
    public function sumAge($years) {
        $this->edad += $years;
    }
    
    // These methods replace all the getters & setters
    
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
    
    // Another magic method is toString
    // When we use echo ${object} it will show the return msg
    public function __toString(): string {
        return "Hola, me llamo " . $this->nombre
                . " " . $this->apellidos. " y tengo " . $this->edad. " años";
    }
        
}

?>