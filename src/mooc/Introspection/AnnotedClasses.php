<?php
/**
 * @Table("personnages")
 */
class Personnage
{
}

// Value as array
/**
 * @Type({'brute', 'guerrier', 'magicien'})
 */
class Annimal
{

}

/**
 * @Type({meilleur = 'magicien', 'moins bon' = 'brute', neutre = 'guerrier'})
 */
class Puppet
{

}

/**
 * @Portfolio(share = 'IBM', price = 80.0)
 */
class Wallet
{

}

/**
 * @Portfolio(share = 'ORCL', price = '20')
 */
class Swap
{

}

/**
 * @Portfolio(share = 'TOTL', price = 20.0)
 * @Type("It's a swap")
 */
class Transaction
{
    /**
     * @Type('ticker')
     */
    public $swap;
    /**
     * @Type('volume')
     */
    public $number;

    /**
     * @Type("SWAP")
     */
    public function doit() {

    }
}
