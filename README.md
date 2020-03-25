# Intro

## Running PhP files
PHP files first need be processed in a web server before sending their output to the web browser.

### PhP installation for Ngnix 
See https://tecadmin.net/install-nginx-php-fpm-ubuntu-18-04/ to find out how to configure PHP for nginx.

**Note:**
sudo add-apt-repository ppa:ondrej/php would hang so I added the ppa entries manually to **/etc/apt/sources.list**.  
Found the entries in https://launchpad.net/~ondrej/+archive/ubuntu/php in section Technical details about this PPA for my version of ubuntu.



## PHP

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
