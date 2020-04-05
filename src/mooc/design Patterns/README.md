# Design Patterns

## Factory

## Observer

### SplSubject & SplObserver interfaces

**SplSubject** is implemented by the class of the observed object

#### The methods

* attach(SplObserver $observer) to add an observer
* detach(SplObserver $observer) to remove an obeserver
* notify()  to notify the observers of an event on the observered object.

**SplObserver** is implemented by the classes of the observer objects.

### Methods

* update(SplSubject $subject) called by notify.

## Anonymous classes

```
<?php
$monObjet = new class[$constructor_arg]
{
  [public function __construct__($constructor_arg) {}]

  public function sayHello()
  {
    echo 'Hello world!';
  }
};

$monObjet->sayHello();
```

## Strategy

similar to code injection where the inject object is used by the object being injected to do a particalur task the injected object knows how to do.

## Singleton

```
<?php
class MonSingleton
{
  protected static $instance; // Contiendra l'instance de notre classe.
  
  protected function __construct() { } // Prevent instanciation. 
  protected function __clone() { } // prevent cloning.
  
  public static function getInstance()
  {
    if (!isset(self::$instance)) // Si on n'a pas encore instancié notre classe.
    {
      self::$instance = new self; // On s'instancie nous-mêmes. :)
    }
    
    return self::$instance;
  }
}
```

## dependency injection

Thru interfaces implementation.


