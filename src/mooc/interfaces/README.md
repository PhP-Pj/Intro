# Interfaces

## Declaration

```
<?php
interface Movable
{
  public function move($dest);
}
```

## implementation

```
<?php
class Personnage implements Movable
{
  public function move($dest)
  {
  
  }
}
```

## constants

```
<?php
interface iInterface
{
  const MA_CONSTANTE = 'Hello !';
}

echo iInterface::MA_CONSTANTE; // Affiche Hello !

class MaClasse implements iInterface
{

}

echo MaClasse::MA_CONSTANTE; // Affiche Hello !
```

## Multi interface implemetation

```
<?php
interface iA
{
  public function test1();
}

interface iB
{
  public function test2();
}

class A implements iA, iB
{
  // Pour ne générer aucune erreur, il va falloir écrire les méthodes de iA et de iB.
  
  public function test1()
  {
  
  }
  
  public function test2()
  {
  
  }
}
```

## Multi interface inheritance

```
<?php
interface iA
{
  public function test1();
}

interface iB extends iA
{
  public function test1 ($param1, $param2); // Erreur fatale : impossible de réécrire cette méthode.
}

interface iC extends iA
{
  public function test2();
}

class MaClasse implements iC
{
  // Pour ne générer aucune erreur, on doit écrire les méthodes de iC et aussi de iA.
  
  public function test1()
  {
  
  }
  
  public function test2()
  {
  
  }
}
```

**As opposed to class multi interface inheritance** is possible.  

```
<?php
interface iA
{
  public function test1();
}

interface iB
{
  public function test2();
}

interface iC extends iA, iB
{
  public function test3();
}
```

## Pe-Defeined interfaces

### Iterator

Makes it possible to redefine the way we can iterate an object.

#### Methods

* current
* key
* next
* rewind
* valid

### SeekableIterator

Inherits from Iterator and add method **seek**

### ArrayAccess

Makes it possible to use [] to access an object.

#### Methods

* offsetExists
* offsetGet
* offsetSet
* offsetUnset

### Countable

Returns number of items

#### Methods

* count

### Example

```
<?php
class MaClasse implements SeekableIterator, ArrayAccess, Countable
{
  private $position = 0;
  private $tableau = ['Premier élément', 'Deuxième élément', 'Troisième élément', 'Quatrième élément', 'Cinquième élément'];
  
  
  /* MÉTHODES DE L'INTERFACE SeekableIterator */
  
  
  /**
   * Retourne l'élément courant du tableau.
   */
  public function current()
  {
    return $this->tableau[$this->position];
  }
  
  /**
   * Retourne la clé actuelle (c'est la même que la position dans notre cas).
   */
  public function key()
  {
    return $this->position;
  }
  
  /**
   * Déplace le curseur vers l'élément suivant.
   */
  public function next()
  {
    $this->position++;
  }
  
  /**
   * Remet la position du curseur à 0.
   */
  public function rewind()
  {
    $this->position = 0;
  }
  
  /**
   * Déplace le curseur interne.
   */
  public function seek($position)
  {
    $anciennePosition = $this->position;
    $this->position = $position;
    
    if (!$this->valid())
    {
      trigger_error('La position spécifiée n\'est pas valide', E_USER_WARNING);
      $this->position = $anciennePosition;
    }
  }
  
  /**
   * Permet de tester si la position actuelle est valide.
   */
  public function valid()
  {
    return isset($this->tableau[$this->position]);
  }
  
  
  /* MÉTHODES DE L'INTERFACE ArrayAccess */
  
  
  /**
   * Vérifie si la clé existe.
   */
  public function offsetExists($key)
  {
    return isset($this->tableau[$key]);
  }
  
  /**
   * Retourne la valeur de la clé demandée.
   * Une notice sera émise si la clé n'existe pas, comme pour les vrais tableaux.
   */
  public function offsetGet($key)
  {
    return $this->tableau[$key];
  }
  
  /**
   * Assigne une valeur à une entrée.
   */
  public function offsetSet($key, $value)
  {
    $this->tableau[$key] = $value;
  }
  
  /**
   * Supprime une entrée et émettra une erreur si elle n'existe pas, comme pour les vrais tableaux.
   */
  public function offsetUnset($key)
  {
    unset($this->tableau[$key]);
  }
  
  
  /* MÉTHODES DE L'INTERFACE Countable */
  
  
  /**
   * Retourne le nombre d'entrées de notre tableau.
   */
  public function count()
  {
    return count($this->tableau);
  }
}

$objet = new MaClasse;

echo 'Parcours de l\'objet...<br />';
foreach ($objet as $key => $value)
{
  echo $key, ' => ', $value, '<br />';
}

echo '<br />Remise du curseur en troisième position...<br />';
$objet->seek(2);
echo 'Élément courant : ', $objet->current(), '<br />';

echo '<br />Affichage du troisième élément : ', $objet[2], '<br />';
echo 'Modification du troisième élément... ';
$objet[2] = 'Hello world !';
echo 'Nouvelle valeur : ', $objet[2], '<br /><br />';

echo 'Actuellement, mon tableau comporte ', count($objet), ' entrées<br /><br />';

echo 'Destruction du quatrième élément...<br />';
unset($objet[3]);

if (isset($objet[3]))
{
  echo '$objet[3] existe toujours... Bizarre...';
}
else
{
  echo 'Tout se passe bien, $objet[3] n\'existe plus !';
}

echo '<br /><br />Maintenant, il n\'en comporte plus que ', count($objet), ' !';
```

### Note

 The ArrayIterator class implements these four interfaces.