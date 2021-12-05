<?php

namespace Tests\Unit;

use App\Services\RateCalculator;
use Tests\TestCase;

class RatingCalculationOverallTest extends TestCase
{
    /**
     * Get the expected result from provided request
     */
    public function testMockRequestGetsCorrectResult()
    {
        $inputs = [
            'rate' => ['energy' => 0.3, 'time' => 2, 'transaction' => 1],
            'cdr' => ['meterStart' => 1204307, 'meterStop' => 1215230, 'timestampStart' => '2021-04-05T10:04:00Z', 'timestampStop' => '2021-04-05T11:27:00Z']
        ];
        $calculatorService = RateCalculator::overallCalculation($inputs);
        $this->assertEquals(7.04, $calculatorService);

    }

    public function testMissingFieldValidation()
    {
        $this->postJson('api/rate', [
            'rate' => ['time' => 2, 'transaction' => 1],
            'cdr' => ['meterStart' => 1204307, 'meterStop' => 1215230, 'timestampStart' => '2021-04-05T10:04:00Z', 'timestampStop' => '2021-04-05T11:27:00Z']
        ])
            ->assertStatus(422);
    }


}