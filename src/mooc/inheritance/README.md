# Inheritance

## keyword extends

Only single inheritance

```
<?php
class Personnage // Création d'une classe simple.
{

}

class Magicien extends Personnage // Notre classe Magicien hérite des attributs et méthodes de Personnage.
{

}
?>
```

### Overriding

Access to parent class thru keyword: **parent::**  
Ex: method gagnerExperience

```
class Magicien extends Personnage
{
  private $_magie; // Indique la puissance du magicien sur 100, sa capacité à produire de la magie.
  
  public function lancerUnSort($perso)
  {
    $perso->recevoirDegats($this->_magie); // On va dire que la magie du magicien représente sa force.
  }
  
  public function gagnerExperience()
  {
    // On appelle la méthode gagnerExperience() de la classe parente
    parent::gagnerExperience();
    
    if ($this->_magie < 100)
    {
      $this->_magie += 10;
    }
  }
}
```

### Visibility protected

Children can gain access to **protected** atributes or methods other than that protected is just like **private**.


### Abstract class

Can't be instanciated.  
Impose an interface.  

```
<?php
abstract class Personnage // Notre classe Personnage est abstraite.
{

}

class Magicien extends Personnage // Création d'une classe Magicien héritant de la classe Personnage.
{

}

$magicien = new Magicien; // Tout va bien, la classe Magicien n'est pas abstraite.
$perso = new Personnage; // Erreur fatale car on instancie une classe abstraite.
```

### Absrtact methods

They have to be defined in the child class.  
If a class defines an **abstract method** it has to be **abstract itself**.  

```
<?php
abstract class Personnage
{
  // On va forcer toute classe fille à écrire cette méthode car chaque personnage frappe différemment.
  abstract public function frapper(Personnage $perso);
  
  // Cette méthode n'aura pas besoin d'être réécrite.
  public function recevoirDegats()
  {
    // Instructions.
  }
}

class Magicien extends Personnage
{
  // On écrit la méthode « frapper » du même type de visibilité que la méthode abstraite « frapper » de la classe mère.
  public function frapper(Personnage $perso)
  {
    // Instructions.
  }
}
```

### final class

A final class can not be inherited.
```
<?php
// Classe abstraite servant de modèle.

abstract class Personnage
{

}

// Classe finale, on ne pourra créer de classe héritant de Guerrier.

final class Guerrier extends Personnage
{

}

// Erreur fatale, car notre classe hérite d'une classe finale.

class GentilGuerrier extends Guerrier
{

}
```

### final method

A final method can not be overriden by a child class.


### Static on the fly

**self** is used call static method or access static attributes.  

**self** applies to the current class so if a child class override a static method,
calling an inherited client method from the child class calling the static overriden method will actually
call the parent static method.  

```
<?php
class Mere
{
  public static function lancerLeTest()
  {
    self::quiEstCe();
  }
  
  public function quiEstCe()
  {
    echo 'Je suis la classe <strong>Mere</strong> !';
  }
}

class Enfant extends Mere
{
  public static function quiEstCe()
  {
    echo 'Je suis la classe <strong>Enfant</strong> !';
  }
}

Enfant::lancerLeTest();  // ouput mere
```

For the overriden method in the child to be called **self** has to be replaced with **static** the the parent client method.

```
<?php
class Mere
{
  public static function lancerLeTest()
  {
    static::quiEstCe();
  }
  
  public function quiEstCe()
  {
    echo 'Je suis la classe <strong>Mere</strong> !';
  }
}

class Enfant extends Mere
{
  public static function quiEstCe()
  {
    echo 'Je suis la classe <strong>Enfant</strong> !';
  }
}

Enfant::lancerLeTest();  // ouput Enfant
```

The **same applies for non static method!**

```
<?php
class Mere
{
  public function lancerLeTest()
  {
    static::quiEstCe();
  }
  
  public function quiEstCe()
  {
    echo 'Je suis la classe « Mere » !';
  }
}

class Enfant extends Mere
{
  public function quiEstCe()
  {
    echo 'Je suis la classe « Enfant » !';
  }
}

$e = new Enfant;
$e->lancerLeTest();
```
