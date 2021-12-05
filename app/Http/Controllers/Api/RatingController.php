<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\RateCalculationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\RateCalculationRequest;
use App\Services\RateCalculator;
use Exception;
use Illuminate\Http\JsonResponse;

class RatingController extends Controller
{
    /**
     * @param RateCalculationRequest $request
     * @return JsonResponse
     * @throws RateCalculationException
     */
    public function calculate(RateCalculationRequest $request): JsonResponse
    {
        $inputs = $request->all();
        try {
            $result = RateCalculator::overallCalculation($inputs);
        } catch (Exception $exception) {
            throw new RateCalculationException($exception->getMessage(), $exception->getCode());
        }
        return response()->json(['overall' => $result, 'components' => $inputs['rate']]);
    }
}
