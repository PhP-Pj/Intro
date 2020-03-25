# Intro

### Class

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

