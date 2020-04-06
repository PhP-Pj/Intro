# Generator

A means to create iterators, to prevent memory hogging without implementin Iterator interface.

It is created when implementing a function that issues a **yield \<something\>**  
The **function becomes** an object of type **Generator**

#### Note

A generator can't be cloned.

```
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
```

## Generating our own keys

By default PHP generates the keys as a number starting with 0.  
It is possible to generate our own keys with **yield mykey => value**

```
<?php
function generator()
{
  // On retourne ici des chaines de caractères assignées à des clés
  yield 'a' => 'Itération 1';
  yield 'b' => 'Itération 2';
  yield 'c' => 'Itération 3';
  yield 'd' => 'Itération 4';
}

foreach (generator() as $key => $val)
{
  echo $key, ' => ', $val, '<br />';
}
```

## Yielding a reference

One can access a vairable by reference by add **&** in front of the variable.  
A generator would yield a reference when its definition is prefixed with **&** and the value prefixed with **&** before being yielded.

```
<?php
class SomeClass
{
  protected $attr;

  public function __construct()
  {
    $this->attr = ['Un', 'Deux', 'Trois', 'Quatre'];
  }

  // Le & avant le nom du générateur indique que les valeurs retournées sont des références
  public function &generator()
  {
    // On cherche ici à obtenir les références des valeurs du tableau pour les retourner
    foreach ($this->attr as &$val)
    {
      yield $val;
    }
  }

  public function attr()
  {
    return $this->attr;
  }
}

$obj = new SomeClass;

// On parcourt notre générateur en récupérant les entrées par référence
foreach ($obj->generator() as &$val)
{
  // On effectue une opération quelconque sur notre valeur
  $val = strrev($val);
}

echo '<pre>';
var_dump($obj->attr());
echo '</pre>';
```


## Coroutines

We can send data to a generator. The data is recieved when yield is encountered.

```
<?php
function generator()
{
    printf("Entering the generator\n");
    echo yield;
    printf("Leaving the generator\n");
}

$gen = generator();
$gen->send('Hello world !');
```

A generator that accepts data is a **coroutine**

## throw

Just like send one can execute a throw to a generator.  
The throw will start or "wake up" the generator up to the next yield an make the yield throw the exception.

```
<?php
function generator()
{
  echo "Début\n";
  yield;
  echo "Fin";
}

$gen = generator();
$gen->throw(new Exception('Test')); // ouput debut and exception
```

One would surround the yield wit a try catch to deal with the exception
