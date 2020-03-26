<?php
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
