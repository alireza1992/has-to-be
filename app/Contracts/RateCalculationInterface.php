<?php

namespace App\Contracts;

interface RateCalculationInterface
{
    public static function overallCalculation(array $inputs): float;
}