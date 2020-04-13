<?php

namespace App\Service;

class RomanNumberConverter
{
    private $prefix = [
        1 => 'I',
        4 => 'IV',
        5 => 'V',
        9 => 'IX',
        10 => 'X',
        40 => 'XL',
        50 => 'L',
        90 => 'XC',
        100 => 'C',
        400 => 'CD',
        500 => 'D',
        900 => 'CM',
        1000 => 'M',
        4000 => 'MV̄',
        5000 => 'V̄',
        9000 => 'MX̄',
        10000 => 'X̄',
        40000 => 'X̄L̄',
        50000 => 'L̄',
        90000 => 'X̄C̄̄̄',
        100000 => 'C̄',
        400000 => 'C̄D̄',
        500000 => 'D̄',
        900000 => 'C̄M̄',
        1000000 => 'M̄',
        5000000 => '̄V̄̄̄',
        10000000 => '̄X̄̄̄̄',
        50000000 => '̄L̄',
        100000000 => '̄̄̄̄̄̄̄̄M̄̄̄̄̄̄',
        500000000 => '̄̄̄̄̄̄̄̄̄̄̄̄̄D',
    ];

    private $findNumberClosest;

    public function __construct(FindNumberClosest $findNumberClosest)
    {
        $this->findNumberClosest = $findNumberClosest;
    }

    public function convertArabicToRoman(int $arabicNumber): ?string
    {
        $index = $this->findNumberClosest->getKeyNumberClosestAndSmallest($arabicNumber, $this->prefix);

        if (null === $index || 0 === $arabicNumber) {
            return '';
        }

        return $this->concatPrefixe($this->prefix[$index], $arabicNumber, $index);
    }

    private function concatPrefixe(string $prefix, int $arabic, int $index): string
    {
        return $prefix .= $this->convertArabicToRoman($arabic - $index);
    }
}
