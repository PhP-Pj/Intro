<?php
// require ('personnage_manager.php');

function classLoader($classname)
{
  require $classname.'.php';
}

spl_autoload_register('classLoader');

$perso = new Personnage([
  'nom' => 'Victorine',
  'forcePerso' => 5,
  'degats' => 10,
  'niveau' => 1,
  'experience' => 10
]);

$db = new PDO('mysql:host=localhost;dbname=personnageDB', 'personnageDBUser', 'personnage_pwd');
$manager = new PersonnagesManager($db);
    
$manager->add($perso);
