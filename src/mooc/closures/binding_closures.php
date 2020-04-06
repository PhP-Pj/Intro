<?php
$additionneur = function()
{
  $this->_nbr += 5;
};

class MaClasse
{
  private $_nbr = 0;

  public function nbr()
  {
    return $this->_nbr;
  }
}

$obj = new MaClasse;

$additionneur = $additionneur->bindTo($obj, $obj);
$additionneur();

echo $obj->nbr(); // Affiche bien 5