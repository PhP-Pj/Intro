# PHP

## Executing PHP

Php can be run:  
* in the web server (in my case nginx) thru the php3-fpm extension service
```
sudo apt install php7.3 php7.3-fpm
sudo service php7.3-fpm restart

```

From the browser:  
```
http://introphp/src/mooc/index.php
```

* from the command prompt via the php-cli package

```
php index.php
```

See https://www.php.net/manual/en/features.commandline.usage.php


### Definition of a class

```
<?php
// Nous créons une classe « Personnage ».
class Personnage
{
  private $_force;
  private $_localisation;
  private $_experience;
  private $_degats;
        
  // Nous déclarons une méthode dont le seul but est d'afficher un texte.
  public function parler()
  {
    echo 'Je suis un personnage !';
  }
  
  public function afficherExperience()
  {
    echo $this->_experience;
  }
  
  // this version is not strongly type      
  public function frapper($persoAFrapper)
  {
    $persoAFrapper->_degats += $this->_force;
  }

  // this version is strongly type      
  public function frapper(Personnage $persoAFrapper)
  {
    $persoAFrapper->_degats += $this->_force;
  }

  public function gagnerExperience()
  {
    // On ajoute 1 à notre attribut $_experience.
    $this->_experience = $this->_experience + 1;
  }
}

    
$perso = new Personnage;
$perso->parler();
```

### Setters and Getters

*getter* form function atributeName()
*setter* from function setAttributeName(val)

```
class Pesonnage {
  private $_degats;
  
  public function degats()
  {
    return $this->_degats;
  }
  
  public function setExperience($experience)
  {
    if (!is_int($experience)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('L\'expérience d\'un personnage doit être un nombre entier', E_USER_WARNING);
      return;
    }
    
    if ($experience > 100) // On vérifie bien qu'on ne souhaite pas assigner une valeur supérieure à 100.
    {
      trigger_error('L\'expérience d\'un personnage ne peut dépasser 100', E_USER_WARNING);
      return;
    }
    
    $this->_experience = $experience;
  }
  
}
```

### Constructor

Form: public function __construct()

```
<?php
class Personnage
{
  private $_force;
  private $_localisation;
  private $_experience;
  private $_degats;

  public function __construct($force, $degats) // Constructeur demandant 2 paramètres
  {
    echo 'Voici le constructeur !'; // Message s'affichant une fois que tout objet est créé.
    $this->setForce($force); // Initialisation de la force.
    $this->setDegats($degats); // Initialisation des dégâts.
    $this->_experience = 1; // Initialisation de l'expérience à 1.
  }
...
}
```

### Imports
Files are imported in PhP with keyword **require***

```
<?php
require 'MaClasse.php'; // J'inclus la classe.

$objet = new MaClasse; // Puis, seulement après, je me sers de ma classe.
```

### Auto Imports
It is possible to register a function to auto import **classes**. This function will be in charge of scouring all the files looking for the particuliar class we intend to use.  
We can register the function with statement **spl_autoload_register**
```
<?php
function chargerClasse($classe)
{
  require $classe . '.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

$perso = new Personnage;
```
**Note:**  
It is possble to rgister sveral "autoload" functions.


### Constants

Constants are declared with keyword **const** and accessible with **::** scope operator.
Inside the class constant are access with **self::const_name**  

**Note:**
Constant names are **NOT** prfixed with **$**

```
<?php
class Personnage
{
  // Je rappelle : tous les attributs en privé !

  private $_force;
  private $_localisation;
  private $_experience;
  private $_degats;

  // Déclarations des constantes en rapport avec la force.

  const FORCE_PETITE = 20;
  const FORCE_MOYENNE = 50;
  const FORCE_GRANDE = 80;

  public function __construct($force)
  {
    if (in_array($force, [self::FORCE_PETITE, self::FORCE_MOYENNE, self::FORCE_GRANDE]))
    {
      $this->_force = $force;
    }
  }
...
}

<?php
// On envoie une « FORCE_MOYENNE » en guise de force initiale.
$perso = new Personnage(Personnage::FORCE_MOYENNE);


```

### Static Methods and Attribute

They are declared with keyword static and accessible with **::**  
Inside the class static are access with **self::static_name** 

#### Methods
```
class Personnage
{
  private $_force;
  private $_localisation;
  private $_experience;
  private $_degats;

  const FORCE_PETITE = 20;
  const FORCE_MOYENNE = 50;
  const FORCE_GRANDE = 80;

  public function __construct($forceInitiale)
  {
    $this->setForce($forceInitiale);
  }
...
  public static function parler()
  {
    echo 'Je vais tous vous tuer !';
  }
}

Personnage::parler();
```

It is also possible but not recommended to use **->**
```
$perso = new Personnage(Personnage::FORCE_GRANDE);
$perso->parler();
```
#### Attributes
Keyword static preceding the name of the variables with like all variables they are prefixed with $

```
class Personnage
{
  private $_force;
  private $_localisation;
  private $_experience;
  private $_degats;
  
  private static $message = 'I am gonna kill you';
  private static $counter = 0;

  const FORCE_PETITE = 20;
  const FORCE_MOYENNE = 50;
  const FORCE_GRANDE = 80;

  public function __construct($forceInitiale)
  {
    $this->setForce($forceInitiale);
    self::incInstanceCounter();
  }
...
  public static function parler()
  {
    echo self::$message;
  }
  
  private static function incInstanceCounter() {
    self::$counter +=1;
  }
  public function getNumberInstance() {
    echo self::$counter;
  }
  public static function getNumberPersonnage() {
    echo self::$counter;
  }
}

Personnage::parler();
Personnage::getNumberPersonnage(); // output 0
$pers = new Pernonnage();
Personnage::getNumberPersonnage(); // output 1
$pers->getNumberInstance(); // output 1

```


