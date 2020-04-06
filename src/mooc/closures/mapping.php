<?php

$listeNbr = [1, 2, 3, 4, 5];

$listeNbr = array_map(
    function($nbr) {
        return $nbr + 5;
    }, 
    $listeNbr
);
var_dump($listeNbr);

