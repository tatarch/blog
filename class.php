<?php

class Calculator
{
    function multiple($a, $b)
    {
        return $a * $b;
    }

    function sum($a, $b)
    {
        return $a + $b;
    }
}

class Sofa
{
    public $price;

    function __construct($cena)
    {
        echo $cena;
    }

    function getDoublePrice()
    {
        return $this->price;
    }
}

$divan = new Sofa(1500);
echo $divan->getDoublePrice();

$calculator1 = new Calculator();
echo $calculator1->multiple(4, 5);

