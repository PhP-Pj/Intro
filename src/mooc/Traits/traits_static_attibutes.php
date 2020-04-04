<?php
trait MonTrait
{
  static public $attr = 'Hello !';
  
  public function showAttr()
  {
    echo self::$attr;
  }

  static public function traitChangeAtt($attval) {
    self::$attr = $attval;
  }

}

class MaClasse
{
  use MonTrait;

  // for this to run not work the attribute has to be public
  // not sure what that does
  public function changeAtt($attval) {
    MonTrait::$attr = $attval;
  }
}

$fille = new MaClasse;

$fille->showAttr();
$fille->changeAtt(' OMG!');
$fille->showAttr();
$fille->traitChangeAtt(' Now value changed in the trait!');
$fille->showAttr();

printf("\nfille2\n");
$fille2 = new MaClasse;
$fille2->showAttr();
$fille2->changeAtt(' The mooc is wrong, the instance of the attribute is shared!');
$fille2->traitChangeAtt('Changed in fille 2 => The mooc is wrong!');

printf("\nfille1\n");
$fille->showAttr();
