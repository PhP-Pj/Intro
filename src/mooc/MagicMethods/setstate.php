<?php
class Export
{
  protected $chaine1, $chaine2;
  
  public function __construct($param1, $param2)
  {
    $this->chaine1 = $param1;
    $this->chaine2 = $param2;
  }
  
  public function __set_state($valeurs) // Liste des attributs de l'objet en paramètre.
  {
    $obj = new Export($valeurs['chaine1'], $valeurs['chaine2']); // On crée un objet avec les attributs de l'objet que l'on veut exporter.
    return $obj; // on retourne l'objet créé.
  }
}

$obj1 = new Export('Hello ', 'world !');

eval('$obj2 = ' . var_export($obj1, true) . ';'); // On crée un autre objet, celui-ci ayant les mêmes attributs que l'objet précédent.

echo '<pre>', print_r($obj2, true), '</pre>';