<?php
// https://openclassrooms.com/en/courses/1665806-programmez-en-oriente-objet-en-php/1667552-lapi-de-reflexivite
require 'addendum/annotations.php';
require 'MyAnnotations.php';
require 'AnnotedClasses.php';

$reflectedClass = new ReflectionAnnotatedClass('Personnage');
echo 'La valeur de l\'annotation <strong>Table</strong> est <strong>', 
$reflectedClass->getAnnotation('Table')->value, '</strong>\n';

$reflectedClass2 = new ReflectionAnnotatedClass('Annimal');
echo 'La valeur de l\'annotation <strong>Type</strong> est <strong>';
print_r($reflectedClass2->getAnnotation('Type')->value);


$reflectedClass2 = new ReflectionAnnotatedClass('Puppet');
echo 'La valeur de l\'annotation <strong>Type</strong> est <strong>';
print_r($reflectedClass2->getAnnotation('Type')->value);

$reflectedClass2 = new ReflectionAnnotatedClass('Wallet');
$infos = $reflectedClass2->getAnnotation('Portfolio');
printf("share: %s & price = %s\n", $infos->share, $infos->price);

try {
    $reflectedClass2 = new ReflectionAnnotatedClass('Swap');
    $infos = $reflectedClass2->getAnnotation('Portfolio');
    if ($infos) {
        printf("share: %s & price = %s\n", $infos->share, $infos->price);
        }
    }
catch (Exception $e) {
    printf("Oops there is a little problem: %s\n", $e->getMessage());
}
finally {
    printf("The exception will never happen!! Sorry bug in Annotation!!\n");
}

printf("\nWorking on Transaction\n");
$transaction = new ReflectionAnnotatedClass('Transaction');
$infos = $transaction->getAnnotation('Portfolio');
printf("\nTransaction\n");
printf("share: %s & price = %s\n", $infos->share, $infos->price);
printf("Type of transsaction: %s\n", $transaction->getAnnotation('Type')->value);
$reflectedAttr = new ReflectionAnnotatedProperty('Transaction', 'swap');
printf("Type of attibute: %s\n", $reflectedAttr->getAnnotation('Type')->value);
$reflectedMethod = new ReflectionAnnotatedMethod('Transaction', 'doit');
printf("Type of method: %s\n", $reflectedMethod->getAnnotation('Type')->value);