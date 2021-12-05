<?php

namespace App\Services;

use App\Contracts\RateCalculationInterface;
use Carbon\Carbon;

/**
 * This service should be "final" because the calculation is fixed and cannot be extended
 */
final class RateCalculator implements RateCalculationInterface
{
    /**
     * @param $inputs
     * @return float
     */
    public static function overallCalculation($inputs): float
    {
        $rate = $inputs['rate'];
        $cdr = $inputs['cdr'];

        $KWhConsumedEnergy = ($cdr['meterStop'] - $cdr['meterStart']) / 1000;
        $timePeriod = self::getTimeDifference($cdr['timestampStart'], $cdr['timestampStop']);
        $energyPrice = self::getEnergyPrice($KWhConsumedEnergy, $rate['energy']);
        $timePrice = self::getTimePrice($timePeriod, $rate['time']);
        $transaction = self::getTransactionFee($rate['transaction']);
        $totalPrice = self::getTotalPrice($transaction, $timePrice, $energyPrice);
        return $totalPrice;
    }

    /**
     * @param $start
     * @param $end
     * @return float (hour)
     */
    private static function getTimeDifference($start, $end): float
    {
        $startTimestamp = Carbon::parse($start)->toArray()['timestamp'];
        $endTimestamp = Carbon::parse($end)->toArray()['timestamp'];
        return ($endTimestamp - $startTimestamp) / 3600;
    }

    /**
     * @param $KWhConsumedEnergy
     * @param $energyRate
     * @return float
     */
    private static function getEnergyPrice($KWhConsumedEnergy, $energyRate): float
    {
        return round($KWhConsumedEnergy * $energyRate, 3);
    }

    /**
     * @param $timePeriod
     * @param $timeRate
     * @return float
     */
    private static function getTimePrice($timePeriod, $timeRate): float
    {
        return round($timePeriod * $timeRate, 3);
    }


    /**
     * @param $transactionRate
     * @return float
     */
    private static function getTransactionFee($transactionRate): float
    {
        return $transactionRate;
    }

    /**
     * @param $transaction
     * @param $timePrice
     * @param $energyPrice
     * @return float
     */
    private static function getTotalPrice($transaction, $timePrice, $energyPrice): float
    {
        return round($transaction + $timePrice + $energyPrice, 2);
    }


}