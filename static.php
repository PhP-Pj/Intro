<?php
class Personnage
{
  private $_force;
  private $_localisation;
  private $_experience;
  private $_degats;
  
  private static $message = 'I am gonna kill you<br/>';
  private static $counter = 0;

  const FORCE_PETITE = 20;
  const FORCE_MOYENNE = 50;
  const FORCE_GRANDE = 80;

  public function __construct($forceInitiale)
  {
    $this->setForce($forceInitiale);
    self::incInstanceCounter();
  }

  public function setForce($force)
  {
    // On vérifie qu'on nous donne bien soit une « FORCE_PETITE », soit une « FORCE_MOYENNE », soit une « FORCE_GRANDE ».
    if (in_array($force, [self::FORCE_PETITE, self::FORCE_MOYENNE, self::FORCE_GRANDE]))
    {
      $this->_force = $force;
    }
  }
  
  public static function parler()
  {
    echo self::$message;
  }
  
  private static function incInstanceCounter() {
    self::$counter +=1;
  }
  public function getNumberInstance() {
    echo 'getNumberInstance: ' , self::$counter ,'<br/>';
  }
  public static function getNumberPersonnage() {
    echo 'getNumberPersonnage: ' , self::$counter ,'<br/>';
  }
}

Personnage::parler();
Personnage::getNumberPersonnage(); // output 0
$pers = new Personnage(Personnage::FORCE_PETITE);
Personnage::getNumberPersonnage(); // output 1
$pers->getNumberInstance(); // output 1
