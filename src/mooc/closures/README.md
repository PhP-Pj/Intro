# Closures (lambda in python?)

A closure in php in an anonymous function. It object which class is Closure.

```
<?php
$maFonction = function()
{
  echo 'Hello world !';
};

var_dump($maFonction); // ouput: Closure.
```

**Closure class** get the magic methode **__invoke** so it is possible to call the object function like a function.

```
$maFonction();  // ouput: Hello World
```

## Use case

**array_map** which can map items of an array according to a function passed as a parameter.

```
<?php
// Notre fonction accepte 1 argument : le nombre actuellement traité par array_map
$additionneur = function($nbr)
{
  return $nbr + 5;
};

$listeNbr = [1, 2, 3, 4, 5];

$listeNbr = array_map($additionneur, $listeNbr);
// Nous obtenons alors le tableau [6, 7, 8, 9, 10]
```

## Passing parameters to the closure

### using a variable defined outside the function

A closure can import a variable outside its definition with the keyword **use($a_vairable)**

```
<?php
$quantite = 5;
$additionneur = function($nbr) use($quantite)
{
  return $nbr + $quantite;
};

$listeNbr = [1, 2, 3, 4, 5];

$listeNbr = array_map($additionneur, $listeNbr);

var_dump($listeNbr);
// On obtient là aussi le tableau [6, 7, 8, 9, 10]
```

Problem the value of **$quantite** is fixed at first use. So even if we assigne a new value to **$quantite = 10**, inside the closure it would still be 5.

### returning anonymous function

The principle if to cretae a function that take the an argument used as a parameter in the anonymous function and returns this anonymous function.

```
<?php
function creerAdditionneur($quantite)
{
  return function($nbr) use($quantite)
  {
    return $nbr + $quantite;
  };
}

$listeNbr = [1, 2, 3, 4, 5];

$listeNbr = array_map(creerAdditionneur(5), $listeNbr);
var_dump($listeNbr);
// On a : $listeNbr = [6, 7, 8, 9, 10]

$listeNbr = array_map(creerAdditionneur(4), $listeNbr);
var_dump($listeNbr);
// Cette fois-ci, on a bien : $listeNbr = [10, 11, 12, 13, 14]
```

## Binding a closure

### Binding a closure to an object

It is possible to bind a closure to an object. In this case the closure will have access to all attributes and methods of the object.

#### Closure::bindTo

```
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

$additionneur = $additionneur->bindTo($obj, 'MaClasse' or $obj);
$additionneur();

echo $obj->nbr(); // output: 5
```

#### Closure::call for temporary bindings

```
<?php

class Nombre
{
  private $_nbr;
  
  public function __construct($nbr)
  {
    $this->_nbr = $nbr;
  }
}

$closure = function() {
  var_dump($this->_nbr + 5);
};

$two = new Nombre(2);
$three = new Nombre(3);

$closure->call($two);
$closure->call($three);
```

### Binding a closure to a class

Binding a closure to a class enables us to operate on the **static attributes** of the class.

```
<?php
$additionneur = function()
{
  self::$_nbr += 5;
};

class MaClasse
{
  private static $_nbr = 0;

  public static function nbr()
  {
    return self::$_nbr;
  }
}

$additionneur = $additionneur->bindTo(null, 'MaClasse');
$additionneur();

echo MaClasse::nbr();  // output: 5
```

#### Note

To restrict the closure to a class define it as ststic.

### Automatic binding

A closure defined inside a method will get the context of the method and will automaticlly be bound to the object and have access to all attributes of the object.

```
<?php
class MaClasse
{
  private $_nbr = 0;

  public function getAdditionneur()
  {
    return function()
    {
      $this->_nbr += 5;
    };
  }

  public function nbr()
  {
    return $this->_nbr;
  }
}

$obj = new MaClasse;

$additionneur = $obj->getAdditionneur();
$additionneur();

echo $obj->nbr();  // output: 5
```

## Implementing Observer pattern with closures

```
<?php
class Observed implements SplSubject
{
  protected $name;
  protected $observers = [];

  public function attach(SplObserver $observer)
  {
    $this->observers[] = $observer;
    return $this;
  }

  public function detach(SplObserver $observer)
  {
    if (is_int($key = array_search($observer, $this->observers, true)))
    {
	  unset($this->observers[$key]);
	}
  }

  public function notify()
  {
    foreach ($this->observers as $observer)
    {
      $observer->update($this);
    }
  }

  public function name()
  {
  	return $this->name;
  }

  public function setName($name)
  {
  	$this->name = $name;
  	$this->notify();
  }
}

class Observer implements SplObserver
{
  protected $name;
  protected $closure;

  public function __construct(Closure $closure, $name)
  {
    // On lie la closure à l'objet actuel et on lui spécifie le contexte à utiliser
    // (Ici, il s'agit du même contexte que $this)
    $this->closure = $closure->bindTo($this, $this);
    $this->name = $name;
  }

  public function update(SplSubject $subject)
  {
    // En cas de notification, on récupère la closure et on l'appelle
    $closure = $this->closure;
    $closure($subject);
  }
}

$o = new Observed;

$observer1 = function(SplSubject $subject)
{
  echo $this->name, ' a été notifié ! Nouvelle valeur de name : ', $subject->name(), "\n";
};

$observer2 = function(SplSubject $subject)
{
  echo $this->name, ' a été notifié ! Nouvelle valeur de name : ', $subject->name(), "\n";
};

$o->attach(new Observer($observer1, 'Observer1'))
  ->attach(new Observer($observer2, 'Observer2'));

$o->setName('Victor');
// Output :
// Observer1 a été notifié ! Nouvelle valeur de name : Victor
// Observer2 a été notifié ! Nouvelle valeur de name : Victor
```
