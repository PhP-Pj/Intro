<?php
$quantite = 5;
$additionneur = function($nbr) use($quantite)
{
  return $nbr + $quantite;
};

$listeNbr = [1, 2, 3, 4, 5];

$listeNbr = array_map($additionneur, $listeNbr);
var_dump($listeNbr);
// On a : $listeNbr = [6, 7, 8, 9, 10]

$quantite = 2;

$listeNbr = array_map($additionneur, $listeNbr);
var_dump($listeNbr);
// On a : $listeNbr = [11, 12, 13, 14, 15] au lieu de [10, 11, 12, 13, 14]