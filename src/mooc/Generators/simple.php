<?php
function myGen() {
    $ar = ['un',2,'three'];
    printf("Entering the generator\n");

    foreach ($ar as $it) {
        yield $it;
    }
    printf("Leaving the generator, I am done\n");
}
$gen = myGen();

var_dump($gen); // output: class Generator

foreach ($gen as $item) {
    printf("Item = %s\n", $item);
}