# Traits

Traits are a mechanism for code reuse in single inheritance, it enables a developer to reuse sets of methods freely in several independent classes living in different class hierarchies.  

A Trait is similar to a class, but only intended to group functionality in a fine-grained and consistent way. It is not possible to instantiate a Trait.

## Basic syntax

The trait is defined with thw keyword trait**.  
A claass acquire the trait with the keyword **use**  

```
<?php
trait MonTrait
{
  public function hello()
  {
    echo 'Hello world !';
  }
}

class A
{
  use MonTrait;
}

class B
{
  use MonTrait;
}

$a = new A;
$a->hello(); // Affiche « Hello world ! ».

$b = new b;
$b->hello(); // Affiche aussi « Hello world ! ».
```

## Using multiple traits

```
<?php
trait HTMLFormater
{
  public function formatHTML($text)
  {
    return '<p>Date : '.date('d/m/Y').'</p>'."\n".
           '<p>'.nl2br($text).'</p>';
  }
}

trait TextFormater
{
  public function formatText($text)
  {
    return 'Date : '.date('d/m/Y')."\n".$text;
  }
}

class Writer
{
  use HTMLFormater, TextFormater;
  
  public function write($text)
  {
    file_put_contents('fichier.txt', $this->formatHTML($text));
  }
}
```

### Prevent conflicts when trait methods have the same name

Example 2 taits deine the the method format. One trite can be priveleged by using the keyword **insteadof**.
```
<?php
class Writer
{
  use HTMLFormater, TextFormater
  {
    HTMLFormater::format insteadof TextFormater;
  }
  
  public function write($text)
  {
    file_put_contents('fichier.txt', $this->format($text));
  }
}
```
## Priority rules:

* if class has a method with the same name has the trait the class method will be used.
* if a class uses a trait defining a method alread implemented in the base class. The method defined in the child call will be used.  

## Traits as attributes

A trait can have some state, and defined attributes. These attrbutes will be imported in the class using it. Attribute can be changed in the trait or in the class.

```
<?php
trait MonTrait
{
  protected $attr = 'Hello !';
  
  public function showAttr()
  {
    echo $this->attr;
  }

  public function traitChangeAtt($attval) {
    $this->attr = $attval;
  }

}

class MaClasse
{
  use MonTrait;

  public function changeAtt($attval) {
    $this->attr = $attval;
  }
}
```

## conflict between attributes

A class anf a trait can't have the same attribute name.

* if the attributein the class with different init value or different visibility **a fatal error is raised**
* if the init value and visibility are the same a **strict error** is raised

## Traits composed of traits

```
<?php
trait A
{
  public function saySomething()
  {
    echo 'Je suis le trait A !';
  }
}

trait B
{
  use A;
  
  public function saySomethingElse()
  {
    echo 'Je suis le trait B !';
  }
}

class MaClasse
{
  use B;
}

$o = new MaClasse;
$o->saySomething(); // Affiche « Je suis le trait A ! »
$o->saySomethingElse(); // Affiche « Je suis le trait B ! »
```

## Name and visibility

A class can change the visibility and/or name of a method defined in a trait with the keyword **as**.

```
<?php
trait A
{
  public function saySomething()
  {
    echo 'Je suis le trait A !';
  }
}

class MaClasse
{
  use A
  {
    saySomething as protected sayWhoYouAre;
  }
}

$o = new MaClasse;
$o->saySomething(); // Affichera « Je suis le trait A ! ».
$o->sayWhoYouAre(); // Lèvera une erreur fatale, car l'alias créé est une méthode protégée.
```

## Abstract traits

Methods of a trait can be abstract forcing the class using them or subclasses of the class to implement them.

```
<?php
trait A
{
  abstract public function saySomething();
}

abstract class Mere
{
  use A;
}

// Jusque-là, aucune erreur n'est levée.

class Fille extends Mere
{
  // Par contre, une erreur fatale est ici levée, car la méthode saySomething() n'a pas été implémentée.
}
```








## Ref:
PHP: https://www.sitepoint.com/php-traits-good-or-bad/
Java: traits https://dzone.com/articles/definition-of-the-trait-pattern-in-java
Python : https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=2&ved=2ahUKEwix5Kzqo87oAhVJzRoKHZsoAMkQFjABegQICxAD&url=ftp%3A%2F%2Fftp.ntua.gr%2Fmirror%2Fpython%2Fpycon%2Fpapers%2Ftraits.html&usg=AOvVaw3zDYONjlk158Mk_15-biaR