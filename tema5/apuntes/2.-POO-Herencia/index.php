<?php

require_once './class/persona.php';
require_once './class/empleado.php';

// Creating a new Persona
$p = new Persona("Manolo", "Gomez", 22);

// We can create a Persona declaring just the params we want and the rest will be default

// If we want to change the age and show the new age
//$p->setEdad(45);
//echo $p->getEdad();

// To access a private param we can use a magic method
echo "<br>".$p->nombre." ".$p->apellidos." ".$p->edad."<br>";

// To asign a new value to a private param
$p->nombre = "Anastasio";
echo "<br>".$p->nombre." ".$p->apellidos." ".$p->edad."<br>";

// Showing the object
echo "Soy p: ".$p."<br>";

// To access the counter value, we can't just call the object, we must call the class due to it's private
echo "Número de personas: ".Persona::getCounter()."<br>";

// Creating a new Persona
$p2 = new Persona();
echo "Número de personas: ".Persona::getCounter()."<br>";

$p3 = new Persona();
echo "Número de personas: ".Persona::getCounter()."<br>";

// Here we remove the instance but the param counter is not lowering 
// if we don't have a destruct method with the code inside of it to do so 
unset($p3);
echo "Número de personas: ".Persona::getCounter()."<br>";

Persona::removePersona();
echo "Número de personas: ".Persona::getCounter()."<br>";

// $persona is an object
function modAge (Persona $persona) {
    $persona->edad = 100;
}

modAge($p);
echo $p."<br>";
// By doing so, the object will be modified because we're using the object as reference

// We gonna code an object to JSON
$p_encode = json_encode($p);
var_dump($p_encode);
$p->sumAge(5);
echo "<br>";
var_dump($p);

$p_encode = json_encode($p);
$p_decode = json_decode($p_encode);
echo "<br>";
var_dump($p_decode); // $p_decode is NOT an object from Persona class
// $p_decode->sumAge(5); // Will show an error

// To make it works
$newp = new Persona($p_decode->nombre, $p_decode->apellidos, $p_decode->edad);
echo "<br>";
var_dump($newp);
$newp->sumAge(5);
echo "<br>";
echo $newp;
echo "<br>";

// When encoding an object to JSON, it just encodes the attributes
// If the attrs are private or static it wont encode any attr


echo "========================= COPYING OBJECTS ==========================";

$p4 = $p;
echo "<br>";
echo "Soy p: ".$p;
echo "<br>";
echo "Soy p4: ".$p4;
echo "<br><br>";
$p4->nombre = "María";
echo "Soy p: ".$p;
echo "<br>";
echo "Soy p4: ".$p4;
echo "<br><br>";

// When using "=" operator with objects, it shares the same memory 
// slot, so modifications will affect both of them

// To duplicate an object we MUST use clone()
// When cloning an object we can use the magic method __clone and do more things
$p4 = clone($p);
//$p4->nombre = "Sofía";
echo "Soy p: ".$p;
echo "<br>";
echo "Soy p4: ".$p4;
echo "<br><br>";

// The == operator while comparing an object returns true if both objects have the same attribute values
// The === operator returns true if compared objects are sharing the same memory spot

if ($p == $p4) {
    echo "Son iguales<br>";
} else {
    echo "Son diferentes<br>";
}

$p5 = $p4; // Sharing the same memory spot

if ($p5 === $p4) {
    echo "Son iguales<br>";
} else {
    echo "Son diferentes<br>";
}

echo "<br>================= Overloading methods =================<br><br>";

// That's how we can overload a method
$p4->modify("Pepe");
echo $p4."<br>";
$p4->modify("Ramón", "Hernández");
echo $p4."<br>";
$p4->modify("Pepe", "Guzmán", 26);
echo $p4."<br>";

echo "<br>=================  =================<br><br>";

$emp = new Empleado("Paco", "Campos", 50, 1800);
echo "Soy ".$emp->nombre." y cobro ".$emp->salario;

// To access to $emp->nombre we are not using the magic method cause it is public
// And magic methods are not 



?>