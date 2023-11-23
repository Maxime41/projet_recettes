<?php

namespace App\Taxe;

class CalculatorTaxe
{
    public function calculerTVA($prixHT) 
    {
        $TVA = $prixHT * 0.20;
        return $TVA;
    }

    public function calculerTTC($prixHT)
    {
        $prixTTC = $prixHT * 1.20;
        return $prixTTC;
    }
}