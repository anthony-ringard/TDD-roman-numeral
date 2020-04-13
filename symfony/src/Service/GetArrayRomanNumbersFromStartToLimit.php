<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\RomanNumberConverter as RomanConvertor;

class GetArrayRomanNumbersFromStartToLimit
{
    private $romanNumberConvertor;

    public function __construct(RomanConvertor $romanNumberConvertor)
    {
        $this->romanNumberConvertor = $romanNumberConvertor;
    }

    public function createArrayConvertedNumber(int $start, int $limit, int $step): array
    {
        $convert = [];
        for ($i = $start; $i < $limit; $i += $step) {
            $convert[] = ['arabic ' => $i, 'roman' => $this->romanNumberConvertor->convertArabicToRoman($i)];
        }

        return $convert;
    }
}
