# Magic Methods

## __construct()

## __destruct

## __set and __get

These method are called when one tries to access an attribute or method that doesn't exist or is private.  

```
<?php
class MaClasse
{
  private $unAttributPrive;
  
  public function __set($nom, $valeur)
  {
    echo 'Ah, on a tenté d\'assigner à l\'attribut <strong>', $nom, '</strong> la valeur <strong>', $valeur, '</strong> mais c\'est pas possible !<br />';
  }
}

$obj = new MaClasse;

$obj->attribut = 'Simple test';
$obj->unAttributPrive = 'Autre simple test';
```

## __isset and __unset

**__isset** is called whe function **isset** is called on a private of non existent attribute. It must return a boolean.  
Same for **__unset** and **unset**

## __call and __callStatic

**__call and __callStatic** are respectivaly called on **medthods** and **static methods** that don't exist.

```
 public function __call($nom, $arguments) {

 }

 public static function __callStatic($nom, $arguments) {

 }
 ```

## Serialization / Deserialization

**serialize and unserialize** are used to marshall and unmarshall an object.

## __sleep and __wakeup

**__sleep and __wakeup** are called when repectively **serialize and unserialize** are called.

```
<?php
class Connexion
{
  protected $pdo, $serveur, $utilisateur, $motDePasse, $dataBase;
  
  public function __construct($serveur, $utilisateur, $motDePasse, $dataBase)
  {
    $this->serveur = $serveur;
    $this->utilisateur = $utilisateur;
    $this->motDePasse = $motDePasse;
    $this->dataBase = $dataBase;
    
    $this->connexionBDD();
  }
  
  protected function connexionBDD()
  {
    $this->pdo = new PDO('mysql:host='.$this->serveur.';dbname='.$this->dataBase, $this->utilisateur, $this->motDePasse);
  }
  
  public function __sleep()
  {
    // Ici sont à placer des instructions à exécuter juste avant la linéarisation.
    // On retourne ensuite la liste des attributs qu'on veut sauver.
    return ['serveur', 'utilisateur', 'motDePasse', 'dataBase'];
  }

  public function __wakeup()
  {
    $this->connexionBDD();
  }
}
```

## _toString,__set_state, __invoke et__debugInfo

### toString

```
<?php
class MaClasse
{
  protected $texte;
  
  public function __construct($texte)
  {
    $this->texte = $texte;
  }
  
  public function __toString()
  {
    return $this->texte;
  }
}

$obj = new MaClasse('Hello world !');

// Solution 1 : le cast

$texte = (string) $obj;
var_dump($texte); // Affiche : string(13) "Hello world !".

// Solution 2 : directement dans un echo
echo $obj; // Affiche : Hello world !
```

### __set_state

**__set_state** is called when **var_export** is called. **var_export** export its argument as a string containg PHP code.

```
<?php
class Export
{
  protected $chaine1, $chaine2;
  
  public function __construct($param1, $param2)
  {
    $this->chaine1 = $param1;
    $this->chaine2 = $param2;
  }
  
  public function __set_state($valeurs) // Liste des attributs de l'objet en paramètre.
  {
    $obj = new Export($valeurs['chaine1'], $valeurs['chaine2']); // On crée un objet avec les attributs de l'objet que l'on veut exporter.
    return $obj; // on retourne l'objet créé.
  }
}

$obj1 = new Export('Hello ', 'world !');

eval('$obj2 = ' . var_export($obj1, true) . ';'); // On crée un autre objet, celui-ci ayant les mêmes attributs que l'objet précédent.

echo '<pre>', print_r($obj2, true), '</pre>';
```

**var_export($obj1, true)** is actually equal to  
```
"Export::__set_state(array(
   'chaine1' => 'Hello ',
   'chaine2' => 'world !',
))"
```

## __invoke

**__invoke** makes it possible to call an object like a function

```
<?php
class MaClasse
{
  public function __invoke($argument)
  {
    echo $argument;
  }
}

$obj = new MaClasse;

$obj(5); // output « 5 ».
```

## __debugInfo and var_dump

**var_dump** makes it possible to dump any object and all tpyes of attributes. **__debugInfo** allows to restict the attribute we want to dump.

```
<?php
class FileReader
{
    protected $f;

	public function __construct($path)
	{
		$this->f = fopen($path, 'c+');
	}

	public function __debugInfo()
	{
		return ['f' => fstat($this->f)];
	}
}

$f = new FileReader('fichier.txt');
var_dump($f); // output fstat info.
```


