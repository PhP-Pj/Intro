<?php
function generator()
{
    printf("Entering the generator\n");
    $recieved = (yield 'Welcome!');
    printf("Gen received %s\n", $recieved);
    printf("Leaving the generator\n");
    return "stuff";
}

$gen = generator();
$y = $gen->current(); // advance to the yield and get yilded value
printf("Gen yielded %s \n", $y);  // output: welcome
printf("Check if gen is not terminated: %b\n", $gen->valid());
printf("Sending to gen\n");
$got = $gen->send('Hello world !'); // sends to yield and wakeup the gen from yield
printf("Gen return from gen: %s \n", $gen->getReturn()); 
printf("Check if gen is not terminated: %b\n", $gen->valid());

//https://openclassrooms.com/en/courses/1665806-programmez-en-oriente-objet-en-php/2650041-les-generateurs
$gen = generator();
$rc = $gen->send("Should yield as well but it doen't\n");
printf("%s\n", $rc);
