<?php
class MaClasse
{
  private $attributs = [];
  private $unAttributPrive;
  
  public function __set($nom, $valeur)
  {
    $this->attributs[$nom] = $valeur;
  }
  
  public function __get($nom)
  {
    if (isset($this->attributs[$nom]))
    {
      return $this->attributs[$nom];
    }
  }
  
  public function __isset($nom)
  {
    return isset($this->attributs[$nom]);
  }
}

$obj = new MaClasse;

$obj->attribut = 'Simple test';
$obj->unAttributPrive = 'Autre simple test';

if (isset($obj->attribut))
{
  echo 'L\'attribut <strong>attribut</strong> existe !<br />';
}
else
{
  echo 'L\'attribut <strong>attribut</strong> n\'existe pas !<br />';
}

if (isset($obj->unAutreAttribut)) // no it's not unAttributPrive
{
  echo 'L\'attribut <strong>unAutreAttribut</strong> existe !';
}
else
{
  echo 'L\'attribut <strong>unAutreAttribut</strong> n\'existe pas !';
}