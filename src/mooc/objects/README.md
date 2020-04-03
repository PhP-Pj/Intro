## Objects

* A variable contains a reference of an object.

* To copy an object use the **clone operator**

```
<?php
$copie = clone $origine; // On copie le contenu de l'objet $origine dans l'objet $copie.
```

* Comparison
 * **==** compares if two objects are from the same class and all attribute are identical
 * **===** compare if two variables are the same references

* **foreeach** makes it possible to iterate an object values or attribute and values.

```
foreach ($objet as $valeur) {

}
```

or

```
<?php
class MaClasse
{
  public $attribut1 = 'Premier attribut public';
  public $attribut2 = 'Deuxième attribut public';
  
  protected $attributProtege1 = 'Premier attribut protégé';
  protected $attributProtege2 = 'Deuxième attribut protégé';
  
  private $attributPrive1 = 'Premier attribut privé';
  private $attributPrive2 = 'Deuxième attribut privé';
  
  function listeAttributs()
  {
    foreach ($this as $attribut => $valeur)
    {
      echo '<strong>', $attribut, '</strong> => ', $valeur, '<br />';
    }
  }
}

class Enfant extends MaClasse
{
  function listeAttributs() // Redéclaration de la fonction pour que ce ne soit pas celle de la classe mère qui soit appelée.
  {
    foreach ($this as $attribut => $valeur)
    {
      echo '<strong>', $attribut, '</strong> => ', $valeur, '<br />';
    }
  }
}

$classe = new MaClasse;
$enfant = new Enfant;

echo '---- Liste les attributs depuis l\'intérieur de la classe principale ----<br />';
$classe->listeAttributs();

echo '<br />---- Liste les attributs depuis l\'intérieur de la classe enfant ----<br />';
$enfant->listeAttributs();

echo '<br />---- Liste les attributs depuis le script global ----<br />';

foreach ($classe as $attribut => $valeur)
{
  echo '<strong>', $attribut, '</strong> => ', $valeur, '<br />';
}
```

