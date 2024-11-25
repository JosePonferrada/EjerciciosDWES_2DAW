<?php

require_once './class/Animal.php';
require_once './class/Mamifero.php';
require_once './class/Ave.php';
require_once './class/Gato.php';
require_once './class/Perro.php';
require_once './class/Pinguino.php';
require_once './class/Canario.php';
require_once './class/Lagarto.php';

$animal = new Animal("Paquito", 4, 3, 16);

echo "<br>============Animal==============<br>";

echo $animal."<br>";
$animal->come();
echo "<br>";

echo "<br>============Mamífero==============<br>";

$mamifero = new Mamifero("Pepito", 4, 4, 15, "macho");

echo $mamifero;
echo "<br>";
$mamifero->camina();
echo "<br>";
$mamifero->duerme();
echo "<br>";
$mamifero->come();
echo "<br>";

echo "<br>============Ave==============<br>";

$ave = new Ave("Pepi", 2, 3, 10, "grande", "grandes");
echo $ave;
echo "<br>";
$ave->alimentar();
echo "<br>";
$ave->escapar();
echo "<br>";
$ave->volar();
echo "<br>";
$ave->come();

echo "<br>============Gato==============<br>";

$gato = new Gato("Gato con botas", 4, 6, 18, "hembra", "pequeña");

echo $gato;
echo "<br>";
$gato->maullar();
echo "<br>";
$gato->subirArbol();
echo "<br>";
$gato->colarse();
echo "<br>";
$gato->camina();
echo "<br>";
$gato->duerme();
echo "<br>";
$gato->come();
echo "<br>";

echo "<br>============Perro==============<br>";

$perro = new Perro("Scooby", 4, 7, 17, "macho", "marrón");

echo $perro;
echo "<br>";
$perro->ladrar();
echo "<br>";
$perro->camina();
echo "<br>";
$perro->duerme();
echo "<br>";
$perro->come();
echo "<br>";

echo "<br>============Canario==============<br>";

echo "<br>============Pingüino==============<br>";

echo "<br>============Lagarto==============<br>";

?>