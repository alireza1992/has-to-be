<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class RateCalculationException extends Exception
{
    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json(
            [
                'code' => $this->getCode(),
                'message' => $this->getMessage(),
                'data' => null
            ],
            500
        );
    }
}