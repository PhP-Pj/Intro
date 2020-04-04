<?php
trait MonTrait
{
  protected $attr = 'Hello !';
  
  public function showAttr()
  {
    echo $this->attr;
  }

  public function traitChangeAtt($attval) {
    $this->attr = $attval;
  }

}

class MaClasse
{
  use MonTrait;

  public function changeAtt($attval) {
    $this->attr = $attval;
  }
}

$fille = new MaClasse;
$fille2 = new MaClasse;

$fille->showAttr();
$fille->changeAtt(' OMG!');
$fille->showAttr();
$fille->traitChangeAtt(' Now value changed in the trait!');
$fille->showAttr();

printf("\nfille2\n");
$fille2->showAttr();
